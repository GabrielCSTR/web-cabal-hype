<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Basic -->
	<title>{{ config('app.name', 'Cabal Millennium') }}</title>
    <meta charset="UTF-8">
    <title>Millennium Games  - Servidor Privado de Cabal Online</title>
    <meta name="title" content="Millennium Games - Servidor Privado de Cabal Online">
    <meta name="description" content="⚔️Prepare-se para uma grande batalha!">
    <meta name="keywords" content="Cabal online, Millennium Games, Cabal Millennium, Cabal Millennium Games, Cabal Privado, Private Cabal, Cabal Private, Servidor de Cabal, Servidor Privado de Cabal, Cabal, Cabal Download, Cabal Cadastro, Cabal Brasil, Cabal brasileiro">

    <meta property="og:type" content="website">
    <meta property="og:url" content="https://games-millennium.com/">
    <meta property="og:title" content="Millennium Games - Servidor Privado de Cabal Online">
    <meta property="og:description" content="⚔️Prepare-se para uma grande batalha!">
    <meta property="og:image" content="#">

    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="#">
    <meta property="twitter:title" content="Millennium Games - Servidor Privado de Cabal Online">
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
                    <li class="{{ (request()->is('/')) ? 'active' : '' }}"><a href="{{ route('web.home') }}">Home</a></li>
                    <li class="{{ (request()->is('download')) ? 'active' : '' }}"><a href="{{ route('web.download') }}">download</a></li>
                    <li><a href="">RANKINGS</a></li>
                    {{-- <li><a href="">Top Guilds</a></li>
                    <li><a href="">sobre</a></li> --}}
                    {{-- <li><a href="">forum</a></li> --}}
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
                {{-- <span>OU</span> --}}
                {{-- <a href="" onclick="new modal('#');return false" class="button">LOGIN</a> --}}
                {{-- <button class="button" id="loginMain">
                    {{ __('LOGIN') }}
                </button> --}}
            </div>
            </div>
        </div>
	</div><!-- top-panel -->
    <div class="wrapper">
        <header class="header flex-s">
			{{-- <div class="logo">
				<a href="/"><img src="{{ asset('images/logo-1.png') }}" alt=""></a>
            </div> --}}
            {{-- <div class="server-time">server time <span>00:00:00 00 00</span></div> --}}
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
            {{-- <div class="fast-button flex-s">
                <div class="btn-download"><a class="" target="_blank" href="https://drive.google.com/file/d/1gEmLlF2N1sNDpgh5HWVcQMuywSdNZtkF/view?usp=sharing"><span>Game client 3.45Gb</span></a></div>
                <div class="reg-block">
                    <a  target="_blank" href="https://www.mediafire.com/file/uncbleji6g3lfse/Cabal_Hype.7z/file"><div class="b-icons iso"></div>
                        <span>download GoogleDrive</span>
                        <span class="b-icons-text"> PATCH</span>
                    </a>
                    <a target="_blank" href="https://mega.nz/file/m18R0JYL#19xxluWCgWOSfiFbUpy4KRJssZet8fCQlv8NEh6Xko8"><div class="b-icons android"></div>
                        <span>download MediaFire</span>
                        <span class="b-icons-text"> PATCH</span>
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
            </div> --}}

            <div class="widgets_news flex-s">
                <div class="widget-panel-left">
                    <div class="widget-block">
                        <div class="info-widget-block top-players flex-s">
                            <h2 class="title-widget-block">Top Players</h2>
                            <input type="button" class="add" value="">
                        </div>
                        <ul class="top-block top-players">
                            @foreach ($rankings as $key => $rank)
                                <li class="top-list">
                                    <span class="top-number">0{{ $key + 1 }}.</span> <span class="top-flag"><img src="images/flag-icon.png" alt=""></span> <span class="top-name"><a href="" title="nickname">{{ $rank->Name }}</a></span> <span class="top-lvl">{{ $rank->LEV }}</span> <span class="top-Res">
                                    @php
                                        if ($rank->Reputation<=10000) { echo '(0)';}
                                        if ($rank->Reputation>=10000 and $rank->Reputation<20000) { echo '(1)';}
                                        if ($rank->Reputation>=20000 and $rank->Reputation<40000) { echo '(2)';}
                                        if ($rank->Reputation>=40000 and $rank->Reputation<80000) { echo ' (3)';}
                                        if ($rank->Reputation>=80000 and $rank->Reputation<160000) { echo ' (4)';}
                                        if ($rank->Reputation>=160000 and $rank->Reputation<320000) { echo ' (5)';}
                                        if ($rank->Reputation>=320000 and $rank->Reputation<640000) { echo ' (6)';}
                                        if ($rank->Reputation>=640000 and $rank->Reputation<1280000) { echo ' (7)';}
                                        if ($rank->Reputation>=1280000 and $rank->Reputation<2560000) { echo ' (8)';}
                                        if ($rank->Reputation>=2560000 and $rank->Reputation<5120000) { echo ' (9)';}
                                        if ($rank->Reputation>=5120000 and $rank->Reputation<10000000) { echo ' (10)';}
                                        if ($rank->Reputation>=10000000 and $rank->Reputation<20000000) { echo ' (11)';}
                                        if ($rank->Reputation>=20000000 and $rank->Reputation<50000000) { echo ' (12)';}
                                        if ($rank->Reputation>=50000000 and $rank->Reputation<80000000) { echo ' (13)';}
                                        if ($rank->Reputation>=80000000 and $rank->Reputation<150000000) { echo ' (14)';}
                                        if ($rank->Reputation>=150000000 and $rank->Reputation<300000000) { echo ' (15)';}
                                        if ($rank->Reputation>=300000000 and $rank->Reputation<500000000) { echo ' (16)';}
                                        if ($rank->Reputation>=500000000 and $rank->Reputation<1000000000) { echo ' (17)';}
                                        if ($rank->Reputation>=1000000000 and $rank->Reputation<1500000000) { echo ' (18)';}
                                        if ($rank->Reputation>=1500000000 and $rank->Reputation<2000000000) { echo ' (19)';}
                                        if ($rank->Reputation>=2000000000) { echo ' (20)';}
                                    @endphp
                                    <sup>0</sup></span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="widget-block-span"></div>
                    <div class="widget-block">
                        <div class="info-widget-block top-guilds flex-s">
                            <h2 class="title-widget-block">Top Guilds</h2>
                            <input type="button" class="add">
                        </div>
                        <ul class="top-block top-guilds">
                            <li class="top-title">
                                <span class="top-number">#</span> <span class="top-flag"></span> <span class="top-name">Name</span> <span class="top-score">Score</span>
                            </li>
                            @foreach ($guilds as $key => $guild)
                                <li class="top-list">
                                    <span class="top-number">{{ $key +1 }}.</span> <span class="top-flag"><img src="images/flag-icon.png" alt=""></span> <span class="top-name"><a href="" title="nickname">{{ $guild->GuildName }}</a></span> <span class="top-score">{{ $guild->Point }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="widget-block-span"></div>
                        <div class="widget-block">
                            <div class="info-widget-block top-event flex-s">
                                <h2 class="title-widget-block">Event</h2>
                                <input type="button" class="add">
                            </div>
                            <ul class="event-timers">

                            </ul>
                        </div>
                </div>
                <div class="news-block">
                    <h2>ATIVAR CONTA</h2>
                    <div class="download">
                        <div class="download-files">
                            <h3>ATIVAÇÃO <p>Ative sua conta para confirmar seu registro!</p></h3>
                            <div class="google-drive">
                                <form method="POST" action="{{ route('web.active', ['account' => $account]) }}">
                                    @csrf
                                    <button type="submit" class="btn-download-file">ATIVAR CONTAR</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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

</body>
</html>
