@extends(welcomeTheme().'layouts.master')
@section('title')
<title>{{websiteTitle()}}</title>
@endsection
@section('SEO')
<meta name="title" property="og:title" content="{{general()->meta_title}}" />
<meta name="description" property="og:description" content="{!!general()->meta_description!!}" />
<meta name="keyword" property="og:keyword" content="{{general()->meta_keyword}}" />
<meta name="image" property="og:image" content="{{asset(general()->logo())}}" />
<meta name="url" property="og:url" content="{{route('index')}}" />
<link rel="canonical" href="{{route('index')}}">
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "WebPage",
    "url": "{{route('index')}}",
    "name": "{{websiteTitle()}}",
    "description": "{!!general()->meta_description!!}"
}
</script>
@endsection
@push('css')
<style>
    .zf-home{font-family:'Rubik',sans-serif;color:#222;font-size:14px;line-height:1.7}
    .zf-home h1,.zf-home h2,.zf-home h3,.zf-home h4,.zf-home h5{font-family:'Teko',sans-serif;font-weight:500;color:#1d1d1d;margin:0;line-height:1.1;text-transform:none}
    .zf-home p{margin:0}
    .zf-home img{max-width:100%;display:block}
    .zf-red{color:#fd5b00}
    .zf-sub{display:block;font-size:11px;font-weight:600;letter-spacing:.5px;text-transform:uppercase;color:#fd5b00;margin-bottom:8px}
    .zf-wrap{max-width:1170px;margin:0 auto;padding:0 15px}

    /* Hero */
    .zf-hero{position:relative;height:950px;max-height:100vh;min-height:560px;background:#1a3c8f;overflow:hidden}
    .zf-slide{position:absolute;inset:0;display:flex;align-items:center;opacity:0;visibility:hidden;transition:opacity 1.2s ease,visibility 1.2s}
    .zf-slide.active{opacity:1;visibility:visible;z-index:1}
    .zf-slide-bg{position:absolute;inset:0;background:center/cover no-repeat;transform:scale(1.15);transition:transform 7s ease-out}
    .zf-slide.active .zf-slide-bg{transform:scale(1)}
    .zf-slide::before{content:"";position:absolute;inset:0;background:rgba(10,30,90,.3);z-index:1}
    .zf-slide .zf-wrap{position:relative;width:100%;z-index:2}
    .zf-slide.right .zf-wrap{text-align:right}
    .zf-hero-box{position:relative;display:inline-block;text-align:left;padding:60px 50px 55px 50px;margin:-80px 15px 0}
    .zf-hero-box::before{content:"";position:absolute;left:0;top:0;bottom:0;width:340px;border:9px solid #fff;border-right:0;transform:scaleY(0);transform-origin:top;transition:transform .8s ease .2s}
    .zf-hero-box::after{content:"";position:absolute;left:0;top:0;width:340px;height:0;border-top:9px solid #fff}
    .zf-slide.right .zf-hero-box::before{left:auto;right:0;border-right:9px solid #fff;border-left:0}
    .zf-slide.right .zf-hero-box::after{left:auto;right:0}
    .zf-slide.active .zf-hero-box::before{transform:scaleY(1)}
    /* Text animation: each line slides in from its side, one after another */
    .zf-anim{opacity:0;transform:translateX(-60px);transition:opacity .8s ease,transform .8s ease}
    .zf-slide.right .zf-anim{transform:translateX(60px)}
    .zf-anim.up{transform:translateY(40px)!important}
    .zf-slide.active .zf-anim{opacity:1;transform:none!important}
    .zf-slide.active .zf-anim.d1{transition-delay:.5s}
    .zf-slide.active .zf-anim.d2{transition-delay:.8s}
    .zf-slide.active .zf-anim.d3{transition-delay:1.1s}
    .zf-slide.active .zf-anim.d4{transition-delay:1.4s}
    .zf-dots{position:absolute;left:50%;bottom:135px;transform:translateX(-50%);display:flex;gap:10px;z-index:3}
    .zf-dots button{width:12px;height:12px;border-radius:50%;border:2px solid #fff;background:transparent;padding:0;cursor:pointer;transition:.3s}
    .zf-dots button.active{background:#fd5b00;border-color:#fd5b00;width:30px;border-radius:6px}
    .zf-arrow{position:absolute;top:50%;transform:translateY(-50%);z-index:3;width:50px;height:50px;border:2px solid rgba(255,255,255,.6);background:transparent;color:#fff;font-size:18px;cursor:pointer;opacity:0;transition:.3s}
    .zf-hero:hover .zf-arrow{opacity:1}
    .zf-arrow:hover{background:#fd5b00;border-color:#fd5b00}
    .zf-arrow.prev{left:25px}
    .zf-arrow.next{right:25px}
    .zf-hero-box .zf-tag{font-family:'Teko',sans-serif;color:#fff;font-size:18px;letter-spacing:1px;margin-bottom:8px;display:block}
    .zf-hero-box h1,.zf-hero-box h2{color:#fff;font-size:76px;line-height:1.05}
    .zf-hero-actions{display:flex;align-items:center;gap:18px;margin-top:28px;position:relative;z-index:1}
    .zf-btn{display:inline-block;background:#fd5b00;color:#fff;font-family:'Teko',sans-serif;font-size:17px;letter-spacing:.5px;text-transform:uppercase;padding:12px 30px 9px;border:0;text-decoration:none;transition:.3s}
    .zf-btn:hover{background:#d94e00;color:#fff}
    .zf-hero-actions i{color:#fff;font-size:44px;line-height:1}

    /* Who we are + stats */
    .zf-about{background:#f2f2f2;position:relative}
    .zf-about .zf-wrap{display:flex;gap:65px;align-items:flex-start}
    .zf-about-card{flex:0 0 600px;max-width:600px;background:#fff;margin-top:-100px;position:relative;z-index:2}
    .zf-about-text{padding:55px 40px 40px}
    .zf-about-text h2{font-size:52px;margin-bottom:24px}
    .zf-about-text p{font-size:14px;text-align:justify;line-height:1.75}
    .zf-more{display:inline-block;margin-top:22px;font-family:'Teko',sans-serif;font-size:15px;color:#fd5b00;text-transform:uppercase;text-decoration:none;border-bottom:1px solid #fd5b00;line-height:1.2}
    .zf-about-img{height:345px;overflow:hidden}
    .zf-about-img img{width:100%;height:100%;object-fit:cover}
    .zf-stats{flex:1;padding-top:90px}
    .zf-stats h2{font-size:52px;margin-bottom:38px}
    .zf-stat-grid{display:grid;grid-template-columns:repeat(3,175px);gap:15px}
    .zf-stat{background:#fff;height:190px;display:flex;flex-direction:column;align-items:center;justify-content:center;text-align:center;box-shadow:0 2px 12px rgba(0,0,0,.05);transition:.3s}
    .zf-stat:hover{transform:translateY(-5px);box-shadow:0 10px 25px rgba(0,0,0,.1)}
    .zf-stat i{font-size:48px;color:#fd5b00;margin-bottom:12px}
    .zf-stat b{display:block;font-family:'Teko',sans-serif;font-size:40px;font-weight:500;line-height:.9}
    .zf-stat small{font-family:'Teko',sans-serif;font-size:15px;text-transform:uppercase;line-height:1.15;letter-spacing:.5px}
    .zf-stat .pre{font-size:13px;text-transform:none}

    /* Quality / process */
    .zf-quality{background:#fff;padding:30px 0 0}
    .zf-center{text-align:center}
    .zf-quality h2{font-size:56px;margin-bottom:22px}
    .zf-quality h2 b{color:#fd5b00;font-weight:600}
    .zf-quality .zf-lead{max-width:1080px;margin:0 auto 32px;font-size:13px}
    /* Marquee: the card set is rendered twice and the track slides by exactly one set, so the loop is seamless */
    .zf-process{overflow:hidden;border-top:1px solid #e5e5e5;border-bottom:1px solid #e5e5e5}
    .zf-track{display:flex;width:max-content;animation:zfMarquee 40s linear infinite}
    .zf-process:hover .zf-track{animation-play-state:paused}
    @keyframes zfMarquee{from{transform:translateX(0)}to{transform:translateX(-50%)}}
    .zf-proc{flex:0 0 auto;width:max(20vw,300px);padding:18px 18px 22px;border-right:1px solid #e5e5e5;display:block;color:inherit;text-decoration:none}
    a.zf-proc:hover h4{color:#fd5b00}
    @media (prefers-reduced-motion:reduce){ .zf-track{animation:none} .zf-process{overflow-x:auto} }
    .zf-proc .img{height:235px;overflow:hidden}
    .zf-proc .img img{width:100%;height:100%;object-fit:cover;transition:transform .6s}
    .zf-proc:hover .img img{transform:scale(1.08)}
    .zf-proc h4{display:flex;justify-content:space-between;align-items:center;font-size:20px;margin:18px 0 10px}
    .zf-proc h4 i{font-size:18px;color:#333}
    .zf-proc p{font-size:13px}

    /* Banner */
    .zf-banner{position:relative;height:445px;background:#1d4fb8 center/cover fixed no-repeat;display:flex;align-items:center;justify-content:center;text-align:center}
    .zf-banner::before{content:"";position:absolute;inset:0;background:rgba(20,70,190,.72)}
    .zf-banner > div{position:relative}
    .zf-banner .zf-sub{color:#fff;font-size:10px}
    .zf-banner h2{color:#fff;font-size:52px;font-style:italic}

    /* Office photos (two side by side) */
    .zf-testi{display:grid;grid-template-columns:1fr 1fr;gap:15px;padding:20px 0;background:#161515}
    .zf-testi-img{min-height:520px;background:#ccc center/cover no-repeat;border:8px solid #df6b2e;box-shadow:0 8px 25px rgba(0,0,0,.12)}

    /* At a glance */
    .zf-glance{background:#fd5b00;padding:85px 0 95px;color:#fff}
    .zf-glance .zf-wrap{display:grid;grid-template-columns:400px 480px 1fr;gap:0 0;align-items:start}
    .zf-glance .zf-sub{color:#fff;font-size:10px}
    .zf-glance h2{color:#fff;font-size:44px}
    .zf-bars{padding-right:30px}
    .zf-bar{margin-bottom:30px;position:relative}
    .zf-bar label{display:flex;justify-content:space-between;font-family:'Teko',sans-serif;font-size:16px;margin-bottom:2px}
    .zf-bar .track{height:12px;border:1px solid rgba(255,255,255,.7);padding:2px}
    .zf-bar .fill{height:100%;width:0;background:#fff;transition:width 1.8s ease}
    .zf-happy{background:rgba(255,255,255,.18);display:flex;align-items:center;gap:22px;padding:18px 25px;max-width:280px;margin-left:auto}
    .zf-happy i{font-size:44px}
    .zf-happy b{font-family:'Teko',sans-serif;font-size:32px;font-weight:500;line-height:1;display:block}
    .zf-happy small{font-size:10px;font-weight:600}

    /* Certifications */
    .zf-cert{background:#f2f2f2;padding:85px 0 0}
    .zf-cert h2{font-size:50px;text-transform:uppercase;margin-bottom:45px}

    /* CTA */
    .zf-cta-wrap{background:linear-gradient(#f2f2f2 50%,#fff 50%);padding-bottom:110px}
    .zf-cta{max-width:1200px;margin:0 auto;background:#fff;box-shadow:0 5px 30px rgba(0,0,0,.08);display:flex;align-items:center;padding:42px 90px;gap:40px}
    .zf-cta .zf-sub{font-family:'Teko',sans-serif;letter-spacing:2px;font-weight:400;font-size:14px}
    .zf-cta h3{font-size:44px}
    .zf-cta-left{flex:1}
    .zf-cta-mail{border-left:1px solid #e5e5e5;padding:10px 60px 10px 30px}
    .zf-cta-mail h5{font-size:20px}
    .zf-cta-mail a{color:#fd5b00;font-family:'Teko',sans-serif;font-size:18px;text-decoration:none}
    .zf-btn-line{display:inline-block;border:2px solid #222;font-family:'Teko',sans-serif;font-size:16px;text-transform:uppercase;color:#222;padding:12px 26px 9px;text-decoration:none;transition:.3s;white-space:nowrap}
    .zf-btn-line:hover{background:#fd5b00;border-color:#fd5b00;color:#fff}

    @media (max-width:1199px){
        .zf-about .zf-wrap{gap:35px}
        .zf-about-card{flex-basis:50%;max-width:50%}
        .zf-stat-grid{grid-template-columns:repeat(3,1fr)}
        .zf-glance .zf-wrap{grid-template-columns:1fr 1fr;gap:30px}
        .zf-happy{margin-left:0}
        .zf-cta{padding:40px}
    }
    @media (max-width:991px){
        .zf-hero{height:640px}
        .zf-hero-box h1,.zf-hero-box h2{font-size:56px}
        .zf-about .zf-wrap{flex-direction:column}
        .zf-about-card{flex-basis:auto;max-width:100%;width:100%}
        .zf-stats{padding:0 0 60px;width:100%}
        .zf-testi{grid-template-columns:1fr;gap:20px;padding:20px}
        .zf-testi-img{min-height:300px;border-width:6px}
        .zf-glance .zf-wrap{grid-template-columns:1fr}
        .zf-cta{flex-direction:column;text-align:center;margin:0 15px}
        .zf-cta-mail{border-left:0;padding:0}
        .zf-banner{background-attachment:scroll}
    }
    @media (max-width:575px){
        .zf-hero{height:520px;min-height:0}
        .zf-hero-box{padding:40px 25px;margin:0}
        .zf-hero-box::before,.zf-hero-box::after{width:220px}
        .zf-hero-box h1,.zf-hero-box h2{font-size:40px}
        .zf-about-text{padding:40px 22px 30px}
        .zf-about-text h2,.zf-stats h2{font-size:38px}
        .zf-stat-grid{grid-template-columns:repeat(2,1fr)}
        .zf-quality h2,.zf-banner h2{font-size:36px;padding:0 15px}
        .zf-quality .zf-lead{padding:0 15px}
        .zf-proc{width:270px}
        .zf-track{animation-duration:30s}
        .zf-cert h2{font-size:38px}
        .zf-cta{padding:30px 20px}
    }
</style>
@endpush

@section('contents')
@php
    $zfName = 'S Plus Apparel Fashion';
    $zfShort = 'S Plus';
    $zfImg = fn($id, $w = 1200) => 'https://images.unsplash.com/photo-'.$id.'?auto=format&fit=crop&w='.$w.'&q=75';
    $zfEmail = general()->email;
    $zfProcess = [
        ['Merchandising', 'Dedicated Merchandising Team', 'images/merchandising.jpg'],
        ['Research & Development', 'In-House R&D Team', 'images/research-development.jpg'],
        ['Sample Development', 'Dynamic & Experienced Team', 'images/sample-development.jpg'],
        ['QA And QC', 'Experienced QA & QC Team', 'images/qa-qc-rack.jpg'],
        ['Production', 'Experienced Production Team', 'images/production.jpg'],
    ];
    // Process cards link to the matching page under the "Services" header menu (matched by name)
    $zfServicesMenu = optional(menu('Header Menus'))->subMenus?->first(fn($m) => mb_strtolower(trim($m->menuName())) == 'services');
    $zfServiceLinks = $zfServicesMenu
        ? $zfServicesMenu->subMenus->mapWithKeys(fn($s) => [mb_strtolower(trim($s->menuName())) => asset($s->menuLink())])->all()
        : [];
    $zfStats = [
        ['fa-solid fa-globe', null, '40+', 'Trusted<br>Clients'],
        ['fa-solid fa-truck-fast', 'More Then', '5000', 'Shipments'],
        ['fa-solid fa-certificate', null, '13+', 'Years of<br>Experience'],
        ['fa-solid fa-person-chalkboard', null, '45', 'Visited<br>Conference'],
        ['fa-solid fa-industry', null, '13+', 'Compliance<br>Factories'],
        ['fa-solid fa-shirt', null, '1M', 'PCS/Month<br>Production'],
    ];
    $zfBars = [
        ['R&D and Product Development', 100],
        ['On Time Delivery', 100],
        ['Fast Response and Sample Submission', 100],
        ['Quality Standard 2.5 AQL', 100],
    ];
@endphp

<div class="zf-home">

<!-- ================= Hero ================= -->
@php
    // Hero slides from Admin > Sliders (location "Front Page Slider"); content alternates left / right.
    // Sub Title = small tag, Heading = big text (<br> allowed), Button Text / Link, Slide Image = background.
    $zfHeroSlider = slider('Front Page Slider');
    $zfSlides = $zfHeroSlider
        ? $zfHeroSlider->sliderItems()->where('status','active')->get()->map(fn($s) => [
            'image' => $s->imageFile ? asset($s->image()) : $zfImg('1604176354204-9268737828e4', 1920),
            'tag' => e((string) $s->short_description),
            'title' => strip_tags((string) $s->name, '<br>'),
            'btnText' => $s->seo_title,
            'btnLink' => $s->seo_description ?: '#about',
          ])->filter(fn($s) => trim(strip_tags($s['title'])) !== '')->values()
        : collect();
    if($zfSlides->isEmpty()){
        $zfSlides = collect([
            ['1604176354204-9268737828e4', 'Textile Brand In Market Since 2010', 'Textile Products And Apparel<br>Sourcing Industry'],
            ['1605518216938-7c31b7b14ad0', 'Woven, Denim, Knit &amp; Sweater', 'Best Quality Garments<br>For Global Buyers'],
            ['1523381210434-271e8be1f52b', 'Trusted RMG Sourcing And Exporter', 'From Development To<br>On Time Delivery'],
        ])->map(fn($s) => ['image' => $zfImg($s[0], 1920), 'tag' => $s[1], 'title' => $s[2], 'btnText' => $zfShort.' Company Profile', 'btnLink' => 'files/s-plus-company-profile.pdf']);
    }
    // Slider button links may be a site path like "files/x.pdf"; PDFs open in a new tab
    $zfSlides = $zfSlides->map(fn($s) => array_merge($s, [
        'btnLink' => preg_match('#^(https?:|mailto:|tel:|\#|/)#i', $s['btnLink']) ? $s['btnLink'] : asset($s['btnLink']),
        'btnNewTab' => (bool) preg_match('#\.pdf$#i', parse_url($s['btnLink'], PHP_URL_PATH) ?? ''),
    ]));
@endphp
<section class="zf-hero">
    <noscript><style>.zf-slide:first-of-type{opacity:1;visibility:visible}.zf-slide:first-of-type .zf-anim{opacity:1;transform:none}</style></noscript>
    @foreach($zfSlides as $k => $s)
    <div class="zf-slide {{ $k % 2 ? 'right' : 'left' }} ">
        <div class="zf-slide-bg" style="background-image:url('{{ $s['image'] }}')"></div>
        <div class="zf-wrap">
            <div class="zf-hero-box">
                @if($s['tag'])<span class="zf-tag zf-anim d1">{!! $s['tag'] !!}</span>@endif
                @if($k == 0)
                <h1 class="zf-anim d2">{!! $s['title'] !!}</h1>
                @else
                <h2 class="zf-anim d2">{!! $s['title'] !!}</h2>
                @endif
                <div class="zf-hero-actions">
                    @if($s['btnText'])<a href="{{ $s['btnLink'] }}" class="zf-btn zf-anim up d3" @if($s['btnNewTab']) target="_blank" rel="noopener" @endif>{{ $s['btnText'] }}</a>@endif
                    <i class="ti ti-needle-thread zf-anim up d4" aria-hidden="true"></i>
                    <i class="ti ti-shirt zf-anim up d4" aria-hidden="true"></i>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    <button type="button" class="zf-arrow prev" aria-label="Previous slide"><i class="fa-solid fa-angle-left"></i></button>
    <button type="button" class="zf-arrow next" aria-label="Next slide"><i class="fa-solid fa-angle-right"></i></button>
    <div class="zf-dots">
        @foreach($zfSlides as $k => $s)
        <button type="button" aria-label="Slide {{ $k + 1 }}"></button>
        @endforeach
    </div>
</section>

<!-- ================= Who we are + stats ================= -->
<section class="zf-about" id="about">
    <div class="zf-wrap">
        <div class="zf-about-card">
            <div class="zf-about-text">
                <span class="zf-sub">Who We Are</span>
                <h2>The Leading Apparel<br>Sourcing And Exporter</h2>
                <p>{{ $zfName }} is a leading multinational apparel buying hub, sourcing company, sourcing and committed exporter on woven, denim, knit, sweater etc. We sourcing best quality garments for all of our internationally reputed buyers/importers and departmental chain stores from US, RU, EU, etc. markets. Since our establishment, we have developed long term trade relationships with most of our potential customers &amp; earned trust in their respective markets.</p>
                <a href="#quality" class="zf-more">View More</a>
            </div>
            <div class="zf-about-img"><img src="{{ asset('images/splus-about.webp') }}" alt="{{ $zfName }}" loading="lazy"></div>
        </div>
        <div class="zf-stats">
            <span class="zf-sub">{{ $zfName }}</span>
            <h2>We Are In Textile Sourcing</h2>
            <div class="zf-stat-grid">
                @foreach($zfStats as $s)
                <div class="zf-stat">
                    <i class="{{ $s[0] }}"></i>
                    @if($s[1])<small class="pre">{{ $s[1] }}</small>@endif
                    <b>{{ $s[2] }}</b>
                    <small>{!! $s[3] !!}</small>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<!-- ================= Quality from every angle ================= -->
<section class="zf-quality" id="quality">
    <div class="zf-center">
        <span class="zf-sub">Development, Production &amp; Delivery</span>
        <h2>{{ $zfName }} Ensure The Best Quality From <b>Every Angle</b></h2>
        <p class="zf-lead">{{ $zfName }} is the largest peer-to-peer comparison initiative in the textile sourcing industry. It tracks the apparel material and home textile sector's progress.</p>
    </div>
    <div class="zf-process">
        <div class="zf-track">
            @foreach([0, 1] as $copy)
            @foreach($zfProcess as $p)
            @php $pLink = $zfServiceLinks[mb_strtolower($p[0])] ?? null; @endphp
            <{{ $pLink ? 'a' : 'div' }} class="zf-proc" @if($pLink) href="{{ $pLink }}" @endif @if($copy) aria-hidden="true" tabindex="-1" @endif>
                <div class="img"><img src="{{ str_contains($p[2], '/') ? asset($p[2]) : $zfImg($p[2], 600) }}" alt="{{ $copy ? '' : $p[0] }}"></div>
                <h4>{{ $p[0] }} <i class="ti ti-arrow-up-right"></i></h4>
                <p>{{ $p[1] }}</p>
            </{{ $pLink ? 'a' : 'div' }}>
            @endforeach
            @endforeach
        </div>
    </div>
</section>

<!-- ================= Banner ================= -->
<section class="zf-banner" style="background-image:url('{{ asset('images/sample-development.jpg') }}')">
    <div>
        <span class="zf-sub">{{ $zfName }}</span>
        <h2>{{ $zfName }} Ensures the Best Quality Products</h2>
    </div>
</section>

<!-- ================= Office photos ================= -->
<section class="zf-testi">
    <div class="zf-testi-img" style="background-image:url('{{ asset('images/splus-team.webp') }}')"></div>
    <div class="zf-testi-img" style="background-image:url('{{ asset('images/splus-office.jpg') }}')"></div>
</section>

<!-- ================= At a glance ================= -->
<section class="zf-glance">
    <div class="zf-wrap">
        <div>
            <span class="zf-sub">At A Glance</span>
            <h2>{{ $zfShort }} is Operating in<br>Apparel Industries</h2>
        </div>
        <div class="zf-bars">
            @foreach($zfBars as $b)
            <div class="zf-bar">
                <label><span>{{ $b[0] }}</span><span>{{ $b[1] }}%</span></label>
                <div class="track"><div class="fill" data-width="{{ $b[1] }}"></div></div>
            </div>
            @endforeach
        </div>
        <div>
            <div class="zf-happy">
                <i class="fa-solid fa-users"></i>
                <div><b><span class="zf-count" data-target="65">0</span> +</b><small>Happy Customer</small></div>
            </div>
        </div>
    </div>
</section>

<!-- ================= Certifications ================= -->
<section class="zf-cert">
    <div class="zf-wrap zf-center">
        <h2>Certifications</h2>
        @include(welcomeTheme().'layouts.includes.certDocs')
    </div>
</section>

<!-- ================= CTA ================= -->
<div class="zf-cta-wrap" id="contact">
    <div class="zf-cta">
        <div class="zf-cta-left">
            <span class="zf-sub">For Business Collaboration</span>
            <h3>Discuss With Our Team</h3>
        </div>
        @if($zfEmail)
        <div class="zf-cta-mail">
            <h5>Send Us Email</h5>
            <a href="mailto:{{ $zfEmail }}">{{ $zfEmail }}</a>
        </div>
        @endif
        <a href="{{ $zfEmail ? 'mailto:'.$zfEmail : '#' }}" class="zf-btn-line">Get Involved Now!</a>
    </div>
</div>

</div>
@endsection

@push('js')
<script>
    // Hero fade slider: first slide animates in on load, then auto-plays
    (function(){
        var hero = document.querySelector('.zf-hero');
        if(!hero) return;
        var slides = hero.querySelectorAll('.zf-slide'), dots = hero.querySelectorAll('.zf-dots button'), cur = -1, timer;
        function go(n){
            n = (n + slides.length) % slides.length;
            if(n === cur) return;
            if(cur > -1){ slides[cur].classList.remove('active'); dots[cur].classList.remove('active'); }
            cur = n;
            slides[cur].classList.add('active');
            dots[cur].classList.add('active');
            clearInterval(timer);
            if(slides.length > 1) timer = setInterval(function(){ go(cur + 1); }, 7000);
        }
        dots.forEach(function(d, i){ d.addEventListener('click', function(){ go(i); }); });
        hero.querySelector('.zf-arrow.prev').addEventListener('click', function(){ go(cur - 1); });
        hero.querySelector('.zf-arrow.next').addEventListener('click', function(){ go(cur + 1); });
        requestAnimationFrame(function(){ requestAnimationFrame(function(){ go(0); }); });
    })();

    // "At a glance" progress bars + happy customer counter
    (function(){
        var sec = document.querySelector('.zf-glance');
        if(!sec) return;
        function run(){
            sec.querySelectorAll('.fill').forEach(function(f){ f.style.width = f.dataset.width + '%'; });
            sec.querySelectorAll('.zf-count').forEach(function(el){
                var target = +el.dataset.target, start = null;
                function step(ts){
                    if(!start) start = ts;
                    var p = Math.min((ts - start) / 1800, 1);
                    el.textContent = Math.floor(p * target);
                    if(p < 1) requestAnimationFrame(step);
                }
                requestAnimationFrame(step);
            });
        }
        if(!('IntersectionObserver' in window)) return run();
        new IntersectionObserver(function(entries, obs){
            if(!entries[0].isIntersecting) return;
            run(); obs.disconnect();
        }, {threshold:.3}).observe(sec);
    })();
</script>
@endpush
