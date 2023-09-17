<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row w-100">
            <img src="{{ getSettingImageLink('logo') }}" style="object-fit: contain;width: 100%;" />
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="@if (isset($active) && $active == 'panelHome') active @endif nav-item">
                <a class="d-flex align-items-center" href="{{ route('admin.index') }}">
                    <i data-feather="home"></i>
                    <span class="menu-title text-truncate" data-i18n="{{ trans('common.PanelHome') }}">
                        {{ trans('common.PanelHome') }}
                    </span>
                </a>
            </li>
            <li class="nav-item @if (isset($active) && $active == 'settings') active @endif">
                <a class="d-flex align-items-center" href="{{ route('settings.index') }}">
                    <i data-feather='settings'></i>
                    <span class="menu-title text-truncate" data-i18n="{{ trans('common.settings') }}">
                        {{ trans('common.settings') }}
                    </span>
                </a>
            </li>
            <li class=" nav-item">
                <a class="d-flex align-items-center" href="#">
                    <i data-feather="map-pin"></i>
                    <span class="menu-title text-truncate" data-i18n="{{ trans('common.LocalesManagment') }}">
                        {{ trans('common.LocalesManagment') }}
                    </span>
                </a>
                <ul class="menu-content">
                    <li @if (isset($active) && $active == 'countries') class="active" @endif>
                        <a class="d-flex align-items-center" href="{{ route('countries.index') }}">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="{{ trans('common.Countries') }}">
                                {{ trans('common.Countries') }}
                            </span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class=" nav-item">
                <a class="d-flex align-items-center" href="#">
                    <i data-feather="layers"></i>
                    <span class="menu-title text-truncate" data-i18n="{{ trans('common.restaurantfront') }}">
                        {{ trans('common.storeFront') }}
                    </span>
                </a>
                <ul class="menu-content">
                    <li @if (isset($active) && $active == 'categories') class="active" @endif>
                        <a class="d-flex align-items-center" href="{{ route('categories.index') }}">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="{{ trans('common.categories') }}">
                                {{ trans('common.categories') }}
                            </span>
                        </a>
                    </li>
                    <li @if (isset($active) && $active == 'products') class="active" @endif>
                        <a class="d-flex align-items-center" href="{{ route('products.index') }}">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="{{ trans('common.products') }}">
                                {{ trans('common.products') }}
                            </span>
                        </a>
                    </li>
                      
                 
                  
                    <li @if (isset($active) && $active == 'offer') class="active" @endif>
                        <a class="d-flex align-items-center" href="{{ route('offers.index') }}">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="{{ trans('common.offer') }}">
                                {{ trans('common.offer') }}
                            </span>
                        </a>
                    </li>
                   
                </ul>
            </li>
            <li class=" nav-item">
                <a class="d-flex align-items-center" href="#">
                    <i data-feather="shield"></i>
                    <span class="menu-title text-truncate" data-i18n="{{ trans('common.UsersManagment') }}">
                        {{ trans('common.UsersManagment') }}
                    </span>
                </a>
                <ul class="menu-content">
                    <li @if (isset($active) && $active == 'adminUsers') class="active" @endif>
                        <a class="d-flex align-items-center" href="{{ route('users.index') }}">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="{{ trans('common.AdminUsers') }}">
                                {{ trans('common.users') }}
                            </span>
                        </a>
                    </li>
                    <li @if (isset($active) && $active == 'roles') class="active" @endif>
                        <a class="d-flex align-items-center" href="{{ route('roles.index') }}">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="{{ trans('common.role') }}">
                                {{ trans('common.role') }}
                            </span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item @if(isset($active) && $active == 'orders') active @endif">
                <a class="d-flex align-items-center" href="{{ route('orders.index') }}">
                    <i data-feather='shopping-cart'></i>
                    <span class="menu-title text-truncate" data-i18n="{{trans('common.orders')}}">
                        {{trans('common.orders')}}
                    </span>
                </a>
            </li>
            
        
           
            <li class="nav-item @if (isset($active) && $active == 'reviews') active @endif">
                <a class="d-flex align-items-center" href="{{ route('reviews.index') }}">
                    <i data-feather='bar-chart-2'></i>
                    <span class="menu-title text-truncate" data-i18n="{{ trans('common.reviews') }}">
                        {{ trans('common.reviews') }}
                    </span>
                </a>
            </li>
            <li class="nav-item @if (isset($active) && $active == 'contactMessages') active @endif">
                <a class="d-flex align-items-center" href="{{ route('admin.contactmessages') }}">
                    <i data-feather='mail'></i>
                    <span class="menu-title text-truncate" data-i18n="{{ trans('common.contactMessages') }}">
                        {{ trans('common.contactMessages') }}
                    </span>
                </a>
            </li>
        </ul>
    </div>
</div>
<!-- END: Main Menu-->
