<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Basic -->
	<title>{{ config('app.name', 'Cabal Hype') }}</title>
    <meta charset="UTF-8">
    <title>Hype Games  - Servidor Privado de Cabal Online</title>
    <meta name="title" content="Hype Games - Servidor Privado de Cabal Online">
    <meta name="description" content="⚔️Prepare-se para uma grande batalha!">
    <meta name="keywords" content="Cabal online, Hype Games, Cabal Hype, Cabal Hype Games, Cabal Privado, Private Cabal, Cabal Private, Servidor de Cabal, Servidor Privado de Cabal, Cabal, Cabal Download, Cabal Cadastro, Cabal Brasil, Cabal brasileiro">

    <meta property="og:type" content="website">
    <meta property="og:url" content="https://hypegames.com.br">
    <meta property="og:title" content="Hype Games - Servidor Privado de Cabal Online">
    <meta property="og:description" content="⚔️Prepare-se para uma grande batalha!">
    <meta property="og:image" content="#">

    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="#">
    <meta property="twitter:title" content="Hype Games - Servidor Privado de Cabal Online">
    <meta property="twitter:description" content="⚔️Prepare-se para uma grande batalha!">
    <meta property="twitter:image" content="#">
    <link rel="icon" href="#" type="image/png">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet"> -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/swiper.min.css') }}" rel="stylesheet">
    <link href="https://allfont.ru/allfont.css?fonts=cinzel-decorative-bold" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('css/slick-theme.css') }}">
    <link href="{{ asset('css/style-mobile.css') }}" rel="stylesheet">

    {{--  TOAST NOTIFICATION  --}}
    <!-- CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/css/toastr.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.min.css">


</head>

