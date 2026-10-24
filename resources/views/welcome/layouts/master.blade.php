<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{csrf_token()}}" />
    @yield('title')
    <link rel="shortcut icon" type="image/x-icon" href="{{asset(general()->favicon())}}" />
    @yield('SEO')

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700&family=Jost:wght@400;500;600&family=Rubik:ital,wght@0,400;0,500;0,600;1,400&family=Teko:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@3.19.0/dist/tabler-icons.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap-grid.min.css" />
    <link rel="stylesheet" href="{{asset(assetLink().'/css/techwix.css')}}?v=33" />
    @stack('css')
</head>
<body>

@php
    $txMenu = menu('Header Menus');
    $txLogo = asset(assetLink().'/images/yesglobal/logo.png');
    $txCurrent = rtrim(url()->current(), '/');
    $txContactPage = \App\Models\Post::where('type',0)->where('template','Contact Us')->first(['id','slug']);
    $txContactUrl = $txContactPage ? route('pageView', $txContactPage->slug ?: 'no-title') : '#';
@endphp

<!-- Search overlay -->
<div class="tx-search-overlay" id="txSearch">
    <button class="tx-search-close" type="button" onclick="txToggleSearch(false)">&times;</button>
    <form action="{{route('blogSearch')}}">
        <input type="text" name="search" value="{{request()->search}}" placeholder="Search..." required />
        <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
    </form>
</div>

@include(welcomeTheme().'layouts.includes.zfHeader')

<main>
@yield('contents')
</main>

<!-- ================= Footer ================= -->
<footer class="tx-footer">
    <div class="container">
        <div class="tx-footer-grid">
            <div class="tx-footer-about">
                <a href="{{route('index')}}" class="zh-logo tx-footer-logo">@if(general()->logo)<img src="{{ asset(general()->logo()) }}" alt="{{ general()->title }}" class="zh-logo-img">@else<span class="zh-logo-mark">S+</span>@endif<span class="zh-logo-text">S Plus Apparel Fashion</span></a>
                <p>S Plus Apparel Fashion is a leading apparel buying hub, sourcing company and committed exporter on woven, denim, knit, sweater etc.</p>
                <div class="tx-social">
                    <a href="{{ general()->facebook_link ?: '#' }}" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="{{ general()->twitter_link ?: '#' }}" aria-label="X"><i class="fa-brands fa-x-twitter"></i></a>
                    <a href="{{ general()->linkedin_link ?: '#' }}" aria-label="LinkedIn"><i class="fa-brands fa-linkedin-in"></i></a>
                    <a href="{{ general()->instagram_link ?: '#' }}" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
                    <a href="{{ general()->youtube_link ?: '#' }}" aria-label="YouTube"><i class="fa-brands fa-youtube"></i></a>
                </div>
            </div>
            <div>
                <h5>Useful Links</h5>
                <ul class="tx-footer-links">
                    @if($fm = menu('Footer Two'))
                        @foreach($fm->subMenus as $m)
                        <li><a href="{{asset($m->menuLink())}}">{{$m->menuName()}}</a></li>
                        @endforeach
                    @else
                        <li><a href="{{route('index')}}">Home</a></li>
                        <li><a href="#">About Company</a></li>
                        <li><a href="#">Our Services</a></li>
                        <li><a href="#">Why Choose Us</a></li>
                        <li><a href="#">Contact Us</a></li>
                    @endif
                </ul>
            </div>
            <div>
                <h5>Our Products</h5>
                <ul class="tx-footer-links">
                    {{-- Items of the "Footer Three" menu win; otherwise the product categories (Admin > Products > Categories) --}}
                    @php $fm = menu('Footer Three'); @endphp
                    @if($fm && $fm->subMenus->count())
                        @foreach($fm->subMenus as $m)
                        <li><a href="{{asset($m->menuLink())}}">{{$m->menuName()}}</a></li>
                        @endforeach
                    @else
                        @foreach(\App\Models\Attribute::where('type',10)->where('status','active')->whereNull('parent_id')->orderBy('view')->orderBy('name')->limit(5)->get(['id','name','slug']) as $fc)
                        <li><a href="{{route('productCategory',$fc->slug?:'no-title')}}">{{$fc->name}}</a></li>
                        @endforeach
                    @endif
                </ul>
            </div>
            <div>
                <h5>Contact Information</h5>
                <ul class="tx-contact">
                    @if(general()->mobile)
                    <li><i class="fa-solid fa-phone-volume"></i><a href="tel:{{ preg_replace('/[^0-9+]/', '', general()->mobile) }}">{{ general()->mobile }}</a></li>
                    @endif
                    @if(general()->email)
                    <li><i class="fa-regular fa-envelope"></i><a href="mailto:{{ general()->email }}">{{ general()->email }}</a></li>
                    @endif
                    @if(general()->address_one)
                    <li><i class="fa-solid fa-location-dot"></i><span>{!! general()->address_one !!}</span></li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
    <div class="tx-copy">Copyright {{date('Y')}} {{general()->title}} All Rights Reserved</div>
</footer>

