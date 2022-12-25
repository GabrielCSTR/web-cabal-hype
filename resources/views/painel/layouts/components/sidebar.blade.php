<div class="main-menu-content menu-accordion mt-2">
    <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
        <li class=" nav-item {{ (request()->is('dashboard*')) ? 'active' : '' }}"><a href="{{ route('dashboard') }}"><i class="ft-home"></i><span class="menu-title" data-i18n="">Dashboard</span></a></li>
        @if (Auth::user()->isAdmin())
            <li class="nav-item {{ (request()->is('admin/*')) ? 'open' : '' }}"><a href="#"><i class="ft-settings"></i><span class="menu-title" data-i18n="">Manager SHOP</span></a>
                <ul class="menu-content">
                    <li class="{{ (request()->is('admin/donate-plans*')) ? 'active' : '' }}"><a class="menu-item" href="{{ route('donate.plans.view') }}">Planos Donate</a>
                    </li>
                    <li class="{{ (request()->is('admin/category*')) ? 'active' : '' }}"><a class="menu-item" href="{{ route('shop.index-category.view') }}">Adicionar Categoria</a>
                    </li>
                    <li class="{{ (request()->is('admin/items*')) ? 'active' : '' }}"><a class="menu-item" href="{{ route('shop.index-items.view') }}">Adicionar Item</a>
                    </li>
                    <li class="{{ (request()->is('transations-logs*')) ? 'active' : '' }}"><a class="menu-item" href="{{ route('shop.transations.view') }}">Historico Transações</a></li>
                </ul>
            </li>
        @endif
        <li class=" nav-item {{ (request()->is('donate*')) ? 'active' : '' }}"><a href="{{ route('donate.index') }}"><i class="la la-money"></i><span class="menu-title" data-i18n="">Donate</span></a></li>
        <li class=" nav-item"><a href="{{ route('shop.index','1') }}"><i class="ft-shopping-cart"></i><span class="menu-title" data-i18n="">Shop</span></a></li>
        <li class=" nav-item {{ (request()->is('premium*')) ? 'active' : '' }}"><a href="{{ route('premium.index') }}"><i class="ft-user"></i><span class="menu-title" data-i18n="">Serviço Premium</span></a>
        <li class=" nav-item {{ (request()->is('chars*')) ? 'active' : '' }}"><a href="{{ route('chars.index') }}"><i class="ft-users"></i><span class="menu-title" data-i18n="">Personagens</span></a></li>
        <li class=" nav-item {{ (request()->is('profile*')) ? 'active' : '' }}"><a href="{{ route('profile.index') }}"><i class="ft-user"></i><span class="menu-title" data-i18n="">Perfil</span></a>
    </ul>
  </div>
</div>