<body>
    @include('web.components.notification')

    <div class="smoke"></div>
    <div class="top-panel">
        <div class="top-panel-block flex-c-c">
            <div class="logo-icon">
                <a href="/"><img src="{{ asset('images/logo-icon.png') }}" alt=""></a>
            </div>
            <div class="button-btn buttonDrop" data-class="menuContent">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <div class="menuContent">
                <ul class="menu flex-c-c">
                    <li class="active"><a href="">Home</a></li>
                    <li><a href="">cadastro</a></li>
                    <li><a href="">top players</a></li>
                    <li><a href="">Top Guilds</a></li>
                    <li><a href="">sobre</a></li>
                    <li><a href="">forum</a></li>
                </ul>
            </div>
            <div class="top_panel-right flex">
                <div class="top_panel-soc-block flex-c-c">
                    <a href="" class="fb"></a>
                    <a href="" class="tw"></a>
                    <a href="" class="twch"></a>
                    <a href="" class="yt"></a>
                </div>
                <div class="topPanel-wrapper_right flex-c">
                <a href="" onclick="new modal('#sign_up_modal');return false" class="sign-in">CADASTRO</a>
                <span>OU</span>
                {{-- <a href="" onclick="new modal('#');return false" class="button">LOGIN</a> --}}
                <button class="button" id="loginMain">
                    {{ __('LOGIN') }}
                </button>
            </div>
            </div>
        </div>
	</div><!-- top-panel -->
    <div class="wrapper">
        <header class="header flex-s">
			<div class="logo">
				<a href="/"><img src="{{ asset('images/logo-1.png') }}" alt=""></a>
            </div>
            <div class="server-time">server time <span>00:10:24 aug 23</span></div>
            <div class="sparks sparks_2">
                <div class="spark_1"></div>
                <div class="spark_2"></div>
                <div class="spark_3"></div>
                <div class="spark_4 spark-big"></div>
                <div class="spark_5 spark-big"></div>
            </div>
            <div class="ray"></div>
        </header><!-- .header-->
        <main class="content">
            <div class="fast-button flex-s">
                <div class="btn-download"><a class="" href="#"><span>Game client 3.45Gb</span></a></div>
                <div class="reg-block">
                    <a href=""><div class="b-icons iso"></div>
                        <span>download</span>
                        <span class="b-icons-text">INSTALADOR</span>
                    </a>
                    <a href=""><div class="b-icons android"></div>
                        <span>download</span>
                        <span class="b-icons-text">INSTALADOR</span>
                    </a>
                </div>
                <div class="status-block">
                    <div class="server-1 flex-c-c">
                        <div class="radial-stat">
                            <div class="circle-online">
                                <div class="serverInfo">
                                    <span class="serverInfo__name">Capella</span>
                                    <span class="serverInfo__online">0<br><span class="serverInfo__i">online</span></span>
                                </div>
                                <div class="circlestat" data-dimension="120" data-width="3.5" data-fontsize="12" data-percent="1" data-fgcolor="#bbcb08" data-bgcolor="rgba(192, 209, 7, 0.2)"></div>
                            </div><!-- circle-online -->
                        </div><!-- radial-stat -->
                    </div>
                    <div class="server-2 flex-c-c">
                        <div class="radial-stat">
                            <div class="circle-online">
                                <div class="serverInfo">
                                    <span class="serverInfo__name">Procyon</span>
                                    <span class="serverInfo__online">0<br><span class="serverInfo__i">online</span></span>
                                </div>
                                <div class="circlestat" data-dimension="120" data-width="3.5" data-fontsize="12" data-percent="1" data-fgcolor="#e22024" data-bgcolor="rgba(226, 32, 36, 0.2)"></div>
                            </div><!-- circle-online -->
                        </div><!-- radial-stat -->
                    </div>
                </div>
            </div>

            {{-- NEWS --}}
            @include('web.components.news')

            {{-- RANKINGS / EVENT --}}
            @include('web.components.rankings')

            <h2 class="title-video-panel">Video</h2>
            <div class="video-pannel flex-s">
                {{-- VIDEOS/IMAGES --}}
                @include('web.components.videos')

                {{-- BANNERS --}}
                @include('web.components.banners')
            </div>

            {{-- MARKET --}}
            {{-- @include('web.components.market') --}}

            <div class="line"></div>
            <div class="to-the-top">
                <div class="button-to-the-top"></div>
            </div>
        </main>

        {{-- FOOTER --}}
        @include('web.components.footer')

    </div>
    <script src="{{ asset('js/jquery-2.1.4.min.js') }}"></script>
    <script src="{{ asset('js/circle-js.js') }}"></script>
    <script src="{{ asset('js/swiper.min.js') }}"></script>
    <script src="{{ asset('js/global.js') }}"></script>
    <script src="{{ asset('js/slick.min.js') }}"></script>
    <script src="{{ asset('js/modalx.js') }}"></script>
     <!-- JS -->
     <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/js/toastr.js"></script>
     <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.min.js"></script>


    @include('web.partials.register')

    @yield('scripts')

	<script>
		var swiper = new Swiper('.swiper-news', {
			autoplay: {
				delay: 4000,
			},
			speed: 1000,
			pagination: {
				el: '.swiper-pagination',
				type: 'fraction',
			},
			navigation: {
				nextEl: '.swiper-button-next',
				prevEl: '.swiper-button-prev',
			},
		});

        $('.center').slick({
		  centerMode: true,
		  centerPadding: '50px 30px',
		  slidesToShow: 3,
		  slidesToScroll: 3,
            responsive: [
                {
                    breakpoint: 750,
                    settings: {
                        slidesToShow: 2,
                        centerMode: false
                    }
                },
                {
                    breakpoint: 550,
                    settings: {
                        slidesToShow: 1,
                        centerMode: true,
                        centerPadding: '50px 30px'
                    }
                }
            ]
		});
	</script>

    {{-- <!-- Log In -->
    <div class="modal_window icon-modal-login" id="login_modal">
        <h3>ACCOUNT PANEL</h3>
        <div class='modal_form'>
            <div class="formGroup error">
                <span class="formGroup-name">Nickname</span>
                <input type="text" name="login">
                <div class="errorGroup">
                    <span class="color-red">Error!</span> A user with this name was not found in the game database of the server.
                </div>
            </div>
            <div class="formGroup">
                <span class="formGroup-name">Password</span>
                <input type="password" name="pass">
            </div>
            <div class="formGroup">
                <span class="formGroup-name">Server</span>
                <select>
                    <option>Main x50</option>
                </select>
            </div>
            <div class="flex-s-c formGroup-button">
                <p class="agree"> <input type="checkbox" class="checkbox" id="agree" name="agree" checked>
                    <label for="agree"></label> Remember me.
                </p>
                <a href="" class="lost-pass">Lost password?</a>
                <button class="button">Sign in</button>
            </div>
        </div>
    </div> --}}

</body>
</html>
