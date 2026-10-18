@extends(welcomeTheme().'layouts.master')
@section('title')
<title>{{websiteTitle($service->seo_title?:$service->name)}}</title>
@endsection
@section('SEO')
<meta name="title" property="og:title" content="{{$service->seo_title?:$service->name.' | '.general()->title}}" />
<meta name="description" property="og:description" content="{{$service->seo_description?:Str::limit(strip_tags((string)$service->short_description),160)?:$service->name.' '.general()->meta_description}}" />
<meta name="keywords" content="{{$service->seo_keyword?:$service->name.' '.general()->meta_keyword}}" />
<meta name="image" property="og:image" content="{{asset($service->image())}}" />
<meta name="url" property="og:url" content="{{route('serviceView',$service->slug?:Str::slug($service->name))}}" />
<link rel="canonical" href="{{route('serviceView',$service->slug?:Str::slug($service->name))}}">
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
    .zf-crumb{display:flex;flex-wrap:wrap;gap:10px;list-style:none;margin:6px 0 0;padding:0;font-family:'Teko',sans-serif;font-size:18px;color:#fff;position:relative}
    .zf-crumb li + li::before{content:"/";margin-right:10px;color:#e2231a}
    .zf-crumb a{color:#fff;text-decoration:none}
    .zf-crumb a:hover{color:#e2231a}

    /* Layout */
    .zf-svc{background:#f2f2f2;padding:100px 0}
    .zf-svc .zf-wrap{display:grid;grid-template-columns:330px 1fr;gap:45px;align-items:start}
    .zf-side{position:sticky;top:140px;display:flex;flex-direction:column;gap:25px}
    .zf-side-box{background:#2a2b30;padding:30px 0 15px}
    .zf-side-box h3{color:#fff !important;font-size:30px;padding:0 28px 14px;margin-bottom:8px !important;border-bottom:1px solid rgba(255,255,255,.08)}
    .zf-side-box ul{list-style:none;margin:0;padding:0}
    .zf-side-box a{display:flex;justify-content:space-between;align-items:center;padding:13px 28px;color:#ccc;text-decoration:none;font-family:'Teko',sans-serif;font-size:19px;border-left:4px solid transparent;transition:.3s}
    .zf-side-box a i{font-size:13px;opacity:.5;transition:.3s}
    .zf-side-box a:hover,.zf-side-box a.active{color:#fff;background:rgba(255,255,255,.04);border-left-color:#e2231a}
    .zf-side-box a.active i,.zf-side-box a:hover i{opacity:1;color:#e2231a;transform:translateX(3px)}
    .zf-side-help{position:relative;background:#e2231a center/cover no-repeat;padding:40px 30px;color:#fff;text-align:center;overflow:hidden}
    .zf-side-help::before{content:"";position:absolute;inset:0;background:rgba(226,35,26,.88)}
    .zf-side-help > *{position:relative}
    .zf-side-help i.big{font-size:46px;display:block;margin-bottom:10px}
    .zf-side-help h4{color:#fff !important;font-size:30px;margin-bottom:6px}
    .zf-side-help p{font-size:13px;margin-bottom:16px}
    .zf-side-help a{display:block;color:#fff;font-family:'Teko',sans-serif;font-size:22px;text-decoration:none;line-height:1.3}

    .zf-svc-main{background:#fff}
    .zf-svc-img{height:440px;overflow:hidden}
    .zf-svc-img img{width:100%;height:100%;object-fit:cover}
    .zf-svc-body{padding:50px 50px 55px}
    .zf-svc-body > h2{font-size:52px;margin-bottom:16px}
    .zf-svc-lead{font-size:16px;line-height:1.8;color:#444;border-left:4px solid #e2231a;padding-left:20px;margin-bottom:28px !important}
    .zf-content p{margin-bottom:16px;text-align:justify;line-height:1.85}
    .zf-content h3,.zf-content h4{font-size:32px;margin:30px 0 14px}
    .zf-content ul{list-style:none;padding:0;margin:0 0 20px;display:grid;grid-template-columns:1fr 1fr;gap:12px 25px}
    .zf-content ul li{position:relative;padding-left:28px}
    .zf-content ul li::before{content:"\f058";font-family:'Font Awesome 6 Free';font-weight:900;position:absolute;left:0;top:0;color:#e2231a}
    .zf-gallery{display:grid;grid-template-columns:repeat(3,1fr);gap:12px;margin-top:30px}
    .zf-gallery a{height:170px;overflow:hidden;display:block}
    .zf-gallery img{width:100%;height:100%;object-fit:cover;transition:transform .6s}
    .zf-gallery a:hover img{transform:scale(1.08)}

    /* FAQ (accordion JS lives in master layout) */
    .zf-faq{margin-top:40px}
    .zf-faq > h3{font-size:36px;margin-bottom:18px !important}
    .zf-home .tx-faq-item{border:1px solid #e5e5e5;margin-bottom:12px;background:#fff}
    .zf-home .tx-faq-q{width:100%;display:flex;justify-content:space-between;align-items:center;gap:15px;background:none;border:0;padding:16px 20px;text-align:left;font-family:'Teko',sans-serif;font-size:21px;color:#1d1d1d;cursor:pointer}
    .zf-home .tx-faq-q span{flex:0 0 32px;width:32px;height:32px;display:flex;align-items:center;justify-content:center;background:#f2f2f2;color:#e2231a;font-size:12px;border-radius:0}
    .zf-home .tx-faq-item.open .tx-faq-q{border-bottom:1px solid #e5e5e5}
    .zf-home .tx-faq-item.open .tx-faq-q span{background:#e2231a;color:#fff}
    .zf-home .tx-faq-a{padding:18px 20px;font-size:14px;color:#555;line-height:1.8}

    /* CTA */
    .zf-cta-wrap{background:linear-gradient(#f2f2f2 50%,#fff 50%);padding-bottom:110px}
    .zf-cta{max-width:1200px;margin:0 auto;background:#fff;box-shadow:0 5px 30px rgba(0,0,0,.08);display:flex;align-items:center;padding:42px 90px;gap:40px}
    .zf-cta .zf-sub{font-family:'Teko',sans-serif;letter-spacing:2px;font-weight:400;font-size:14px}
    .zf-cta h3{font-size:44px}
    .zf-cta-left{flex:1}
    .zf-btn-line{display:inline-block;border:2px solid #222;font-family:'Teko',sans-serif;font-size:16px;text-transform:uppercase;color:#222;padding:12px 26px 9px;text-decoration:none;transition:.3s;white-space:nowrap}
    .zf-btn-line:hover{background:#e2231a;border-color:#e2231a;color:#fff}

    @media (max-width:991px){
        .zf-pbanner{height:360px}
        .zf-pbox h1{font-size:52px}
        .zf-svc{padding:70px 0}
        .zf-svc .zf-wrap{grid-template-columns:1fr}
        .zf-svc-main{order:-1}
        .zf-side{position:static}
        .zf-cta{flex-direction:column;text-align:center;margin:0 15px;padding:40px}
    }
    @media (max-width:575px){
        .zf-pbanner{height:300px}
        .zf-pbox{padding:30px 25px}
        .zf-pbox::before,.zf-pbox::after{width:180px}
        .zf-pbox h1{font-size:40px}
        .zf-svc-img{height:260px}
        .zf-svc-body{padding:32px 22px}
        .zf-svc-body > h2{font-size:38px}
        .zf-content ul{grid-template-columns:1fr}
        .zf-gallery{grid-template-columns:repeat(2,1fr)}
        .zf-cta{padding:30px 20px}
    }
</style>
@endpush

@section('contents')
@php
    $faqs = serviceFaqs($service);
    $gallery = $service->galleryFiles;
    $zfImg = fn($id, $w = 1200) => 'https://images.unsplash.com/photo-'.$id.'?auto=format&fit=crop&w='.$w.'&q=75';
    // Fallback photos until an image is uploaded from Admin > Services
    $zfPhotos = [
        'research-development' => '1528578577235-b963df6db908',
        'sample-development' => '1523381210434-271e8be1f52b',
        'merchandising' => '1520006403909-838d6b92c22e',
        'fabric-sourcing' => '1558769132-cb1aea458c5e',
        'production' => '1581091226825-a6a2a5aee158',
        'qa-and-qc' => '1558171813-4c088753af8f',
        'delivery-and-shipment' => '1494412574643-ff11b0a5c1c3',
        'trimming-accessories' => '1605518216938-7c31b7b14ad0',
    ];
    $zfPhoto = $zfPhotos[$service->slug] ?? '1586363104862-3a5e2ab60d99';
    $svcImage = $service->imageFile ? asset($service->image()) : $zfImg($zfPhoto, 1100);
    $svcBanner = $service->bannerFile ? asset($service->banner()) : $zfImg($zfPhoto, 1920);
@endphp

<div class="zf-home">

<!-- ================= Banner ================= -->
<section class="zf-pbanner" style="background-image:url('{{ $svcBanner }}')">
    <div class="zf-wrap">
        <div class="zf-pbox">
            <h1>{{ $service->name }}</h1>
            <ul class="zf-crumb">
                <li><a href="{{ route('index') }}">Home</a></li>
                <li>Services</li>
                <li>{{ $service->name }}</li>
            </ul>
        </div>
    </div>
</section>

<!-- ================= Service ================= -->
<section class="zf-svc">
    <div class="zf-wrap">
        <aside class="zf-side">
            <div class="zf-side-box">
                <h3>Our Services</h3>
                <ul>
                    @foreach($relatedServices as $s)
                    <li><a href="{{ route('serviceView', $s->slug?:'no-title') }}" class="{{ $s->id == $service->id ? 'active' : '' }}">{{ $s->name }} <i class="fa-solid fa-arrow-right"></i></a></li>
                    @endforeach
                </ul>
            </div>
            <div class="zf-side-help" style="background-image:url('{{ $zfImg('1522071820081-009f0129c71c', 600) }}')">
                <i class="ti ti-headset big"></i>
                <h4>Need Any Help?</h4>
                <p>Talk to our team about your next order.</p>
                @if(general()->mobile)
                <a href="tel:{{ preg_replace('/[^0-9+]/', '', general()->mobile) }}">{{ general()->mobile }}</a>
                @endif
                @if(general()->email)
                <a href="mailto:{{ general()->email }}">{{ general()->email }}</a>
                @endif
            </div>
        </aside>

        <div class="zf-svc-main">
            <div class="zf-svc-img"><img src="{{ $svcImage }}" alt="{{ $service->name }}"></div>
            <div class="zf-svc-body">
                <span class="zf-sub">Our Services</span>
                <h2>{{ $service->name }}</h2>

                @if($service->short_description)
                <p class="zf-svc-lead">{!! nl2br(e($service->short_description)) !!}</p>
                @endif

                <div class="zf-content">{!! $service->description !!}</div>

                @if($gallery->count())
                <div class="zf-gallery">
                    @foreach($gallery as $g)
                    <a href="{{ asset($g->file_url) }}" target="_blank"><img src="{{ asset($g->file_url) }}" alt="{{ $service->name }}" loading="lazy"></a>
                    @endforeach
                </div>
                @endif

                @if(count($faqs))
                <div class="zf-faq">
                    <h3>Frequently Asked Questions</h3>
                    @foreach($faqs as $i => $f)
                    <div class="tx-faq-item {{ $i == 0 ? 'open' : '' }}">
                        <button type="button" class="tx-faq-q">{{ $f['q'] }} <span><i class="fa-solid {{ $i == 0 ? 'fa-minus' : 'fa-plus' }}"></i></span></button>
                        <div class="tx-faq-a">{!! nl2br(e($f['a'] ?? '')) !!}</div>
                    </div>
                    @endforeach
                </div>
                @endif
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
        <a href="{{ templateUrl('Contact Us') }}" class="zf-btn-line">Contact Us</a>
    </div>
</div>

</div>
@endsection
