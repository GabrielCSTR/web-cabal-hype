FROM php:7.4-fpm-buster

# Arguments defined in docker-compose.yml
ARG user=strdev
ARG uid=1000

ENV ACCEPT_EULA=Y

# Install prerequisites required for tools and extensions installed later on.
RUN apt-get update \
    && apt-get install -y apt-transport-https gnupg2 libpng-dev libzip-dev unzip \
    && rm -rf /var/lib/apt/lists/*

# Install prerequisites for the sqlsrv and pdo_sqlsrv PHP extensions.
RUN curl https://packages.microsoft.com/keys/microsoft.asc | apt-key add - \
    && curl https://packages.microsoft.com/config/debian/10/prod.list > /etc/apt/sources.list.d/mssql-release.list \
    && apt-get update \
    && apt-get install -y msodbcsql17 mssql-tools unixodbc-dev \
    && rm -rf /var/lib/apt/lists/*

# Retrieve the script used to install PHP extensions from the source container.
COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/bin/install-php-extensions

# Install required PHP extensions and all their prerequisites available via apt.
RUN chmod uga+x /usr/bin/install-php-extensions \
    && sync \
    && install-php-extensions bcmath exif gd imagick intl opcache pcntl pdo_sqlsrv redis sqlsrv zip

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Create system user to run Composer and Artisan Commands
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

# Install redis
RUN pecl install -o -f redis \
    &&  rm -rf /tmp/pear \
    &&  docker-php-ext-enable redis

# Add the script to the Docker Image
ADD cron_mercadopago.sh /root/cron_mercadopago.sh

# Give execution rights on the cron scripts
RUN chmod 0644 /root/cron_mercadopago.sh

#Install Cron
RUN apt-get -y install systemd
RUN apt-get -y install nano
RUN apt-get -y install cron
RUN apt-get -y install curl

RUN systemctl enable cron

# Create the log file to be able to run tail
RUN touch /var/log/cron_mercadopago.log

# Add the cron job
RUN crontab -l | { cat; echo "* * * * * bash /root/cron_mercadopago.sh"; } | crontab -

# Run the command on container startup
CMD cron && tail -f /var/log/cron.log

# Set working directory
WORKDIR /var/www

USER $user
