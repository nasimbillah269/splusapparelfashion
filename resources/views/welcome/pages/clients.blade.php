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
    .zf-cl{background:#f2f2f2;padding:85px 0 100px}
    .zf-cl h2{font-size:50px;text-transform:uppercase;margin-bottom:45px}
    .zf-cl-desc{max-width:760px;margin:-25px auto 45px;color:#555;font-size:15px}
    .zf-cl-desc p{margin-bottom:10px}
    .zf-logo-grid{display:grid;grid-template-columns:repeat(5,1fr);gap:20px}
    .zf-logo-grid .logo{height:150px;background:#fff;display:flex;align-items:center;justify-content:center;padding:25px;transition:.35s}
    .zf-logo-grid .logo img,.zf-logo-grid .logo svg{max-height:80px;max-width:100%;width:auto;object-fit:contain;filter:grayscale(1);opacity:.65;transition:.35s}
    .zf-logo-grid .logo svg{height:60px}
    .zf-logo-grid .logo:hover{transform:translateY(-5px);box-shadow:0 12px 30px rgba(0,0,0,.08)}
    .zf-logo-grid .logo:hover img,.zf-logo-grid .logo:hover svg{filter:none;opacity:1}
    @media (max-width:1199px){ .zf-logo-grid{grid-template-columns:repeat(4,1fr)} }
    @media (max-width:991px){ .zf-logo-grid{grid-template-columns:repeat(3,1fr)} }
    @media (max-width:575px){ .zf-cl h2{font-size:38px} .zf-logo-grid{grid-template-columns:repeat(2,1fr);gap:12px} .zf-logo-grid .logo{height:110px;padding:15px} }
</style>
@endpush

@section('contents')
<div class="zf-home">

@include(welcomeTheme().'products.includes.zfBanner', [
    'title' => $page->name,
    'crumbs' => [[$page->name, null]],
    'bannerImage' => $page->bannerFile ? asset($page->banner()) : null,
])

<!-- ================= Client logos: Admin > Galleries, location "Clients Page" ================= -->
<section class="zf-cl">
    <div class="zf-wrap zf-center">
        <h2>Our Clients</h2>
        @if(trim(strip_tags((string) $page->description)))
        <div class="zf-cl-desc">{!! $page->description !!}</div>
        @endif
        <div class="zf-logo-grid">
            @if($clientLogos->count())
                @foreach($clientLogos as $logo)
                @php $logoName = $logo->caption ?: Str::headline((string) $logo->alt_text); @endphp
                <div class="logo" title="{{ $logoName }}"><img src="{{ asset($logo->image()) }}" alt="{{ $logoName }}" loading="lazy"></div>
                @endforeach
            @else
                {{-- Sample logos (fictional names) until real client logos are uploaded --}}
                <div class="logo"><svg viewBox="0 0 200 60"><text x="100" y="40" text-anchor="middle" font-family="Georgia,serif" font-weight="700" font-size="30" letter-spacing="4" fill="#1d1d1d">NORDVIK</text></svg></div>
                <div class="logo"><svg viewBox="0 0 200 60"><circle cx="30" cy="30" r="18" fill="#e2231a"/><text x="30" y="37" text-anchor="middle" font-family="Arial" font-weight="700" font-size="18" fill="#fff">U</text><text x="58" y="38" font-family="Arial" font-weight="700" font-size="22" fill="#1d1d1d">urbanthread</text></svg></div>
                <div class="logo"><svg viewBox="0 0 200 60"><text x="100" y="30" text-anchor="middle" font-family="Georgia,serif" font-style="italic" font-size="26" fill="#1d1d1d">Kestrel &amp; Co.</text><text x="100" y="48" text-anchor="middle" font-family="Arial" font-size="9" letter-spacing="4" fill="#777">LONDON</text></svg></div>
                <div class="logo"><svg viewBox="0 0 200 60"><path d="M20 45 L35 15 L50 45 Z" fill="#1d6fb8"/><text x="60" y="40" font-family="Arial" font-weight="900" font-size="24" letter-spacing="2" fill="#1d1d1d">MONTEVA</text></svg></div>
                <div class="logo"><svg viewBox="0 0 200 60"><text x="100" y="40" text-anchor="middle" font-family="Arial" font-weight="300" font-size="30" fill="#1d1d1d">blue<tspan font-weight="700" fill="#1d6fb8">pine</tspan></text></svg></div>
                <div class="logo"><svg viewBox="0 0 200 60"><rect x="15" y="12" width="36" height="36" fill="none" stroke="#1d1d1d" stroke-width="3"/><text x="33" y="38" text-anchor="middle" font-family="Arial" font-weight="700" font-size="18" fill="#1d1d1d">H</text><text x="62" y="38" font-family="Arial" font-weight="700" font-size="22" letter-spacing="3" fill="#1d1d1d">HALVERN</text></svg></div>
                <div class="logo"><svg viewBox="0 0 200 60"><text x="100" y="40" text-anchor="middle" font-family="Georgia,serif" font-size="32" fill="#0a8a3a">Vireo</text><path d="M140 18 q8 -10 16 0" fill="none" stroke="#0a8a3a" stroke-width="3"/></svg></div>
                <div class="logo"><svg viewBox="0 0 200 60"><text x="100" y="40" text-anchor="middle" font-family="Arial Black,Arial" font-weight="900" font-size="26" letter-spacing="1" fill="#1d1d1d">OAKLINE</text><rect x="40" y="46" width="120" height="3" fill="#e2231a"/></svg></div>
                <div class="logo"><svg viewBox="0 0 200 60"><text x="100" y="38" text-anchor="middle" font-family="Georgia,serif" font-size="28" letter-spacing="2" fill="#1d1d1d">Sartoria</text><text x="100" y="52" text-anchor="middle" font-family="Arial" font-size="8" letter-spacing="5" fill="#777">MILANO</text></svg></div>
                <div class="logo"><svg viewBox="0 0 200 60"><circle cx="28" cy="30" r="16" fill="none" stroke="#e8a23b" stroke-width="5"/><text x="54" y="39" font-family="Arial" font-weight="700" font-size="24" fill="#1d1d1d">Solvane</text></svg></div>
            @endif
        </div>
    </div>
</section>

</div>
@endsection
