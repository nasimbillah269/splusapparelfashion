@extends(welcomeTheme().'layouts.master')
@section('title')
<title>{{websiteTitle($product->seo_title?:$product->name)}}</title>
@endsection
@section('SEO')
<meta name="title" property="og:title" content="{{websiteTitle($product->seo_title?:$product->name)}}" />
<meta name="description" property="og:description" content="{!!$product->seo_description?:Str::limit(strip_tags($product->short_description),160)!!}" />
<meta name="keywords" content="{{$product->seo_keyword?:$product->name.' '.general()->meta_keyword}}" />
<meta name="image" property="og:image" content="{{asset($product->image())}}" />
<meta name="url" property="og:url" content="{{route('productView',$product->slug)}}" />
<link rel="canonical" href="{{route('productView',$product->slug)}}">
@endsection
@include(welcomeTheme().'products.includes.zfProductCss')
@push('css')
<style>
    .zf-pv{background:#fff;padding:90px 0 80px}
    .zf-pv > .zf-wrap{display:grid;grid-template-columns:1fr 1fr;gap:60px;align-items:start}
    .zf-pv-main{position:relative;height:560px;background:#f2f2f2;overflow:hidden}
    .zf-pv-main img{width:100%;height:100%;object-fit:cover;transition:opacity .3s}
    .zf-pv-main .tag{position:absolute;left:0;top:25px;background:#e2231a;color:#fff;font-family:'Teko',sans-serif;font-size:17px;letter-spacing:.5px;text-transform:uppercase;padding:7px 18px 4px}
    .zf-pv-thumbs{display:grid;grid-template-columns:repeat(5,1fr);gap:10px;margin-top:10px}
    .zf-pv-thumbs button{height:90px;padding:0;border:2px solid transparent;background:#f2f2f2;cursor:pointer;overflow:hidden;transition:.25s}
    .zf-pv-thumbs button img{width:100%;height:100%;object-fit:cover}
    .zf-pv-thumbs button.active,.zf-pv-thumbs button:hover{border-color:#e2231a}
    .zf-pv-info .ctg{display:inline-block;color:#e2231a;font-size:12px;font-weight:600;text-transform:uppercase;letter-spacing:.5px;text-decoration:none;margin-bottom:6px}
    .zf-pv-info h2{font-size:54px;margin-bottom:18px}
    .zf-pv-short{font-size:16px;color:#555;line-height:1.75;border-left:4px solid #e2231a;padding-left:18px;margin-bottom:26px}
    .zf-pv-meta{list-style:none;padding:0;margin:0 0 30px;border-top:1px solid #eee}
    .zf-pv-meta li{display:flex;gap:14px;align-items:center;padding:13px 0;border-bottom:1px solid #eee;font-size:14px}
    .zf-pv-meta i{width:36px;height:36px;flex:0 0 36px;background:#f2f2f2;color:#e2231a;display:flex;align-items:center;justify-content:center;font-size:18px}
    .zf-pv-meta b{font-family:'Teko',sans-serif;font-weight:500;font-size:19px;min-width:120px}
    .zf-pv-actions{display:flex;flex-wrap:wrap;gap:12px}
    .zf-pv-details{background:#f2f2f2;padding:80px 0}
    .zf-pv-details .box{background:#fff;padding:50px 55px}
    .zf-pv-details h3.head{font-size:38px;margin-bottom:20px;padding-bottom:12px;border-bottom:2px solid #eee;position:relative}
    .zf-pv-details h3.head::after{content:"";position:absolute;left:0;bottom:-2px;width:60px;height:2px;background:#e2231a}
    .zf-pv-body p{margin-bottom:14px;font-size:15px;line-height:1.85}
    .zf-pv-body h3,.zf-pv-body h4{font-size:26px;margin:22px 0 10px}
    .zf-pv-body ul{padding-left:20px;margin-bottom:16px}
    .zf-pv-body li{margin-bottom:6px}
    .zf-pv-body table{width:100%;border-collapse:collapse;margin-bottom:16px}
    .zf-pv-body td,.zf-pv-body th{border:1px solid #e5e5e5;padding:10px 14px;text-align:left}
    .zf-pv-related{background:#fff;padding:90px 0 100px}
    @media (max-width:991px){
        .zf-pv{padding:60px 0}
        .zf-pv > .zf-wrap{grid-template-columns:1fr;gap:40px}
        .zf-pv-main{height:460px}
    }
    @media (max-width:575px){
        .zf-pv-main{height:360px}
        .zf-pv-thumbs{grid-template-columns:repeat(4,1fr)}
        .zf-pv-thumbs button{height:70px}
        .zf-pv-info h2{font-size:40px}
        .zf-pv-details .box{padding:30px 20px}
    }
</style>
@endpush

@section('contents')
<div class="zf-home">

@php
    $crumbs = [['Products', route('products')]];
    if($category){ $crumbs[] = [$category->name, route('productCategory', $category->slug ?: 'no-title')]; }
    $crumbs[] = [$product->name, null];
    $images = collect([asset($product->image())])->merge($product->galleryFiles->map(fn($m) => asset($m->file_url)));
@endphp
@include(welcomeTheme().'products.includes.zfBanner', [
    'title' => $category ? $category->name : 'Products',
    'crumbs' => $crumbs,
    'bannerImage' => $category && $category->bannerFile ? asset($category->banner()) : null,
])

<section class="zf-pv">
    <div class="zf-wrap">
        <div class="zf-pv-gallery">
            <div class="zf-pv-main">
                <img src="{{ $images->first() }}" alt="{{ $product->name }}" id="zfPvMain" />
                @if($product->fetured)<span class="tag">Featured</span>@endif
            </div>
            @if($images->count() > 1)
            <div class="zf-pv-thumbs">
                @foreach($images as $k => $img)
                <button type="button" class="{{ $k == 0 ? 'active' : '' }}" data-src="{{ $img }}" aria-label="Image {{ $k + 1 }}"><img src="{{ $img }}" alt="{{ $product->name }}" loading="lazy" /></button>
                @endforeach
            </div>
            @endif
        </div>

        <div class="zf-pv-info">
            @if($category)
            <a href="{{ route('productCategory', $category->slug ?: 'no-title') }}" class="ctg">{{ $category->name }}</a>
            @endif
            <h2>{{ $product->name }}</h2>
            @if($product->short_description)
            <p class="zf-pv-short">{!! nl2br(e($product->short_description)) !!}</p>
            @endif
            <ul class="zf-pv-meta">
                @if($category)<li><i class="ti ti-category"></i><b>Category</b> {{ $category->name }}</li>@endif
                <li><i class="ti ti-palette"></i><b>Customization</b> Fabric, colour, print, label and packaging</li>
                <li><i class="ti ti-rosette-discount-check"></i><b>Quality</b> Inspected to 2.5 AQL standard</li>
                <li><i class="ti ti-ship"></i><b>Shipment</b> FOB, CIF and DDP terms available</li>
            </ul>
            <div class="zf-pv-actions">
                @if(general()->email)
                <a href="mailto:{{ general()->email }}?subject={{ rawurlencode('Enquiry: '.$product->name) }}" class="zf-btn"><i class="fa-solid fa-envelope"></i> Send Enquiry</a>
                @endif
                @if(general()->mobile)
                <a href="tel:{{ preg_replace('/[^0-9+]/', '', general()->mobile) }}" class="zf-btn line"><i class="fa-solid fa-phone"></i> Call Now</a>
                @endif
            </div>
        </div>
    </div>
</section>

@if(trim(strip_tags((string) $product->description)))
<section class="zf-pv-details">
    <div class="zf-wrap">
        <div class="box">
            <h3 class="head">Product Details</h3>
            <div class="zf-pv-body">{!! $product->description !!}</div>
        </div>
    </div>
</section>
@endif

@if($relatedProducts->count())
<section class="zf-pv-related">
    <div class="zf-wrap zf-center">
        <span class="zf-sub">More From {{ $category->name }}</span>
        <h2 class="zf-title">Related <b>Products</b></h2>
        <div class="zf-pgrid cols-4" style="text-align:left">
            @foreach($relatedProducts as $related)
                @include(welcomeTheme().'products.includes.productGrid', ['product' => $related, 'ctgName' => $category->name])
            @endforeach
        </div>
    </div>
</section>
@endif

</div>
@endsection

@push('js')
<script>
    // Gallery: click a thumbnail to show it as the main image
    document.querySelectorAll('.zf-pv-thumbs button').forEach(function(btn){
        btn.addEventListener('click', function(){
            var main = document.getElementById('zfPvMain');
            main.style.opacity = 0;
            setTimeout(function(){ main.src = btn.dataset.src; main.style.opacity = 1; }, 150);
            document.querySelectorAll('.zf-pv-thumbs button').forEach(function(b){ b.classList.remove('active'); });
            btn.classList.add('active');
        });
    });
</script>
@endpush
