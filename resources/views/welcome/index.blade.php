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
    .zf-red{color:#e2231a}
    .zf-sub{display:block;font-size:11px;font-weight:600;letter-spacing:.5px;text-transform:uppercase;color:#e2231a;margin-bottom:8px}
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
    .zf-dots button.active{background:#e2231a;border-color:#e2231a;width:30px;border-radius:6px}
    .zf-arrow{position:absolute;top:50%;transform:translateY(-50%);z-index:3;width:50px;height:50px;border:2px solid rgba(255,255,255,.6);background:transparent;color:#fff;font-size:18px;cursor:pointer;opacity:0;transition:.3s}
    .zf-hero:hover .zf-arrow{opacity:1}
    .zf-arrow:hover{background:#e2231a;border-color:#e2231a}
    .zf-arrow.prev{left:25px}
    .zf-arrow.next{right:25px}
    .zf-hero-box .zf-tag{font-family:'Teko',sans-serif;color:#fff;font-size:18px;letter-spacing:1px;margin-bottom:8px;display:block}
    .zf-hero-box h1,.zf-hero-box h2{color:#fff;font-size:76px;line-height:1.05}
    .zf-hero-actions{display:flex;align-items:center;gap:18px;margin-top:28px;position:relative;z-index:1}
    .zf-btn{display:inline-block;background:#e2231a;color:#fff;font-family:'Teko',sans-serif;font-size:17px;letter-spacing:.5px;text-transform:uppercase;padding:12px 30px 9px;border:0;text-decoration:none;transition:.3s}
    .zf-btn:hover{background:#b8160f;color:#fff}
    .zf-hero-actions i{color:#fff;font-size:44px;line-height:1}

    /* Who we are + stats */
    .zf-about{background:#f2f2f2;position:relative}
    .zf-about .zf-wrap{display:flex;gap:65px;align-items:flex-start}
    .zf-about-card{flex:0 0 600px;max-width:600px;background:#fff;margin-top:-100px;position:relative;z-index:2}
    .zf-about-text{padding:55px 40px 40px}
    .zf-about-text h2{font-size:52px;margin-bottom:24px}
    .zf-about-text p{font-size:14px;text-align:justify;line-height:1.75}
    .zf-more{display:inline-block;margin-top:22px;font-family:'Teko',sans-serif;font-size:15px;color:#e2231a;text-transform:uppercase;text-decoration:none;border-bottom:1px solid #e2231a;line-height:1.2}
    .zf-about-img{height:345px;overflow:hidden}
    .zf-about-img img{width:100%;height:100%;object-fit:cover}
    .zf-stats{flex:1;padding-top:90px}
    .zf-stats h2{font-size:52px;margin-bottom:38px}
    .zf-stat-grid{display:grid;grid-template-columns:repeat(3,175px);gap:15px}
    .zf-stat{background:#fff;height:190px;display:flex;flex-direction:column;align-items:center;justify-content:center;text-align:center;box-shadow:0 2px 12px rgba(0,0,0,.05);transition:.3s}
    .zf-stat:hover{transform:translateY(-5px);box-shadow:0 10px 25px rgba(0,0,0,.1)}
    .zf-stat i{font-size:48px;color:#e2231a;margin-bottom:12px}
    .zf-stat b{display:block;font-family:'Teko',sans-serif;font-size:40px;font-weight:500;line-height:.9}
    .zf-stat small{font-family:'Teko',sans-serif;font-size:15px;text-transform:uppercase;line-height:1.15;letter-spacing:.5px}
    .zf-stat .pre{font-size:13px;text-transform:none}

    /* Quality / process */
    .zf-quality{background:#fff;padding:30px 0 0}
    .zf-center{text-align:center}
    .zf-quality h2{font-size:56px;margin-bottom:22px}
    .zf-quality h2 b{color:#e2231a;font-weight:600}
    .zf-quality .zf-lead{max-width:1080px;margin:0 auto 32px;font-size:13px}
    /* Marquee: the card set is rendered twice and the track slides by exactly one set, so the loop is seamless */
    .zf-process{overflow:hidden;border-top:1px solid #e5e5e5;border-bottom:1px solid #e5e5e5}
    .zf-track{display:flex;width:max-content;animation:zfMarquee 40s linear infinite}
    .zf-process:hover .zf-track{animation-play-state:paused}
    @keyframes zfMarquee{from{transform:translateX(0)}to{transform:translateX(-50%)}}
    .zf-proc{flex:0 0 auto;width:max(20vw,300px);padding:18px 18px 22px;border-right:1px solid #e5e5e5}
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

    /* Testimonials */
    .zf-testi{display:grid;grid-template-columns:1fr 1fr;min-height:575px}
    .zf-testi-left{background:#24262b;position:relative;overflow:hidden;display:flex;align-items:center;justify-content:flex-end}
    .zf-testi-left::before,.zf-testi-left::after{content:"";position:absolute;border-radius:50%;border:30px solid rgba(255,255,255,.03);width:300px;height:300px;right:-60px;top:20px}
    .zf-testi-left::after{width:180px;height:180px;right:0;top:80px;border-width:20px}
    .zf-testi-inner{position:relative;width:100%;max-width:585px;padding:60px 40px 60px 0}
    .zf-testi-inner .zf-sub{font-family:'Teko',sans-serif;color:#fff;font-size:18px;font-weight:500;letter-spacing:.5px;margin-bottom:4px}
    .zf-testi-inner h2{color:#fff;font-size:64px;margin-bottom:40px}
    /* Items are stacked in one grid cell so the box keeps the height of the tallest one */
    .zf-testi-items{display:grid}
    .zf-testi-item{grid-area:1/1;opacity:0;visibility:hidden;transform:translateX(40px);transition:opacity .8s ease,transform .8s ease,visibility .8s}
    .zf-testi-item.active{opacity:1;visibility:visible;transform:none}
    .zf-testi-item.leave{transform:translateX(-40px)}
    .zf-testi-person{display:flex;align-items:center;gap:22px;margin-bottom:38px}
    .zf-testi-person img{width:100px;height:100px;flex:0 0 100px;border-radius:50%;object-fit:cover;border:4px solid #24262b;box-shadow:0 0 0 3px #4a4c52}
    .zf-testi-person > div{border-left:4px solid #e2231a;padding:14px 0 18px 24px}
    .zf-testi-person h5{color:#fff;font-size:26px;margin-bottom:4px}
    .zf-testi-person small{color:#aaa;font-size:15px}
    .zf-testi-item p{color:#b5b5b5;font-style:italic;font-size:16px;line-height:1.75;max-width:500px}
    .zf-testi-dots{display:flex;gap:10px;margin-top:35px}
    .zf-testi-dots button{width:10px;height:10px;border-radius:5px;border:0;padding:0;background:#55575d;cursor:pointer;transition:.3s}
    .zf-testi-dots button.active{width:28px;background:#e2231a}
    .zf-testi-right{background:#ccc center/cover no-repeat}

    /* At a glance */
    .zf-glance{background:#e2231a;padding:85px 0 95px;color:#fff}
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
    .zf-cta-mail a{color:#e2231a;font-family:'Teko',sans-serif;font-size:18px;text-decoration:none}
    .zf-btn-line{display:inline-block;border:2px solid #222;font-family:'Teko',sans-serif;font-size:16px;text-transform:uppercase;color:#222;padding:12px 26px 9px;text-decoration:none;transition:.3s;white-space:nowrap}
    .zf-btn-line:hover{background:#e2231a;border-color:#e2231a;color:#fff}

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
        .zf-testi{grid-template-columns:1fr}
        .zf-testi-inner{padding:60px 30px;max-width:none}
        .zf-testi-right{min-height:380px}
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
        .zf-about-text h2,.zf-stats h2,.zf-testi-inner h2{font-size:38px}
        .zf-stat-grid{grid-template-columns:repeat(2,1fr)}
        .zf-quality h2,.zf-banner h2{font-size:36px;padding:0 15px}
        .zf-quality .zf-lead{padding:0 15px}
        .zf-proc{width:270px}
        .zf-track{animation-duration:30s}
        .zf-cert h2{font-size:38px}
        .zf-cert-logos{gap:30px}
        .zf-cert-logos .logo{height:80px}
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
        ['Merchandising', 'Dedicated Merchandising Team', '1520006403909-838d6b92c22e'],
        ['Research & Development', 'In-House R&D Team', '1528578577235-b963df6db908'],
        ['Sample Development', 'Dynamic & Experienced Team', '1523381210434-271e8be1f52b'],
        ['QA And QC', 'Experienced QA & QC Team', '1558171813-4c088753af8f'],
        ['Production', 'Experienced Production Team', '1581091226825-a6a2a5aee158'],
    ];
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
    $zfTestimonials = [
        ['name' => 'Richard', 'role' => 'Customer', 'image' => $zfImg('1507003211169-0a1dd7228f2d', 240),
         'text' => 'I have been working with '.$zfName.' for the last few years. Never did I have a chance to complain about their services. The order are always on point. I have still not received any delayed delivery from them, hope they can keep it up.'],
        ['name' => 'Dov Cohen', 'role' => 'Customer', 'image' => $zfImg('1472099645785-5658abf4ff4e', 240),
         'text' => 'I have now working with the '.$zfName.' team for 2 plus years now they have been in making our ideas. Their sampling is fast and the quality is always as promised.'],
        ['name' => 'James Smith', 'role' => 'Customer', 'image' => $zfImg('1500648767791-00dcc994a43e', 240),
         'text' => 'Great communication from development to shipment. '.$zfName.' understands our market and delivers every order with the quality we expect.'],
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
        ])->map(fn($s) => ['image' => $zfImg($s[0], 1920), 'tag' => $s[1], 'title' => $s[2], 'btnText' => $zfShort.' Company Profile', 'btnLink' => '#about']);
    }
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
                    @if($s['btnText'])<a href="{{ $s['btnLink'] }}" class="zf-btn zf-anim up d3">{{ $s['btnText'] }}</a>@endif
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
            <div class="zf-about-img"><img src="{{ $zfImg('1586363104862-3a5e2ab60d99', 900) }}" alt="{{ $zfName }}" loading="lazy"></div>
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
            <div class="zf-proc" @if($copy) aria-hidden="true" @endif>
                <div class="img"><img src="{{ $zfImg($p[2], 600) }}" alt="{{ $copy ? '' : $p[0] }}"></div>
                <h4>{{ $p[0] }} <i class="ti ti-arrow-up-right"></i></h4>
                <p>{{ $p[1] }}</p>
            </div>
            @endforeach
            @endforeach
        </div>
    </div>
</section>

<!-- ================= Banner ================= -->
<section class="zf-banner" style="background-image:url('{{ $zfImg('1605518216938-7c31b7b14ad0', 1920) }}')">
    <div>
        <span class="zf-sub">{{ $zfName }}</span>
        <h2>{{ $zfName }} Ensures the Best Quality Products</h2>
    </div>
</section>

<!-- ================= Testimonials ================= -->
<section class="zf-testi">
    <div class="zf-testi-left">
        <div class="zf-testi-inner">
            <span class="zf-sub">Testimonials</span>
            <h2>What Our Clients Say!</h2>
            <div class="zf-testi-items">
                @foreach($zfTestimonials as $k => $t)
                <div class="zf-testi-item {{ $k == 0 ? 'active' : '' }}">
                    <div class="zf-testi-person">
                        <img src="{{ $t['image'] }}" alt="{{ $t['name'] }}" loading="lazy">
                        <div>
                            <h5>{{ $t['name'] }}</h5>
                            <small>{{ $t['role'] }}</small>
                        </div>
                    </div>
                    <p>{{ $t['text'] }}</p>
                </div>
                @endforeach
            </div>
            @if(count($zfTestimonials) > 1)
            <div class="zf-testi-dots">
                @foreach($zfTestimonials as $k => $t)
                <button type="button" class="{{ $k == 0 ? 'active' : '' }}" aria-label="Testimonial {{ $k + 1 }}"></button>
                @endforeach
            </div>
            @endif
        </div>
    </div>
    <div class="zf-testi-right" style="background-image:url('{{ $zfImg('1522071820081-009f0129c71c', 1100) }}')"></div>
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
    <div class="zf-center">
        <h2>Certifications</h2>
        @include(welcomeTheme().'layouts.includes.certLogos')
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

    // Testimonials: one after another (old one slides out left, next slides in from right)
    (function(){
        var items = document.querySelectorAll('.zf-testi-item'), dots = document.querySelectorAll('.zf-testi-dots button'), i = 0, timer;
        if(items.length < 2) return;
        function go(n){
            if(n === i) return;
            var old = items[i];
            old.classList.remove('active');
            old.classList.add('leave');
            setTimeout(function(){ old.classList.remove('leave'); }, 800);
            dots[i].classList.remove('active');
            i = n;
            items[i].classList.add('active');
            dots[i].classList.add('active');
            clearInterval(timer);
            timer = setInterval(function(){ go((i + 1) % items.length); }, 6000);
        }
        dots.forEach(function(d, k){ d.addEventListener('click', function(){ go(k); }); });
        timer = setInterval(function(){ go((i + 1) % items.length); }, 6000);
    })();
</script>
@endpush
