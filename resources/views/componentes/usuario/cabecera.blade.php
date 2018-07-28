<header class="m-grid__item	m-header"  data-minimize="minimize" data-minimize-mobile="minimize" data-minimize-offset="10" data-minimize-mobile-offset="10" >
    <div class="m-header__top">
        <div class="m-container m-container--fluid m-container--full-height m-page__container">
            <div class="m-stack m-stack--ver m-stack--desktop">
                <div class="m-stack__item m-brand m-stack__item--left">
                    <div class="m-stack m-stack--ver m-stack--general m-stack--inline">
                        <div class="m-stack__item m-stack__item--middle m-brand__logo">
                            <a href="{{route('home')}}" class="m-brand__logo-wrapper">
                                <img alt="Logo UNOS" src="{{asset('images/logos/unos_color.png')}}" class="m-brand__logo-default" style="max-height:50px"/>
                                <img alt="Logo UNOS" src="{{asset('images/logos/unos_bn.png')}}" class="m-brand__logo-inverse" style="max-height:50px"/>
                            </a>
                        </div>
                        <div class="m-stack__item m-stack__item--middle m-brand__tools">
                            <a id="m_aside_header_menu_mobile_toggle" href="javascript:;" class="m-brand__icon m-brand__toggler m--visible-tablet-and-mobile-inline-block">
                                <span></span>
                            </a>
                            <a id="m_aside_header_topbar_mobile_toggle" href="javascript:;" class="m-brand__icon m--visible-tablet-and-mobile-inline-block">
                                <i class="flaticon-more"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="m-stack__item m-stack__item--middle m-dropdown m-dropdown--arrow m-dropdown--large m-dropdown--mobile-full-width m-dropdown--align-right m-dropdown--skin-light m-header-search m-header-search--expandable- m-header-search--skin- d-block d-sm-none" id="m_quicksearch" data-search-type="default"></div>
                <div class="m-stack__item m-stack__item--middle text-center">
                    <h3 style="text-shadow: 0px 0px 28px rgba(255, 255, 255, 1);" class="d-none d-lg-block">{{config('app.slogan')}}</h3>
                    <div class="m-dropdown__wrapper">
                        <div class="m-dropdown__arrow m-dropdown__arrow--center"></div>
                        <div class="m-dropdown__inner">
                            <div class="m-dropdown__body">
                                <div class="m-dropdown__scrollable m-scrollable" data-max-height="300" data-mobile-max-height="200">
                                    <div class="m-dropdown__content m-list-search m-list-search--skin-light"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <user-area url="{{route('app')}}" o="{{route('org.perfil')}}" us="{{route('org.usuarios')}}" u="{{route('org.usuario')}}"></user-area>
            </div>
        </div>
    </div>
    <menu-us></menu-us>
</header>