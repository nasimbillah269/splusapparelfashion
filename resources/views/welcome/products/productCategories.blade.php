@extends(welcomeTheme().'layouts.master')
@section('title')
<title>{{websiteTitle('Products')}}</title>
@endsection
@section('SEO')
<meta name="title" property="og:title" content="{{websiteTitle('Products')}}" />
<meta name="description" property="og:description" content="{!!general()->meta_description!!}" />
<meta name="keywords" content="{{general()->meta_keyword}}" />
<meta name="image" property="og:image" content="{{asset(general()->logo())}}" />
<meta name="url" property="og:url" content="{{route('products')}}" />
<link rel="canonical" href="{{route('products')}}">
@endsection
@include(welcomeTheme().'products.includes.zfProductCss')
@push('css')
<style>
    .zf-prod-intro{background:#fff;padding:100px 0 60px}
    .zf-prod-cats{background:#fff;padding:0 0 100px}
    .zf-prod-why{background:#f2f2f2;padding:90px 0 100px}
    .zf-why-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:25px}
    .zf-why{background:#fff;padding:38px 28px;text-align:left;transition:.35s}
    .zf-why:hover{background:#2a2b30}
    .zf-why i{font-size:46px;color:#fd5b00;display:block;margin-bottom:14px}
    .zf-why h4{font-size:26px;margin-bottom:6px;transition:.35s}
    .zf-why p{font-size:13px;transition:.35s}
    .zf-why:hover h4{color:#fff}
    .zf-why:hover p{color:#b5b5b5}
    @media (max-width:991px){ .zf-why-grid{grid-template-columns:repeat(2,1fr)} .zf-prod-intro{padding:70px 0 50px} }
    @media (max-width:575px){ .zf-why-grid{grid-template-columns:1fr} }
</style>
@endpush

@section('contents')
<div class="zf-home">

@include(welcomeTheme().'products.includes.zfBanner', [
    'title' => 'Our Products',
    'crumbs' => [['Products', null]],
])

<section class="zf-prod-intro">
    <div class="zf-wrap zf-center">
        <span class="zf-sub">Product Categories</span>
        <h2 class="zf-title">Browse Our <b>Collection</b></h2>    </div>
</section>

<section class="zf-prod-cats">
    <div class="zf-wrap">
        @if($categories->count())
        <div class="zf-pcat-grid">
            @foreach($categories as $category)
            @php $count = $category->activeProducts()->count(); @endphp
            <a href="{{ route('productCategory', $category->slug ?: 'no-title') }}" class="zf-pcat">
                <img src="{{ asset($category->image()) }}" alt="{{ $category->name }}" loading="lazy" />
                <div class="zf-pcat-body">
                    <div>
                        <h3>{{ $category->name }}</h3>
                        <small>{{ $count }} {{ Str::plural('Product', $count) }}</small>
                    </div>
                    <span class="arrow"><i class="fa-solid fa-arrow-right"></i></span>
                </div>
            </a>
            @endforeach
        </div>
        @else
        <p class="zf-empty">No product categories found.</p>
        @endif
    </div>
</section>

<section class="zf-prod-why">
    <div class="zf-wrap zf-center">
        <span class="zf-sub">Why Source With Us</span>
        <h2 class="zf-title">Quality You Can <b>Trust</b></h2>
        <div class="zf-why-grid">
            <div class="zf-why"><i class="ti ti-building-factory"></i><h4>Compliant Factories</h4><p>Audited partner factories for every product type.</p></div>
            <div class="zf-why"><i class="ti ti-palette"></i><h4>Custom Designs</h4><p>Your fabric, colour, print, label and packaging.</p></div>
            <div class="zf-why"><i class="ti ti-rosette-discount-check"></i><h4>2.5 AQL Quality</h4><p>Inline and final inspection on every order.</p></div>
            <div class="zf-why"><i class="ti ti-ship"></i><h4>On Time Delivery</h4><p>Shipments planned and tracked to your warehouse.</p></div>
        </div>
    </div>
</section>

<div class="zf-cta-wrap">
    <div class="zf-cta">
        <div class="zf-cta-left">
            <span class="zf-sub">Looking For Something Specific?</span>
            <h3>Send Us Your Design Or Tech Pack</h3>
        </div>
        <a href="{{ templateUrl('Contact Us') }}" class="zf-btn line">Contact Us</a>
    </div>
</div>

</div>
@endsection
