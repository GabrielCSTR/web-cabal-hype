<!-- fixed-top-->
<nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-semi-dark navbar-shadow">
    <div class="navbar-wrapper">
      <div class="navbar-header" style="height: 6rem; margin-bottom: 2px;">
        <ul class="nav navbar-nav flex-row">
          <li class="nav-item mobile-menu d-md-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu font-large-1"></i></a></li>
          <li class="nav-item mr-auto">
            <a class="navbar-brand" href="{{ route('dashboard') }}">
              {{-- <img class="brand-logo" alt="cabal hype logo" src="{{ asset('images/logo-icon.png') }}"> --}}
              <img class="brand-logo" alt="logo" src="{{ asset('images/logo-icon.png') }}">
              <h3 class="brand-text teal">CABAL HYPE
                <p class="text-right text-warning font-small-3" style="margin-right: 50px">Painel</p>
              </h4>
            </a>
          </li>
          <li class="nav-item d-none d-md-block float-right"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="toggle-icon ft-toggle-right font-medium-3 white" data-ticon="ft-toggle-right"></i></a></li>
          <li class="nav-item d-md-none">
            <a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile"><i class="la la-ellipsis-v"></i></a>
          </li>
        </ul>
      </div>
      <div class="navbar-container content">
        <div class="collapse navbar-collapse" id="navbar-mobile">
          <ul class="nav navbar-nav mr-auto float-left">
            <li class="nav-item d-none d-md-block"><a class="nav-link nav-link-expand" href="#"><i class="ficon ft-maximize"></i></a></li>
          </ul>
          <ul class="nav navbar-nav float-right">
            <li class="dropdown dropdown-user nav-item">
              <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                <span class="mr-1">Olá,
                  <span class="user-name text-bold-700">{{ Auth::user()->ID }}</span>
                </span>
                <span class="avatar avatar-online">
                  <img src="{{ asset('images/icon-login.jpg') }}" alt="avatar"><i></i></span>
              </a>
              <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="{{ route('profile.index') }}"><i class="ft-user"></i> Editar Perfil</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('web.logout') }}" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">
                    <i class="ft-power"></i>
                    Logout
                </a>
                <form id="frm-logout" action="{{ route('web.logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
              </div>
            </li>
            <li class="dropdown dropdown-notification nav-item">
              <a class="nav-link nav-link-label" href="#" data-toggle="dropdown"><i class="ficon ft-mail">             </i></a>
              <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                <li class="dropdown-menu-header">
                  <h6 class="dropdown-header m-0">
                    <span class="grey darken-2">Messages</span>
                  </h6>
                  <span class="notification-tag badge badge-default badge-warning float-right m-0">0 New</span>
                </li>
                <li class="scrollable-container media-list w-100">
                </li>
                <li class="dropdown-menu-footer"><a class="dropdown-item text-muted text-center" href="javascript:void(0)">Read all messages</a></li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>