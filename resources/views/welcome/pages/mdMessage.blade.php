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

    /* Message */
    .zf-md{background:#f2f2f2;padding:110px 0}
    .zf-md .zf-wrap{display:grid;grid-template-columns:420px 1fr;gap:80px;align-items:start}
    .zf-md-photo{position:sticky;top:140px}
    .zf-md-frame{position:relative;padding:0 0 25px 25px}
    .zf-md-frame::before{content:"";position:absolute;left:0;bottom:0;width:75%;height:80%;border:9px solid #e2231a}
    .zf-md-frame .img{position:relative;height:500px;overflow:hidden;background:#ddd}
    .zf-md-frame img{width:100%;height:100%;object-fit:cover}
    .zf-md-card{background:#2a2b30;color:#fff;padding:22px 28px;margin:-1px 0 0 25px;border-left:4px solid #e2231a}
    .zf-md-card h4{color:#fff;font-size:30px}
    .zf-md-card small{color:#b5b5b5;font-size:13px;text-transform:uppercase;letter-spacing:.5px}
    .zf-md-social{display:flex;gap:8px;margin-top:14px}
    .zf-md-social a{width:34px;height:34px;display:flex;align-items:center;justify-content:center;border:1px solid rgba(255,255,255,.25);color:#fff;text-decoration:none;transition:.3s}
    .zf-md-social a:hover{background:#e2231a;border-color:#e2231a}

    .zf-md-text{background:#fff;padding:60px 55px 55px;position:relative}
    .zf-md-text .quote{position:absolute;right:40px;top:30px;font-size:110px;line-height:1;color:rgba(226,35,26,.1)}
    .zf-md-text h2{font-size:52px;margin-bottom:26px}
    .zf-md-text h2 b{color:#e2231a;font-weight:600}
    .zf-md-body p{text-align:justify;margin-bottom:16px;font-size:15px;line-height:1.85}
    .zf-md-body > p:first-child::first-letter{float:left;font-family:'Teko',sans-serif;font-size:72px;line-height:.8;color:#e2231a;margin:8px 10px 0 0}
    .zf-md-body h3,.zf-md-body h4{font-size:28px;margin:24px 0 10px}
    .zf-md-body ul{padding-left:20px;margin-bottom:16px}
    .zf-md-sign{margin-top:34px;padding-top:26px;border-top:1px solid #e5e5e5;display:flex;align-items:center;justify-content:space-between;gap:20px;flex-wrap:wrap}
    .zf-md-sign .sign{font-family:'Teko',sans-serif;font-size:40px;font-style:italic;color:#e2231a;line-height:1}
    .zf-md-sign h5{font-size:24px}
    .zf-md-sign small{color:#777;font-size:13px}

    /* Commitments */
    .zf-md-promise{background:#e2231a;padding:70px 0}
    .zf-md-promise .zf-wrap{display:grid;grid-template-columns:repeat(4,1fr);gap:20px}
    .zf-md-promise div > i{font-size:44px;color:#fff;display:block;margin-bottom:12px}
    .zf-md-promise h4{color:#fff !important;font-size:26px;margin-bottom:4px}
    .zf-md-promise p{color:rgba(255,255,255,.85);font-size:13px}

    /* CTA */
    .zf-cta-wrap{background:linear-gradient(#e2231a 50%,#fff 50%);padding-bottom:110px}
    .zf-cta{max-width:1200px;margin:0 auto;background:#fff;box-shadow:0 5px 30px rgba(0,0,0,.08);display:flex;align-items:center;padding:42px 90px;gap:40px}
    .zf-cta .zf-sub{font-family:'Teko',sans-serif;letter-spacing:2px;font-weight:400;font-size:14px}
    .zf-cta h3{font-size:44px}
    .zf-cta-left{flex:1}
    .zf-btn-line{display:inline-block;border:2px solid #222;font-family:'Teko',sans-serif;font-size:16px;text-transform:uppercase;color:#222;padding:12px 26px 9px;text-decoration:none;transition:.3s;white-space:nowrap}
    .zf-btn-line:hover{background:#e2231a;border-color:#e2231a;color:#fff}

    @media (max-width:1199px){
        .zf-md .zf-wrap{grid-template-columns:360px 1fr;gap:45px}
        .zf-md-promise .zf-wrap{grid-template-columns:repeat(2,1fr);gap:35px}
        .zf-cta{padding:40px}
    }
    @media (max-width:991px){
        .zf-pbanner{height:360px}
        .zf-pbox h1{font-size:56px}
        .zf-md{padding:70px 0}
        .zf-md .zf-wrap{grid-template-columns:1fr}
        .zf-md-photo{position:static;max-width:420px}
        .zf-cta{flex-direction:column;text-align:center;margin:0 15px}
    }
    @media (max-width:575px){
        .zf-pbanner{height:300px}
        .zf-pbox{padding:30px 25px}
        .zf-pbox::before,.zf-pbox::after{width:180px}
        .zf-pbox h1{font-size:44px}
        .zf-md-frame .img{height:380px}
        .zf-md-text{padding:40px 22px}
        .zf-md-text h2{font-size:38px}
        .zf-md-text .quote{font-size:70px;right:20px}
        .zf-md-promise .zf-wrap{grid-template-columns:1fr}
        .zf-cta{padding:30px 20px}
    }
</style>
@endpush

@section('contents')
@php
    $zfName = 'S Plus Apparel Fashion';
    $zfImg = fn($id, $w = 1200) => 'https://images.unsplash.com/photo-'.$id.'?auto=format&fit=crop&w='.$w.'&q=75';
    // Short Description: line 1 = MD name, line 2 = designation
    $mdLines = array_values(array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', strip_tags((string) $page->short_description)))));
    $mdName = $mdLines[0] ?? 'Managing Director';
    $mdRole = $mdLines[1] ?? 'Managing Director, '.$zfName;
    $mdPhoto = $page->imageFile ? asset($page->image()) : $zfImg('1560250097-0b93528c311a', 800);
    $zfBanner = $page->bannerFile ? asset($page->banner()) : $zfImg('1558769132-cb1aea458c5e', 1920);
    $zfPromise = [
        ['ti ti-award', 'Quality First', 'Every order checked to 2.5 AQL standard.'],
        ['ti ti-clock-check', 'On Time', 'Delivery dates we commit to, we keep.'],
        ['ti ti-leaf', 'Ethical Sourcing', 'Only compliant and certified factories.'],
        ['ti ti-heart-handshake', 'Partnership', 'Long term relations built on trust.'],
    ];
@endphp

<div class="zf-home">

<!-- ================= Banner ================= -->
<section class="zf-pbanner" style="background-image:url('{{ $zfBanner }}')">
    <div class="zf-wrap">
        <div class="zf-pbox">
            <h1>{{ $page->name }}</h1>
            <ul class="zf-crumb">
                <li><a href="{{ route('index') }}">Home</a></li>
                <li><a href="{{ templateUrl('About Us') }}">About</a></li>
                <li>{{ $page->name }}</li>
            </ul>
        </div>
    </div>
</section>

<!-- ================= Message ================= -->
<section class="zf-md">
    <div class="zf-wrap">
        <div class="zf-md-photo">
            <div class="zf-md-frame">
                <div class="img"><img src="{{ $mdPhoto }}" alt="{{ $mdName }}"></div>
            </div>
            <div class="zf-md-card">
                <h4>{{ $mdName }}</h4>
                <small>{{ $mdRole }}</small>
                <div class="zf-md-social">
                    @if(general()->facebook_link)<a href="{{ general()->facebook_link }}" target="_blank" rel="noopener" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a>@endif
                    @if(general()->linkedin_link)<a href="{{ general()->linkedin_link }}" target="_blank" rel="noopener" aria-label="LinkedIn"><i class="fa-brands fa-linkedin-in"></i></a>@endif
                    @if(general()->email)<a href="mailto:{{ general()->email }}" aria-label="Email"><i class="fa-solid fa-envelope"></i></a>@endif
                </div>
            </div>
        </div>

        <div class="zf-md-text">
            <i class="fa-solid fa-quote-right quote" aria-hidden="true"></i>
            <span class="zf-sub">{{ $page->name }}</span>
            <h2>A Message From Our<br><b>Managing Director</b></h2>
            <div class="zf-md-body">
                @if(trim(strip_tags((string) $page->description)))
                {!! $page->description !!}
                @else
                <p>Welcome to {{ $zfName }}. Since the day we started, our goal has been simple: to be a sourcing partner our buyers can truly rely on. We believe that great garments are made by great people, and every order we handle carries the trust of our customers and the hard work of our teams and partner factories.</p>
                <p>Over the years we have grown into a trusted apparel sourcing and export house for woven, denim, knit and sweater products, serving buyers and chain stores across the US, EU and other markets. This growth has been possible only because we never compromise on quality, we respect delivery timelines, and we stay honest and transparent in every step.</p>
                <p>We work only with compliant factories, and we care deeply about ethical and sustainable production. Our in-house merchandising, R&amp;D and QA teams work side by side with our buyers from the first sample to the final shipment.</p>
                <p>I sincerely thank our customers, partners and team members for their continued support. We look forward to building long and successful relationships with you.</p>
                @endif
            </div>
            <div class="zf-md-sign">
                <div>
                    <span class="sign">{{ $mdName }}</span>
                    <h5>{{ $mdName }}</h5>
                    <small>{{ $mdRole }}</small>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ================= Commitments ================= -->
<section class="zf-md-promise">
    <div class="zf-wrap">
        @foreach($zfPromise as $p)
        <div>
            <i class="{{ $p[0] }}"></i>
            <h4>{{ $p[1] }}</h4>
            <p>{{ $p[2] }}</p>
        </div>
        @endforeach
    </div>
</section>

<!-- ================= CTA ================= -->
<div class="zf-cta-wrap">
    <div class="zf-cta">
        <div class="zf-cta-left">
            <span class="zf-sub">For Business Collaboration</span>
            <h3>Discuss With Our Team</h3>
        </div>
        <a href="{{ templateUrl('Contact Us') }}" class="zf-btn-line">Contact Us</a>
    </div>
</div>

</div>
@endsection
