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
    .zf-cert{background:#f2f2f2;padding:85px 0 0}
    .zf-cert h2{font-size:50px;text-transform:uppercase;margin-bottom:45px}
    .zf-cert-desc{max-width:760px;margin:-25px auto 45px;color:#555;font-size:15px}
    .zf-cert-desc p{margin-bottom:10px}
</style>
@endpush

@section('contents')
<div class="zf-home">

@include(welcomeTheme().'products.includes.zfBanner', [
    'title' => $page->name,
    'crumbs' => [[$page->name, null]],
    'bannerImage' => $page->bannerFile ? asset($page->banner()) : null,
])

<!-- ================= Certifications (same row as the home page) ================= -->
<section class="zf-cert">
    <div class="zf-wrap zf-center">
        <h2>Certifications</h2>
        @if(trim(strip_tags((string) $page->description)))
        <div class="zf-cert-desc">{!! $page->description !!}</div>
        @endif
        @include(welcomeTheme().'layouts.includes.certLogos')
    </div>
</section>

<!-- ================= CTA ================= -->
<div class="zf-cta-wrap">
    <div class="zf-cta">
        <div class="zf-cta-left">
            <span class="zf-sub">Need A Certificate Copy?</span>
            <h3>Request Our Compliance Documents</h3>
        </div>
        <a href="{{ general()->email ? 'mailto:'.general()->email.'?subject='.rawurlencode('Certificate request') : templateUrl('Contact Us') }}" class="zf-btn line">Request Now</a>
    </div>
</div>

</div>
@endsection
