@extends(welcomeTheme().'layouts.master')
@section('title')
<title>{{$page->seo_title?:websiteTitle($page->name)}}</title>
@endsection
@section('SEO')
<meta name="title" property="og:title" content="{{$page->seo_title?:websiteTitle($page->name)}}" />
<meta name="description" property="og:description" content="{!!$page->seo_description?:general()->meta_description!!}" />
<meta name="keywords" content="{{$page->seo_keyword?:general()->meta_keyword}}" />
<meta name="image" property="og:image" content="{{asset($page->image())}}" />
<meta name="url" property="og:url" content="{{route('pageView',$page->slug?:'no-title')}}" />
<link rel="canonical" href="{{route('pageView',$page->slug?:'no-title')}}">
@endsection
@push('css')
<style>
    .zf-home{font-family:'Rubik',sans-serif;color:#222;font-size:14px;line-height:1.7}
    .zf-home h1,.zf-home h2,.zf-home h3,.zf-home h4,.zf-home h5{font-family:'Teko',sans-serif;font-weight:500;color:#1d1d1d;margin:0;line-height:1.1;text-transform:none}
    .zf-home p{margin:0}
    .zf-home img{max-width:100%;display:block}
    .zf-sub{display:block;font-size:11px;font-weight:600;letter-spacing:.5px;text-transform:uppercase;color:#e2231a;margin-bottom:8px}
    .zf-wrap{max-width:1170px;margin:0 auto;padding:0 15px}
    .zf-center{text-align:center}
    .zf-btn{display:inline-block;background:#e2231a;color:#fff;font-family:'Teko',sans-serif;font-size:17px;letter-spacing:.5px;text-transform:uppercase;padding:12px 30px 9px;border:0;text-decoration:none;transition:.3s}
    .zf-btn:hover{background:#b8160f;color:#fff}

    /* Page banner: same white frame as the home hero */
    .zf-pbanner{position:relative;height:460px;display:flex;align-items:center;background:#1a3c8f center/cover no-repeat}
    .zf-pbanner::before{content:"";position:absolute;inset:0;background:rgba(10,30,90,.45)}
    .zf-pbanner .zf-wrap{position:relative;width:100%}
    .zf-pbox{position:relative;display:inline-block;padding:45px 45px 40px}
    .zf-pbox::before{content:"";position:absolute;left:0;top:0;bottom:0;width:260px;border:9px solid #fff;border-right:0;transform:scaleY(0);transform-origin:top;animation:zfFrame .8s ease .2s forwards}
    .zf-pbox::after{content:"";position:absolute;left:0;top:0;width:260px;border-top:9px solid #fff}
    @keyframes zfFrame{to{transform:scaleY(1)}}
    .zf-pbox h1{color:#fff;font-size:76px;position:relative}
    .zf-crumb{display:flex;gap:10px;list-style:none;margin:6px 0 0;padding:0;font-family:'Teko',sans-serif;font-size:18px;color:#fff;position:relative}
    .zf-crumb li + li::before{content:"/";margin-right:10px;color:#e2231a}
    .zf-crumb a{color:#fff;text-decoration:none}
    .zf-crumb a:hover{color:#e2231a}

    /* Who we are */
    .zf-who{background:#f2f2f2;padding:100px 0}
    .zf-who .zf-wrap{display:grid;grid-template-columns:1fr 1fr;gap:70px;align-items:center}
    .zf-who-imgs{position:relative;padding:0 60px 60px 0}
    .zf-who-imgs .main{height:460px;overflow:hidden}
    .zf-who-imgs .main img,.zf-who-imgs .small img{width:100%;height:100%;object-fit:cover}
    .zf-who-imgs .small{position:absolute;right:-27px;top:-60px;width:196px;height:230px;border:10px solid #f2f2f2;overflow:hidden}
    .zf-who-imgs .badge{position:absolute;left:-15px;top:30px;background:#e2231a;color:#fff;padding:18px 24px;text-align:center}
    .zf-who-imgs .badge b{display:block;font-family:'Teko',sans-serif;font-size:48px;font-weight:500;line-height:.9}
    .zf-who-imgs .badge small{font-family:'Teko',sans-serif;font-size:15px;text-transform:uppercase;line-height:1.1;display:block}
    .zf-who-text h2{font-size:52px;margin-bottom:22px}
    .zf-who-text .desc p{text-align:justify;margin-bottom:14px}
    .zf-checks{display:grid;grid-template-columns:1fr 1fr;gap:10px 20px;list-style:none;padding:0;margin:22px 0 30px}
    .zf-checks li{display:flex;gap:10px;align-items:center;font-family:'Teko',sans-serif;font-size:18px}
    .zf-checks i{color:#e2231a}

    /* Stats strip */
    .zf-stats-row{background:#fff;padding:0 0 100px;margin-top:-1px}
    .zf-stat-grid{display:grid;grid-template-columns:repeat(6,1fr);gap:15px;transform:translateY(-50%);margin-bottom:-95px}
    .zf-stat{background:#fff;height:190px;display:flex;flex-direction:column;align-items:center;justify-content:center;text-align:center;box-shadow:0 2px 12px rgba(0,0,0,.06);transition:.3s}
    .zf-stat:hover{transform:translateY(-5px);box-shadow:0 10px 25px rgba(0,0,0,.1)}
    .zf-stat i{font-size:44px;color:#e2231a;margin-bottom:12px}
    .zf-stat b{display:block;font-family:'Teko',sans-serif;font-size:40px;font-weight:500;line-height:.9}
    .zf-stat small{font-family:'Teko',sans-serif;font-size:15px;text-transform:uppercase;line-height:1.15;letter-spacing:.5px}

    /* Mission / vision / values */
    .zf-mvv{background:#fff;padding:0 0 100px}
    .zf-mvv h2,.zf-cats h2,.zf-steps h2{font-size:56px;margin-bottom:45px}
    .zf-mvv h2 b,.zf-cats h2 b,.zf-steps h2 b{color:#e2231a;font-weight:600}
    .zf-mvv-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:30px}
    .zf-mvv-card{position:relative;background:#f2f2f2;padding:45px 35px 40px;text-align:left;overflow:hidden;transition:.4s}
    .zf-mvv-card::before{content:"";position:absolute;left:0;top:0;width:100%;height:4px;background:#e2231a;transform:scaleX(0);transform-origin:left;transition:.4s}
    .zf-mvv-card:hover{background:#2a2b30}
    .zf-mvv-card:hover::before{transform:scaleX(1)}
    .zf-mvv-card i{font-size:50px;color:#e2231a;margin-bottom:18px;display:block}
    .zf-mvv-card h4{font-size:30px;margin-bottom:12px;transition:.4s}
    .zf-mvv-card p{transition:.4s}
    .zf-mvv-card:hover h4{color:#fff}
    .zf-mvv-card:hover p{color:#b5b5b5}
    .zf-mvv-card .num{position:absolute;right:25px;top:15px;font-family:'Teko',sans-serif;font-size:70px;line-height:1;color:rgba(0,0,0,.06);transition:.4s}
    .zf-mvv-card:hover .num{color:rgba(255,255,255,.06)}

    /* What we source */
    .zf-cats{background:#2a2b30;padding:95px 0 100px}
    .zf-cats h2{color:#fff}
    .zf-cats .zf-sub{color:#e2231a}
    .zf-cat-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:20px}
    .zf-cat{position:relative;height:380px;overflow:hidden;display:block;text-decoration:none}
    .zf-cat img{width:100%;height:100%;object-fit:cover;transition:transform .7s}
    .zf-cat:hover img{transform:scale(1.1)}
    .zf-cat::after{content:"";position:absolute;inset:0;background:linear-gradient(transparent 40%,rgba(0,0,0,.85))}
    .zf-cat div{position:absolute;left:0;right:0;bottom:0;padding:25px;z-index:1;text-align:left}
    .zf-cat h4{color:#fff;font-size:32px;border-left:4px solid #e2231a;padding-left:14px}
    .zf-cat p{color:#ccc;font-size:13px;margin-top:6px;max-height:0;overflow:hidden;transition:max-height .5s}
    .zf-cat:hover p{max-height:80px}

    /* Work process */
    .zf-steps{background:#f2f2f2;padding:95px 0 100px}
    .zf-step-grid{display:grid;grid-template-columns:repeat(5,1fr);gap:0;position:relative}
    .zf-step-grid::before{content:"";position:absolute;left:10%;right:10%;top:45px;border-top:2px dashed #ccc}
    .zf-step{position:relative;padding:0 15px;text-align:center}
    .zf-step .ico{width:90px;height:90px;margin:0 auto 22px;border-radius:50%;background:#fff;display:flex;align-items:center;justify-content:center;font-size:38px;color:#e2231a;box-shadow:0 5px 20px rgba(0,0,0,.07);position:relative;transition:.3s}
    .zf-step .ico span{position:absolute;right:-4px;top:-4px;width:28px;height:28px;border-radius:50%;background:#e2231a;color:#fff;font-family:'Teko',sans-serif;font-size:16px;line-height:30px}
    .zf-step:hover .ico{background:#e2231a;color:#fff}
    .zf-step:hover .ico span{background:#2a2b30}
    .zf-step h4{font-size:24px;margin-bottom:6px}
    .zf-step p{font-size:13px}

    /* At a glance (shared look with home) */
    .zf-glance{background:#e2231a;padding:85px 0 95px;color:#fff}
    .zf-glance .zf-wrap{display:grid;grid-template-columns:400px 480px 1fr;align-items:start}
    .zf-glance .zf-sub{color:#fff;font-size:10px}
    .zf-glance h2{color:#fff;font-size:44px}
    .zf-bars{padding-right:30px}
    .zf-bar{margin-bottom:30px}
    .zf-bar label{display:flex;justify-content:space-between;font-family:'Teko',sans-serif;font-size:16px;margin-bottom:2px}
    .zf-bar .track{height:12px;border:1px solid rgba(255,255,255,.7);padding:2px}
    .zf-bar .fill{height:100%;width:0;background:#fff;transition:width 1.8s ease}
    .zf-happy{background:rgba(255,255,255,.18);display:flex;align-items:center;gap:22px;padding:18px 25px;max-width:280px;margin-left:auto}
    .zf-happy i{font-size:44px}
    .zf-happy b{font-family:'Teko',sans-serif;font-size:32px;font-weight:500;line-height:1;display:block}
    .zf-happy small{font-size:10px;font-weight:600}

    /* CTA */
    .zf-cta-wrap{background:linear-gradient(#e2231a 50%,#fff 50%);padding-bottom:110px}
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
        .zf-who .zf-wrap{gap:40px}
        .zf-stat-grid{grid-template-columns:repeat(3,1fr);transform:none;margin:0;padding-top:60px}
        .zf-stats-row{padding-bottom:80px}
        .zf-cat-grid{grid-template-columns:repeat(2,1fr)}
        .zf-glance .zf-wrap{grid-template-columns:1fr 1fr;gap:30px}
        .zf-happy{margin-left:0}
        .zf-cta{padding:40px}
    }
    @media (max-width:991px){
        .zf-pbanner{height:360px}
        .zf-pbox h1{font-size:56px}
        .zf-who{padding:70px 0}
        .zf-who .zf-wrap{grid-template-columns:1fr}
        .zf-mvv-grid{grid-template-columns:1fr}
        .zf-step-grid{grid-template-columns:repeat(2,1fr);gap:40px 0}
        .zf-step-grid::before{display:none}
        .zf-glance .zf-wrap{grid-template-columns:1fr}
        .zf-cta{flex-direction:column;text-align:center;margin:0 15px}
        .zf-cta-mail{border-left:0;padding:0}
    }
    @media (max-width:575px){
        .zf-pbanner{height:300px}
        .zf-pbox{padding:30px 25px}
        .zf-pbox::before,.zf-pbox::after{width:180px}
        .zf-pbox h1{font-size:44px}
        .zf-who-imgs{padding:0 30px 40px 0}
        .zf-who-imgs .main{height:320px}
        .zf-who-imgs .small{width:160px;height:150px;border-width:6px}
        .zf-who-text h2,.zf-mvv h2,.zf-cats h2,.zf-steps h2{font-size:38px}
        .zf-checks{grid-template-columns:1fr}
        .zf-stat-grid{grid-template-columns:repeat(2,1fr)}
        .zf-cat-grid{grid-template-columns:1fr}
        .zf-cat{height:300px}
        .zf-cat p{max-height:none}
        .zf-step-grid{grid-template-columns:1fr}
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
    $zfStats = [
        ['fa-solid fa-globe', '40+', 'Trusted<br>Clients'],
        ['fa-solid fa-truck-fast', '5000+', 'Shipments'],
        ['fa-solid fa-certificate', '13+', 'Years of<br>Experience'],
        ['fa-solid fa-person-chalkboard', '45', 'Visited<br>Conference'],
        ['fa-solid fa-industry', '13+', 'Compliance<br>Factories'],
        ['fa-solid fa-shirt', '1M', 'PCS/Month<br>Production'],
    ];
    $zfMvv = [
        ['ti ti-target-arrow', 'Our Mission', 'To source and deliver the best quality garments at a competitive price, on time, every time, while building long term partnerships with our buyers.'],
        ['ti ti-eye', 'Our Vision', 'To be the most trusted apparel sourcing and export partner from Bangladesh for brands and chain stores across the US, EU and beyond.'],
        ['ti ti-heart-handshake', 'Our Values', 'Honesty, transparency and commitment. We follow ethical sourcing, work only with compliant factories and stand by every order we ship.'],
    ];
    $zfCats = [
        ['Woven', 'Shirts, trousers, chinos and casual wear in cotton and blended fabrics.', '1602810318383-e386cc2a3ccf'],
        ['Denim', 'Jeans, jackets and shorts with modern washes and finishes.', '1541099649105-f69ad21f3246'],
        ['Knit', 'T-shirts, polos, hoodies and sweatshirts for every season.', '1521572163474-6864f9cf17ab'],
        ['Sweater', 'Pullovers, cardigans and flat-knit sweaters for men, women and kids.', '1631541909061-71e349d1f203'],
    ];
    $zfSteps = [
        ['ti ti-messages', 'Merchandising', 'Understanding your design, price and timeline.'],
        ['ti ti-bulb', 'R&D', 'Fabric, trims and costing from our in-house team.'],
        ['ti ti-needle-thread', 'Sampling', 'Fast proto, fit and PP sample submission.'],
        ['ti ti-shield-check', 'QA &amp; QC', 'Inline and final inspection at 2.5 AQL.'],
        ['ti ti-ship', 'Delivery', 'Production follow-up and on time shipment.'],
    ];
    $zfBars = [
        ['R&D and Product Development', 100],
        ['On Time Delivery', 100],
        ['Fast Response and Sample Submission', 100],
        ['Quality Standard 2.5 AQL', 100],
    ];
    $zfBanner = $page->bannerFile ? asset($page->banner()) : $zfImg('1558769132-cb1aea458c5e', 1920);
    $zfMain = $page->imageFile ? asset($page->image()) : asset('images/about-main.jpg');
@endphp

<div class="zf-home">

<!-- ================= Banner ================= -->
<section class="zf-pbanner" style="background-image:url('{{ $zfBanner }}')">
    <div class="zf-wrap">
        <div class="zf-pbox">
            <h1>{{ $page->name }}</h1>
            <ul class="zf-crumb">
                <li><a href="{{ route('index') }}">Home</a></li>
                <li>{{ $page->name }}</li>
            </ul>
        </div>
    </div>
</section>

<!-- ================= Who we are ================= -->
<section class="zf-who">
    <div class="zf-wrap">
        <div class="zf-who-imgs">
            <div class="main"><img src="{{ $zfMain }}" alt="{{ $zfName }}"></div>
            <div class="small"><img src="{{ asset('images/about-rack.jpg') }}" alt="Garment samples" loading="lazy"></div>
            <div class="badge"><b>13+</b><small>Years Of<br>Experience</small></div>
        </div>
        <div class="zf-who-text">
            <span class="zf-sub">Who We Are</span>
            <h2>The Leading Apparel<br>Sourcing And Exporter</h2>
            <div class="desc">
                <p>{{ $zfName }} is a leading multinational apparel buying hub, sourcing company and committed exporter of woven, denim, knit, sweater and more. We source the best quality garments for internationally reputed buyers, importers and departmental chain stores in the US, RU, EU and other markets.</p>
                <p>Since our establishment, we have built long term trade relationships with our customers and earned their trust in their respective markets through quality products, fair pricing and on time delivery.</p>
            </div>
            <ul class="zf-checks">
                <li><i class="fa-solid fa-circle-check"></i> Compliance Factories</li>
                <li><i class="fa-solid fa-circle-check"></i> In-House R&amp;D Team</li>
                <li><i class="fa-solid fa-circle-check"></i> Quality Standard 2.5 AQL</li>
                <li><i class="fa-solid fa-circle-check"></i> On Time Delivery</li>
            </ul>
            <a href="{{ route('products') }}" class="zf-btn">Explore Our Products</a>
        </div>
    </div>
</section>

<!-- ================= Stats ================= -->
<section class="zf-stats-row">
    <div class="zf-wrap">
        <div class="zf-stat-grid">
            @foreach($zfStats as $s)
            <div class="zf-stat">
                <i class="{{ $s[0] }}"></i>
                <b>{{ $s[1] }}</b>
                <small>{!! $s[2] !!}</small>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ================= Mission / Vision / Values ================= -->
<section class="zf-mvv">
    <div class="zf-wrap zf-center">
        <span class="zf-sub">What Drives Us</span>
        <h2>Our Mission, Vision &amp; <b>Values</b></h2>
        <div class="zf-mvv-grid">
            @foreach($zfMvv as $k => $m)
            <div class="zf-mvv-card">
                <span class="num">0{{ $k + 1 }}</span>
                <i class="{{ $m[0] }}"></i>
                <h4>{{ $m[1] }}</h4>
                <p>{{ $m[2] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ================= What we source ================= -->
<section class="zf-cats">
    <div class="zf-wrap zf-center">
        <span class="zf-sub">Our Product Range</span>
        <h2>What We <b>Source</b></h2>
        <div class="zf-cat-grid">
            @foreach($zfCats as $c)
            <a href="{{ route('products') }}" class="zf-cat">
                <img src="{{ $zfImg($c[2], 600) }}" alt="{{ $c[0] }}" loading="lazy">
                <div>
                    <h4>{{ $c[0] }}</h4>
                    <p>{{ $c[1] }}</p>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>

<!-- ================= Work process ================= -->
<section class="zf-steps">
    <div class="zf-wrap zf-center">
        <span class="zf-sub">How We Work</span>
        <h2>From Development To <b>Delivery</b></h2>
        <div class="zf-step-grid">
            @foreach($zfSteps as $k => $s)
            <div class="zf-step">
                <div class="ico"><i class="{{ $s[0] }}"></i><span>{{ $k + 1 }}</span></div>
                <h4>{!! $s[1] !!}</h4>
                <p>{{ $s[2] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ================= At a glance ================= -->
<section class="zf-glance">
    <div class="zf-wrap">
        <div>
            <span class="zf-sub">Why Choose Us</span>
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

<!-- ================= CTA ================= -->
<div class="zf-cta-wrap">
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
