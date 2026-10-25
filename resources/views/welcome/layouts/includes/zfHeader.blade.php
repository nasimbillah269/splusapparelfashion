<!-- ================= Header ================= -->
<style>
    .zh-in{width:100%;padding:0 50px}
    @media (max-width:991px){ .zh-in{padding:0 20px} }
    @media (max-width:575px){ .zh-in{padding:0 15px} }
    .zh-top{background:#1f2024;color:#cfcfcf;font-family:'Rubik',sans-serif;font-size:12px;border-bottom:1px solid rgba(255,255,255,.06)}
    .zh-top .zh-in{display:flex;justify-content:space-between;align-items:center;height:46px;gap:20px}
    .zh-tagline{display:flex;align-items:center;gap:8px;white-space:nowrap}
    .zh-tagline i{color:#fd5b00}
    .zh-top-right{display:flex;align-items:center;height:100%}
    .zh-top-item{display:flex;align-items:center;gap:8px;height:100%;padding:0 22px;border-left:1px solid rgba(255,255,255,.08);color:#cfcfcf;text-decoration:none;white-space:nowrap;transition:color .25s}
    .zh-top-item i{color:#fd5b00;font-size:13px}
    a.zh-top-item:hover{color:#fff}
    .zh-follow{display:flex;align-items:center;gap:6px;height:100%;padding-left:22px;border-left:1px solid rgba(255,255,255,.08)}
    .zh-follow > span{margin-right:6px;color:#9a9a9a;text-transform:uppercase;font-size:10px;letter-spacing:1px;font-weight:600}
    .zh-follow a{width:28px;height:28px;display:flex;align-items:center;justify-content:center;border-radius:50%;background:rgba(255,255,255,.07);color:#fff;font-size:12px;text-decoration:none;transition:background .25s,transform .25s}
    .zh-follow a:hover{transform:translateY(-2px);color:#fff}
    .zh-follow a.fb:hover{background:#1877f2}
    .zh-follow a.in:hover{background:#0a66c2}
    .zh-follow a.x:hover{background:#000}
    .zh-follow a.ig:hover{background:linear-gradient(45deg,#f09433,#dc2743,#bc1888)}
    .zh-follow a.yt:hover{background:#ff0000}
    @media (max-width:1399.98px){ .zh-top-item.hours{display:none} }
    @media (max-width:991px){
        .zh-tagline{display:none}
        .zh-top .zh-in{justify-content:center}
        .zh-follow > span{display:none}
    }
    .zh-header{position:sticky;top:0;z-index:100;background:#2a2b30;transition:box-shadow .3s}
    .zh-header.scrolled{box-shadow:0 6px 25px rgba(0,0,0,.35)}
    .zh-header > .zh-in{display:flex;align-items:center;justify-content:space-between;height:115px;gap:20px}
    .zh-logo{display:flex;align-items:center;gap:10px;text-decoration:none}
    .zh-logo-mark{width:56px;height:56px;flex:0 0 56px;border-radius:50%;background:#fd5b00;display:flex;align-items:center;justify-content:center;color:#fff;font-family:'Teko',sans-serif;font-size:30px;line-height:1;padding-top:4px;box-shadow:inset 0 0 0 4px #2a2b30,0 0 0 2px #fd5b00}
    .zh-logo-text{font-family:'Teko',sans-serif;color:#fd5b00;font-size:30px;font-weight:600;letter-spacing:.5px;font-variant:small-caps;line-height:1;white-space:nowrap}
    .zh-logo-img{width:125px;height:135px;flex:0 0 125px;object-fit:contain}
    /* footer: undo techwix.css's 52px white-filtered footer logo */
    .tx-footer-logo .zh-logo-img{width:125px;height:135px;filter:none}
    .zh-nav{display:flex;align-items:center;gap:45px}
    .zh-menu{display:flex;list-style:none;margin:0;padding:0;gap:30px}
    .zh-menu > li{position:relative}
    .zh-menu > li > a{display:block;font-family:'Teko',sans-serif;font-size:22px;letter-spacing:.3px;text-transform:uppercase;color:#fff;text-decoration:none;padding:45px 0}
    .zh-menu > li > a i{font-size:9px;margin-left:4px}
    .zh-menu > li.active > a,.zh-menu > li:hover > a{color:#fd5b00}
    .zh-drop{position:absolute;top:100%;left:-20px;min-width:220px;background:#fff;box-shadow:0 10px 30px rgba(0,0,0,.15);opacity:0;visibility:hidden;transform:translateY(10px);transition:.3s;z-index:5}
    .zh-menu > li:hover .zh-drop{opacity:1;visibility:visible;transform:none}
    .zh-drop a{display:block;padding:10px 20px;color:#222;font-family:'Rubik',sans-serif;font-size:13px;text-decoration:none;border-bottom:1px solid #f0f0f0;transition:.25s}
    .zh-drop a:hover{color:#fd5b00;padding-left:26px}
    .zh-drop a.active{color:#fd5b00;border-bottom-color:#fd5b00}
    .zh-call{display:flex;align-items:center;gap:14px;color:#fff;text-decoration:none;font-family:'Rubik',sans-serif;white-space:nowrap}
    .zh-call:hover{color:#fff}
    .zh-call i{font-size:30px;color:#fd5b00}
    .zh-call small{display:block;font-size:10px;color:#bbb}
    .zh-call b{font-size:14px;font-weight:500}
    .zh-toggle{display:none;background:none;border:0;color:#fff;font-size:24px;cursor:pointer}
    .zh-nav-head,.zh-overlay{display:none}
    body.tx-nav-open{overflow:hidden}
    /* Desktop: menu sits in the exact centre of the header, call box stays right */
    @media (min-width:1200px){
        .zh-header > .zh-in{position:relative}
        .zh-nav{flex:1;justify-content:flex-end}
        .zh-menu,.zh-menu > li > a{white-space:nowrap}
        /* the old theme (techwix.css) gives .tx-menu a right margin that eats header space */
        .zh-menu.tx-menu{margin:0}
    }
    /* Large screens: menu in the exact centre of the header */
    @media (min-width:1600px){
        .zh-menu{position:absolute;left:50%;top:0;transform:translateX(-50%)}
    }
    /* Laptops: menu sits between logo and call box, a little smaller so it stays on one line */
    @media (min-width:1200px) and (max-width:1599.98px){
        .zh-header > .zh-in{padding:0 30px;gap:24px}
        .zh-nav{justify-content:space-between;gap:24px}
        .zh-menu{flex:1;justify-content:center;gap:22px}
        .zh-menu > li > a{font-size:19px}
        .zh-logo-mark{width:48px;height:48px;flex-basis:48px;font-size:26px}        .zh-logo-text{font-size:25px}
        .zh-call{gap:10px}
        .zh-call i{font-size:24px}
    }
    @media (min-width:1200px) and (max-width:1399.98px){
        .zh-header > .zh-in{padding:0 20px;gap:18px}
        .zh-menu{gap:16px}
        .zh-menu > li > a{font-size:17px}
        .zh-logo-text{font-size:22px}
        .zh-call small{display:none}
    }
    @media (max-width:1199.98px){
        .zh-header > .zh-in{height:85px}
        .zh-toggle{display:block}
        .zh-overlay{display:block;position:fixed;inset:0;background:rgba(0,0,0,.5);opacity:0;visibility:hidden;transition:.3s;z-index:140}
        .zh-overlay.show{opacity:1;visibility:visible}
        .zh-nav{position:fixed;top:0;right:0;width:min(330px,86vw);height:100vh;height:100dvh;background:#2a2b30;flex-direction:column;align-items:stretch;gap:0;padding:0 0 30px;transform:translateX(105%);visibility:hidden;transition:transform .35s,visibility .35s;overflow-y:auto;z-index:150}
        .zh-nav.open{transform:none;visibility:visible}
        .zh-nav-head{display:flex;justify-content:space-between;align-items:center;padding:20px;border-bottom:1px solid rgba(255,255,255,.1)}
        .zh-nav-head .zh-logo-text{font-size:22px}
        .zh-menu{flex-direction:column;gap:0}
        .zh-menu > li > a{padding:14px 20px;border-bottom:1px solid rgba(255,255,255,.08)}
        .zh-drop{position:static;opacity:1;visibility:visible;transform:none;box-shadow:none;display:none;background:#232428}
        .zh-menu > li.open .zh-drop{display:block}
        .zh-drop a{color:#ddd;border-color:rgba(255,255,255,.06);padding-left:32px}
        .zh-call{padding:25px 20px 0}
    }
    @media (max-width:767px){
        .zh-top{display:none}
        .zh-logo-mark{width:44px;height:44px;flex-basis:44px;font-size:22px}
        .zh-logo-img{width:48px;height:48px;flex-basis:48px}
        .zh-logo-text{font-size:21px}
    }
</style>

<div class="zh-top">
    <div class="zh-in">
        @php
            // Only real URLs from Admin > Settings > Social; anything else falls back to "#"
            $zhUrl = fn($v) => preg_match('#^https?://#i', (string) $v) ? $v : '#';
            $zhSocial = [
                ['fb', 'fa-brands fa-facebook-f', 'Facebook', $zhUrl(general()->facebook_link)],
                ['in', 'fa-brands fa-linkedin-in', 'LinkedIn', $zhUrl(general()->linkedin_link)],
                ['x', 'fa-brands fa-x-twitter', 'X (Twitter)', $zhUrl(general()->twitter_link)],
                ['ig', 'fa-brands fa-instagram', 'Instagram', $zhUrl(general()->instagram_link)],
                ['yt', 'fa-brands fa-youtube', 'YouTube', $zhUrl(general()->youtube_link)],
            ];
        @endphp
        <span class="zh-tagline"><i class="fa-solid fa-award"></i> Your Trusted RMG Sourcing and Exporter</span>
        <div class="zh-top-right">
            <span class="zh-top-item hours"><i class="fa-regular fa-clock"></i> Sat - Thu: 09:00 AM - 07:00 PM</span>
            @if(general()->email)
            <a href="mailto:{{ general()->email }}" class="zh-top-item"><i class="fa-regular fa-envelope"></i> {{ general()->email }}</a>
            @endif
            <div class="zh-follow">
                <span>Follow Us</span>
                @foreach($zhSocial as $s)
                <a href="{{ $s[3] }}" class="{{ $s[0] }}" aria-label="{{ $s[2] }}" title="{{ $s[2] }}" @if($s[3] != '#') target="_blank" rel="noopener" @endif><i class="{{ $s[1] }}"></i></a>
                @endforeach
            </div>
        </div>
    </div>
</div>

<header class="zh-header" id="txHeader">
    <div class="zh-in">
        {{-- Logo icon from Admin > Settings > Logo; the "S+" mark shows until one is uploaded --}}
        <a href="{{route('index')}}" class="zh-logo">@if(general()->logo)<img src="{{ asset(general()->logo()) }}" alt="{{ general()->title }}" class="zh-logo-img">@else<span class="zh-logo-mark">S+</span>@endif<span class="zh-logo-text">S Plus Apparel Fashion</span></a>

        <!-- Mobile menu backdrop: click outside the panel to close -->
        <div class="zh-overlay" id="txNavOverlay" onclick="txToggleNav(false)"></div>

        <nav class="zh-nav" id="txNav">
            <div class="zh-nav-head">
                <a href="{{route('index')}}" class="zh-logo"><span class="zh-logo-text">S Plus Apparel Fashion</span></a>
                <button class="zh-toggle" type="button" onclick="txToggleNav(false)" aria-label="Close menu"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <ul class="zh-menu tx-menu">
                @if($txMenu && $txMenu->subMenus->count())
                    @php
                        // A "Products" menu item without its own sub menus lists the product categories (Admin > Products > Categories)
                        $zhProductsUrl = rtrim(route('products'), '/');
                        $zhProductCtgs = null;
                    @endphp
                    @foreach($txMenu->subMenus as $m)
                    @php
                        $mLink = rtrim(asset($m->menuLink()), '/');
                        $mItems = $m->subMenus->map(fn($s) => [$s->menuName(), asset($s->menuLink())]);
                        $mIsProducts = $mLink == $zhProductsUrl;
                        if($mIsProducts && $mItems->isEmpty()){
                            $zhProductCtgs ??= \App\Models\Attribute::where('type',10)->where('status','active')->whereNull('parent_id')
                                ->orderBy('view')->orderBy('name')->get(['id','name','slug']);
                            $mItems = $zhProductCtgs->map(fn($c) => [$c->name, route('productCategory', $c->slug ?: 'no-title')]);
                        }
                        $mActive = $mLink == $txCurrent
                            || $mItems->contains(fn($s) => rtrim($s[1], '/') == $txCurrent)
                            || ($mIsProducts && (request()->routeIs('products') || request()->routeIs('productCategory') || request()->routeIs('productView')));
                    @endphp
                    <li class="{{ $mActive ? 'active' : '' }}">
                        <a href="{{ asset($m->menuLink()) }}">{{ $m->menuName() }} @if($mItems->count())<i class="fa-solid fa-chevron-down"></i>@endif</a>
                        @if($mItems->count())
                        <div class="zh-drop tx-dropdown">
                            @foreach($mItems as $sm)
                            <a href="{{ $sm[1] }}" class="{{ rtrim($sm[1], '/') == $txCurrent ? 'active' : '' }}">{{ $sm[0] }}</a>
                            @endforeach
                        </div>
                        @endif
                    </li>
                    @endforeach
                @else
                    <li class="{{ request()->routeIs('index') ? 'active' : '' }}"><a href="{{route('index')}}">Home</a></li>
                    <li><a href="{{route('products')}}">Products</a></li>
                @endif
            </ul>
            @if(general()->mobile)
            <a href="tel:{{ preg_replace('/[^0-9+]/', '', general()->mobile) }}" class="zh-call">
                <i class="ti ti-phone-call"></i>
                <span><small>Call Us Now!</small><b>{{ general()->mobile }}</b></span>
            </a>
            @endif
        </nav>

        <button class="zh-toggle" type="button" onclick="txToggleNav(true)" aria-label="Menu"><i class="fa-solid fa-bars"></i></button>
    </div>
</header>