<button class="tx-top" id="txTop" type="button" aria-label="Back to top"><i class="fa-solid fa-arrow-up"></i></button>

<script>
    function txToggleSearch(open){ document.getElementById('txSearch').classList.toggle('open', open); }
    function txToggleNav(open){
        document.getElementById('txNav').classList.toggle('open', open);
        document.getElementById('txNavOverlay').classList.toggle('show', open);
        document.body.classList.toggle('tx-nav-open', open);
    }
    // Close the mobile menu with Esc, or when the screen grows to desktop width
    document.addEventListener('keydown', function(e){ if(e.key === 'Escape'){ txToggleNav(false); txToggleSearch(false); } });
    window.addEventListener('resize', function(){ if(window.innerWidth >= 1200) txToggleNav(false); });

    // Mobile: tap a parent menu item to expand its dropdown
    document.querySelectorAll('.tx-menu > li').forEach(function(li){
        if(!li.querySelector('.tx-dropdown')) return;
        li.querySelector('a').addEventListener('click', function(e){
            if(window.innerWidth < 1200){ e.preventDefault(); li.classList.toggle('open'); }
        });
    });

    // Sticky header shadow + back-to-top
    var txHeader = document.getElementById('txHeader'), txTop = document.getElementById('txTop');
    window.addEventListener('scroll', function(){
        txHeader.classList.toggle('scrolled', window.scrollY > 20);
        txTop.classList.toggle('show', window.scrollY > 400);
    });
    txTop.addEventListener('click', function(){ window.scrollTo({top:0,behavior:'smooth'}); });

    // FAQ accordion
    document.querySelectorAll('.tx-faq-q').forEach(function(q){
        q.addEventListener('click', function(){
            var item = q.parentElement, open = item.classList.contains('open');
            item.parentElement.querySelectorAll('.tx-faq-item').forEach(function(i){
                i.classList.remove('open');
                i.querySelector('.tx-faq-q i').className = 'fa-solid fa-plus';
            });
            if(!open){ item.classList.add('open'); q.querySelector('i').className = 'fa-solid fa-minus'; }
        });
    });

    // Scroll reveal animations (site-wide)
    (function(){
        if(!('IntersectionObserver' in window) || window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;
        var groups = {
            'up': [
                '.tx-hero-content > *', '.tx-banner-content > *', '.tx-sub', '.tx-title',
                '.tx-service-card', '.tx-svc-card', '.tx-counter-item', '.tx-stat', '.tx-blog-card',
                '.tx-info-card', '.tx-project-grid .tx-case-slide', '.tx-related-grid > div', '.tx-faq-item',
                '.tx-comment', '.tx-reply', '.tx-post-thumb', '.tx-author', '.tx-postnav', '.tx-single-main',
                '.tx-sidebar > div', '.tx-contact-form', '.tx-help', '.tx-cta-outer', '.tx-brand',
                '.tx-case-slider', '.tx-testi-slider', '.tx-why-slider', '.tx-slider-nav', '.tx-pagination',
                '.tx-footer-grid > div', '.tx-who-text > *'
            ],
            'left': ['.tx-who-media', '.tx-about-text', '.tx-side-box'],
            'right': ['.tx-about-imgs'],
            'zoom': ['.tx-stats']
        };
        var seen = [];
        Object.keys(groups).forEach(function(type){
            document.querySelectorAll(groups[type].join(',')).forEach(function(el){
                // Leave items inside sliders alone (the slider itself is animated) and never animate twice
                if(seen.indexOf(el) > -1 || el.closest('.swiper-wrapper, .slick-track, .tx-why-slider .tx-why-slide')) return;
                if(el.parentElement && el.parentElement.closest('.tx-reveal')) return;
                seen.push(el);
                el.classList.add('tx-reveal', 'tx-reveal-' + type);
                // Stagger siblings in the same row (cards, columns)
                var sibs = Array.prototype.filter.call(el.parentElement.children, function(c){ return seen.indexOf(c) > -1; });
                el.style.transitionDelay = (sibs.indexOf(el) % 4) * 0.12 + 's';
            });
        });
        document.documentElement.classList.add('tx-anim');
        function show(el){
            var delay = parseFloat(el.style.transitionDelay) || 0;
            el.classList.add('tx-in');
            // Hand the element back to its own hover/transition styles once revealed
            setTimeout(function(){
                el.classList.remove('tx-reveal', 'tx-reveal-up', 'tx-reveal-left', 'tx-reveal-right', 'tx-reveal-zoom', 'tx-in');
                el.style.transitionDelay = '';
            }, (delay + 0.9) * 1000);
        }
        var io = new IntersectionObserver(function(entries){
            entries.forEach(function(entry){
                if(!entry.isIntersecting) return;
                io.unobserve(entry.target);
                show(entry.target);
            });
        }, {threshold: 0, rootMargin: '0px 0px -10% 0px'});
        // Anything already on the first screen animates in right away; the rest waits for scrolling
        requestAnimationFrame(function(){
            seen.forEach(function(el){
                if(el.getBoundingClientRect().top < window.innerHeight) show(el);
                else io.observe(el);
            });
        });
    })();
</script>
@stack('js')
</body>
</html>
