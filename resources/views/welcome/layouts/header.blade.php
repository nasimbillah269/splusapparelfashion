<header class="sticky-header">
<!--    <div class="top-header">-->
<!--        <div class="container">-->
<!--            <div class="row">-->
<!--                <div class="col-lg-7 col-md-7">-->
<!--                    <div class="top-right-header">-->
<!--                        <ul>-->
<!--                            <li> <a href="tel:+880{{ general()->mobile }}">-->
<!--                                <i class="fa-brands fa-whatsapp"></i>-->
<!--                                <i class="fa-solid fa-plus"></i>-->
<!--    <i class="fa fa-phone"></i> +880 {{ general()->mobile }}-->
<!--</a></li>-->
<!--                            <li><a href="mailto:{{general()->email}}"><i class="fa fa-envelope-o"></i> {{general()->email}}</a></li>-->
                            <!--<li><a href="#"><i class="fa fa-clock-o"></i> Mon – Fri: 8.00 – 18.00</a></li>-->
<!--                        </ul>-->
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="col-lg-3 col-md-3">-->
<!--                    <div class="top-left-header">-->
<!--                        <ul>-->
<!--                            <li><a href="javascript:void();">Follow on</a></li>-->
<!--                            @if(general()->facebook_link)-->
<!--                            <li><a href="{{general()->facebook_link}}"><i class="fa fa-facebook"></i></a></li>-->
<!--                            @endif-->
<!--                            @if(general()->twitter_link)-->
<!--                            <li><a href="{{general()->twitter_link}}"><i class="fa fa-twitter"></i></a></li>-->
<!--                            @endif-->
                            <!--@if(general()->instagram_link)-->
                            <!--<li><a href="{{general()->instagram_link}}"><i class="fa fa-instagram"></i></a></li>-->
                            <!--@endif-->
<!--                            @if(general()->linkedin_link)-->
<!--                            <li><a href="{{general()->linkedin_link}}"><i class="fa fa-linkedin"></i></a></li>-->
<!--                            @endif-->
                            <!--@if(general()->youtube_link)-->
                            <!--<li><a href="{{general()->youtube_link}}"><i class="fa fa-youtube-play"></i></a></li>-->
                            <!--@endif-->
                            <!--@if(general()->pinterest_link)-->
                            <!--<li><a href="{{general()->pinterest_link}}"><i class="fa fa-pinterest-p"></i></a></li>-->
                            <!--@endif-->
<!--                        </ul>-->
<!--                    </div>-->
<!--                </div>-->
<!--                 <div class="col-md-2">-->
                     
                  
<!--                     <div class="languagePart ">-->
<!--                        <div class="gtranslate_wrapper"></div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
    
    <div class="main-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-3 col-md-5 col-sm-6 col-10">
                    <div class="logo">
                        <a href="{{route('index')}}"><img src="{{asset(general()->logo())}}" alt="{{general()->title}}"></a>

                    </div>
                </div>
                <div class="col-lg-9 col-md-7 header-menu-section">
                    <div class="header-nav-wrap">
                    <div class="header-menu">
                        @if($menu = menu('Header Menus'))
                        @php
                            $productCtgs = \App\Models\Attribute::where('type',10)->where('status','active')->whereNull('parent_id')->orderBy('name')->get(['id','name','slug']);
                            $hasProductMenu = $menu->subMenus->contains(fn($m) => trim($m->menuLink(),'/') == 'products');
                            $productsActive = request()->is('products*') || request()->is('product/*');
                        @endphp
                        <ul class="menu">
                            @foreach($menu->subMenus as $i => $menu)
                            @php $isProductMenu = trim($menu->menuLink(),'/') == 'products'; @endphp
                            <li class="menu-item {{ ($isProductMenu ? $productsActive : rtrim(asset($menu->menuLink()),'/') == url()->current()) ? 'active' : '' }} {{ $isProductMenu && $productCtgs->count() ? 'has-dropdown' : '' }}">
                                <a href="{{ asset($menu->menuLink()) }}">{{ $menu->menuName() }}</a>
                                @if($isProductMenu && $productCtgs->count())
                                @include(welcomeTheme().'layouts.includes.productsDropdown')
                                @elseif($menu->subMenus->count())
                                <ul class="submenu">
                                    @foreach($menu->subMenus as $submenu)
                                    <li>
                                        <a href="{{ asset($submenu->menuLink()) }}">{{ $submenu->menuName() }}</a>
                                    </li>
                                    @endforeach
                                </ul>
                                @endif
                            </li>
                            {{-- Products menu added automatically after the first item (Home) --}}
                            @if($i == 0 && !$hasProductMenu)
                            <li class="menu-item {{ $productsActive ? 'active' : '' }} {{ $productCtgs->count() ? 'has-dropdown' : '' }}">
                                <a href="{{ route('products') }}">Products</a>
                                @if($productCtgs->count())
                                @include(welcomeTheme().'layouts.includes.productsDropdown')
                                @endif
                            </li>
                            @endif
                            @endforeach
                        </ul>
                        @endif
                    </div>
                    @if(general()->mobile)
                    <a href="tel:{{ preg_replace('/[^0-9+]/', '', general()->mobile) }}" class="headerCallBtn">
                        <i class="fa-solid fa-phone"></i> Call Now
                    </a>
                    @endif
                    </div>
                </div>
               
             
            </div>
        </div>
    </div>
</header>


