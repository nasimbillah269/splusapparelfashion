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
@include(welcomeTheme().'products.includes.zfProductCss')
@push('css')
<style>
    /* Info cards */
    .zf-ct-info{background:#fff;padding:0 0 90px;position:relative;z-index:2}
    .zf-info-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:20px;margin-top:-70px}
    .zf-info{position:relative;background:#fff;padding:36px 26px 30px;box-shadow:0 10px 35px rgba(0,0,0,.08);border-bottom:3px solid #fd5b00;overflow:hidden;transition:.35s}
    .zf-info::before{content:"";position:absolute;inset:0;background:#2a2b30;transform:translateY(101%);transition:.4s;z-index:0}
    .zf-info:hover::before{transform:none}
    .zf-info > *{position:relative;z-index:1}
    .zf-info .ico{width:62px;height:62px;background:#fd5b00;color:#fff;display:flex;align-items:center;justify-content:center;font-size:28px;margin-bottom:18px;transition:.35s}
    .zf-info:hover .ico{background:#fff;color:#fd5b00}
    .zf-info h4{font-size:26px;margin-bottom:6px;transition:.35s}
    .zf-info p,.zf-info a{display:block;color:#555;font-size:14px;line-height:1.6;text-decoration:none;word-break:break-word;transition:.35s}
    .zf-info a:hover{color:#fd5b00}
    .zf-info:hover h4,.zf-info:hover p,.zf-info:hover a{color:#fff}

    /* Form + side panel */
    .zf-ct-main{background:#f2f2f2;padding:100px 0}
    .zf-ct-box{display:grid;grid-template-columns:400px 1fr;background:#fff;box-shadow:0 10px 40px rgba(0,0,0,.06)}
    .zf-ct-side{position:relative;background:#2a2b30 center/cover no-repeat;color:#fff;padding:55px 40px;overflow:hidden}
    .zf-ct-side::before{content:"";position:absolute;inset:0;background:rgba(36,38,43,.92)}
    .zf-ct-side::after{content:"";position:absolute;right:-70px;bottom:-70px;width:220px;height:220px;border-radius:50%;border:30px solid rgba(253,91,0,.25)}
    .zf-ct-side > *{position:relative;z-index:1}
    .zf-ct-side .zf-sub{color:#fd5b00}
    .zf-ct-side h3{color:#fff !important;font-size:42px;margin-bottom:14px}
    .zf-ct-side > p{color:#bbb;font-size:14px;margin-bottom:30px}
    .zf-ct-list{list-style:none;margin:0 0 35px;padding:0;display:grid;gap:22px}
    .zf-ct-list li{display:flex;gap:16px;align-items:flex-start}
    .zf-ct-list i{width:44px;height:44px;flex:0 0 44px;border:1px solid rgba(255,255,255,.2);display:flex;align-items:center;justify-content:center;color:#fd5b00;font-size:17px}
    .zf-ct-list small{display:block;color:#999;font-size:11px;text-transform:uppercase;letter-spacing:1px;font-weight:600}
    .zf-ct-list a,.zf-ct-list span{color:#fff;font-family:'Teko',sans-serif;font-size:21px;line-height:1.25;text-decoration:none;word-break:break-word}
    .zf-ct-list a:hover{color:#fd5b00}
    .zf-ct-social{display:flex;gap:8px}
    .zf-ct-social a{width:40px;height:40px;display:flex;align-items:center;justify-content:center;background:rgba(255,255,255,.08);color:#fff;text-decoration:none;transition:.3s}
    .zf-ct-social a:hover{background:#fd5b00;transform:translateY(-3px)}

    .zf-ct-form{padding:55px 55px 50px}
    .zf-ct-form h3{font-size:42px;margin-bottom:6px}
    .zf-ct-form h3 b{color:#fd5b00;font-weight:600}
    .zf-ct-form > p{color:#777;margin-bottom:30px}
    .zf-fields{display:grid;grid-template-columns:1fr 1fr;gap:20px}
    .zf-field{position:relative}
    .zf-field.full{grid-column:1 / -1}
    .zf-field label{display:block;font-family:'Teko',sans-serif;font-size:18px;color:#1d1d1d;margin-bottom:6px}
    .zf-field label span{color:#fd5b00}
    .zf-field .wrap{position:relative}
    .zf-field .wrap i{position:absolute;left:16px;top:17px;color:#aaa;font-size:15px;transition:.25s;pointer-events:none}
    .zf-input{width:100%;background:#f7f7f7;border:1px solid #e6e6e6;padding:14px 16px 14px 44px;font-family:'Rubik',sans-serif;font-size:14px;color:#222;outline:none;transition:.25s;border-radius:0}
    textarea.zf-input{min-height:150px;resize:vertical}
    .zf-input:focus{background:#fff;border-color:#fd5b00;box-shadow:0 0 0 3px rgba(253,91,0,.08)}
    .zf-field .wrap:focus-within i{color:#fd5b00}
    .zf-error{display:block;color:#fd5b00;font-size:12px;margin-top:5px}
    .zf-alert{padding:14px 18px;margin-bottom:24px;font-size:14px;display:flex;gap:10px;align-items:center}
    .zf-alert.success{background:#e9f7ef;color:#1e7e45;border-left:4px solid #1e7e45}
    .zf-alert.error{background:#fdecea;color:#b3261e;border-left:4px solid #fd5b00}
    .zf-form-foot{display:flex;align-items:center;justify-content:space-between;gap:20px;margin-top:26px;flex-wrap:wrap}
    .zf-form-foot small{color:#888;font-size:12px;display:flex;align-items:center;gap:6px}
    .zf-form-foot small i{color:#1e7e45}
    .zf-form-foot .zf-btn{cursor:pointer}


    @media (max-width:1199px){
        .zf-info-grid{grid-template-columns:repeat(2,1fr)}
        .zf-ct-box{grid-template-columns:340px 1fr}
        .zf-ct-form{padding:45px 40px}
    }
    @media (max-width:991px){
        .zf-ct-main{padding:70px 0}
        .zf-ct-box{grid-template-columns:1fr}
        .zf-ct-side{padding:45px 30px}
    }
    @media (max-width:575px){
        .zf-info-grid{grid-template-columns:1fr;margin-top:-50px}
        .zf-ct-form{padding:35px 20px}
        .zf-ct-form h3,.zf-ct-side h3{font-size:34px}
        .zf-fields{grid-template-columns:1fr}
        .zf-form-foot .zf-btn{width:100%;justify-content:center}    }
</style>
@endpush

@section('contents')
@php
    $zfImg = fn($id, $w = 1200) => 'https://images.unsplash.com/photo-'.$id.'?auto=format&fit=crop&w='.$w.'&q=75';
    $g = general();
    $zfTel = preg_replace('/[^0-9+]/', '', (string) $g->mobile);
    $zfAddress = trim(strip_tags((string) $g->address_one));
    $zfUrl = fn($v) => preg_match('#^https?://#i', (string) $v) ? $v : null;
    $zfSocial = array_filter([
        ['fa-brands fa-facebook-f', 'Facebook', $zfUrl($g->facebook_link)],
        ['fa-brands fa-linkedin-in', 'LinkedIn', $zfUrl($g->linkedin_link)],
        ['fa-brands fa-x-twitter', 'X (Twitter)', $zfUrl($g->twitter_link)],
        ['fa-brands fa-instagram', 'Instagram', $zfUrl($g->instagram_link)],
        ['fa-brands fa-youtube', 'YouTube', $zfUrl($g->youtube_link)],
    ], fn($s) => $s[2]);
@endphp

<div class="zf-home">

@include(welcomeTheme().'products.includes.zfBanner', [
    'title' => $page->name,
    'crumbs' => [[$page->name, null]],
    'bannerImage' => $page->bannerFile ? asset($page->banner()) : $zfImg('1517245386807-bb43f82c33c4', 1920),
])

<!-- ================= Info cards ================= -->
<section class="zf-ct-info">
    <div class="zf-wrap">
        <div class="zf-info-grid">
            <div class="zf-info">
                <span class="ico"><i class="fa-solid fa-phone-volume"></i></span>
                <h4>Call Us</h4>
                @if($g->mobile)<a href="tel:{{ $zfTel }}">{{ $g->mobile }}</a>@endif
                <p>Sat - Thu, 09:00 AM - 07:00 PM</p>
            </div>
            <div class="zf-info">
                <span class="ico"><i class="fa-solid fa-envelope-open-text"></i></span>
                <h4>Email Us</h4>
                @if($g->email)<a href="mailto:{{ $g->email }}">{{ $g->email }}</a>@endif
                <p>We reply within 24 hours</p>
            </div>
            <div class="zf-info">
                <span class="ico"><i class="fa-solid fa-location-dot"></i></span>
                <h4>Visit Us</h4>
                <p>{!! $g->address_one !!}</p>
            </div>
            <div class="zf-info">
                <span class="ico"><i class="fa-regular fa-clock"></i></span>
                <h4>Working Hours</h4>
                <p>Saturday - Thursday</p>
                <p>09:00 AM - 07:00 PM</p>
            </div>
        </div>
    </div>
</section>

<!-- ================= Form ================= -->
<section class="zf-ct-main">
    <div class="zf-wrap">
        <div class="zf-ct-box" id="contactFormBox">
            <aside class="zf-ct-side" style="background-image:url('{{ $zfImg('1489987707025-afc232f7ea0f', 800) }}')">
                <span class="zf-sub">Get In Touch</span>
                <h3>Let's Talk About Your Next Order</h3>
                <p>Send us your design, tech pack or enquiry. Our merchandising team will get back to you with costing and timelines.</p>
                <ul class="zf-ct-list">
                    @if($g->mobile)
                    <li><i class="fa-solid fa-phone"></i><div><small>Phone</small><a href="tel:{{ $zfTel }}">{{ $g->mobile }}</a></div></li>
                    @endif
                    @if($g->email)
                    <li><i class="fa-solid fa-envelope"></i><div><small>Email</small><a href="mailto:{{ $g->email }}">{{ $g->email }}</a></div></li>
                    @endif
                    @if($zfAddress)
                    <li><i class="fa-solid fa-location-dot"></i><div><small>Office</small><span>{{ $zfAddress }}</span></div></li>
                    @endif
                </ul>
                @if(count($zfSocial))
                <div class="zf-ct-social">
                    @foreach($zfSocial as $s)
                    <a href="{{ $s[2] }}" target="_blank" rel="noopener" aria-label="{{ $s[1] }}" title="{{ $s[1] }}"><i class="{{ $s[0] }}"></i></a>
                    @endforeach
                </div>
                @endif
            </aside>

            <div class="zf-ct-form">
                <span class="zf-sub">Request A Quote</span>
                <h3>How May We <b>Help You?</b></h3>
                <p>Fill in the form and we will contact you shortly.</p>

                @if(Session::has('success'))
                <div class="zf-alert success"><i class="fa-solid fa-circle-check"></i> {{ Session::get('success') }}</div>
                @endif
                @if(Session::has('error'))
                <div class="zf-alert error"><i class="fa-solid fa-circle-exclamation"></i> {{ Session::get('error') }}</div>
                @endif

                <form action="{{ route('contactMail') }}#contactFormBox" id="contactForm" method="post">
                    @csrf
                    <div class="zf-fields">
                        <div class="zf-field">
                            <label for="cName">Your Name <span>*</span></label>
                            <div class="wrap"><i class="fa-regular fa-user"></i><input type="text" id="cName" name="name" value="{{ old('name') }}" class="zf-input" placeholder="John Smith" maxlength="100" required></div>
                            @error('name')<span class="zf-error">{{ $message }}</span>@enderror
                        </div>
                        <div class="zf-field">
                            <label for="cEmail">Your Email <span>*</span></label>
                            <div class="wrap"><i class="fa-regular fa-envelope"></i><input type="email" id="cEmail" name="email" value="{{ old('email') }}" class="zf-input" placeholder="you@company.com" maxlength="100" required></div>
                            @error('email')<span class="zf-error">{{ $message }}</span>@enderror
                        </div>
                        <div class="zf-field full">
                            <label for="cSubject">Subject <span>*</span></label>
                            <div class="wrap"><i class="fa-regular fa-file-lines"></i><input type="text" id="cSubject" name="subject" value="{{ old('subject') }}" class="zf-input" placeholder="e.g. Quotation for denim jeans" maxlength="100" required></div>
                            @error('subject')<span class="zf-error">{{ $message }}</span>@enderror
                        </div>
                        <div class="zf-field full">
                            <label for="cMessage">Your Message</label>
                            <div class="wrap"><i class="fa-regular fa-comment-dots"></i><textarea id="cMessage" name="message" class="zf-input" placeholder="Product, quantity, target price, delivery date..." maxlength="500">{{ old('message') }}</textarea></div>
                            @error('message')<span class="zf-error">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="zf-form-foot">
                        <small><i class="fa-solid fa-shield-halved"></i> Your information is safe with us.</small>
                        <button type="submit" class="zf-btn">Send Message <i class="fa-solid fa-paper-plane"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

</div>
@endsection

