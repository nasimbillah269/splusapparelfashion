@extends(welcomeTheme().'layouts.master')
@section('title')
<title>{{websiteTitle($category->seo_title?:$category->name)}}</title>
@endsection
@section('SEO')
<meta name="title" property="og:title" content="{{websiteTitle($category->seo_title?:$category->name)}}" />
<meta name="description" property="og:description" content="{!!$category->seo_description?:general()->meta_description!!}" />
<meta name="keywords" content="{{$category->seo_keyword?:general()->meta_keyword}}" />
<meta name="image" property="og:image" content="{{asset($category->image())}}" />
<meta name="url" property="og:url" content="{{route('productCategory',$category->slug?:'no-title')}}" />
<link rel="canonical" href="{{route('productCategory',$category->slug?:'no-title')}}">
@endsection
@include(welcomeTheme().'products.includes.zfProductCss')
@push('css')
<style>
    .zf-cp{background:#fff;padding:90px 0 100px}
    .zf-cp-head{text-align:center;margin-bottom:40px}
    .zf-cp-head h2{font-size:52px}
    .zf-cp-desc{max-width:760px;margin:12px auto 0;color:#555;font-size:15px}
    .zf-chips{display:flex;flex-wrap:wrap;justify-content:center;gap:8px;margin-bottom:35px}
    .zf-chips a{border:1px solid #ddd;padding:7px 18px 4px;font-family:'Teko',sans-serif;font-size:17px;color:#222;text-decoration:none;transition:.25s}
    .zf-chips a:hover,.zf-chips a.active{background:#e2231a;border-color:#e2231a;color:#fff}

    /* Image grid: 4 columns, image only */
    .zf-img-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:20px}
    .zf-img{position:relative;display:block;aspect-ratio:4/5;overflow:hidden;background:#f2f2f2;padding:0;border:0;cursor:zoom-in;width:100%}
    .zf-img img{width:100%;height:100%;object-fit:cover;transition:transform .7s}
    .zf-img::after{content:"";position:absolute;inset:0;background:rgba(226,35,26,0);transition:.35s}
    .zf-img i{position:absolute;left:50%;top:50%;z-index:1;width:54px;height:54px;margin:-27px 0 0 -27px;background:#fff;color:#e2231a;display:flex;align-items:center;justify-content:center;font-size:20px;opacity:0;transform:scale(.6);transition:.35s}
    .zf-img:hover img{transform:scale(1.08)}
    .zf-img:hover::after{background:rgba(42,43,48,.35)}
    .zf-img:hover i{opacity:1;transform:none}

    /* Lightbox */
    .zf-lb{position:fixed;inset:0;z-index:2000;background:rgba(15,15,18,.94);display:flex;align-items:center;justify-content:center;opacity:0;visibility:hidden;transition:.3s}
    .zf-lb.open{opacity:1;visibility:visible}
    .zf-lb img{max-width:min(92vw,1100px);max-height:86vh;object-fit:contain;box-shadow:0 20px 60px rgba(0,0,0,.5)}
    .zf-lb button{position:absolute;background:rgba(255,255,255,.08);border:0;color:#fff;width:52px;height:52px;font-size:22px;cursor:pointer;display:flex;align-items:center;justify-content:center;transition:.25s}
    .zf-lb button:hover{background:#e2231a}
    .zf-lb .close{top:20px;right:20px}
    .zf-lb .prev{left:20px;top:50%;margin-top:-26px}
    .zf-lb .next{right:20px;top:50%;margin-top:-26px}
    .zf-lb .count{position:absolute;bottom:22px;left:0;right:0;text-align:center;color:#bbb;font-family:'Teko',sans-serif;font-size:18px;letter-spacing:1px}
    body.zf-lb-open{overflow:hidden}

    @media (max-width:991px){ .zf-cp{padding:60px 0 80px} .zf-img-grid{grid-template-columns:repeat(3,1fr)} }
    @media (max-width:767px){ .zf-img-grid{grid-template-columns:repeat(2,1fr);gap:12px} .zf-cp-head h2{font-size:38px} }
    @media (max-width:575px){ .zf-lb .prev,.zf-lb .next{top:auto;bottom:12px;margin:0} .zf-lb .prev{left:12px} .zf-lb .next{right:12px} }
</style>
@endpush

@section('contents')
<div class="zf-home">

@php
    $crumbs = [['Products', route('products')]];
    if($category->parent){ $crumbs[] = [$category->parent->name, route('productCategory', $category->parent->slug ?: 'no-title')]; }
    $crumbs[] = [$category->name, null];
@endphp
@include(welcomeTheme().'products.includes.zfBanner', [
    'title' => $category->name,
    'crumbs' => $crumbs,
    'bannerImage' => $category->bannerFile ? asset($category->banner()) : ($category->imageFile ? asset($category->image()) : null),
])

<section class="zf-cp">
    <div class="zf-wrap">
        <div class="zf-cp-head">
            <span class="zf-sub">Our Products</span>
            <h2>{{ $category->name }}</h2>
            @if(trim(strip_tags((string) $category->description)))
            <div class="zf-cp-desc">{!! $category->description !!}</div>
            @endif
        </div>

        @if($subCategories->count())
        <div class="zf-chips">
            <a href="{{ route('productCategory', $category->slug) }}" class="active">All</a>
            @foreach($subCategories as $sub)
            <a href="{{ route('productCategory', $sub->slug ?: 'no-title') }}">{{ $sub->name }}</a>
            @endforeach
        </div>
        @endif

        @if($products->count())
        <div class="zf-img-grid" id="zfImgGrid">
            @foreach($products as $product)
            <button type="button" class="zf-img" data-src="{{ asset($product->image()) }}" aria-label="View {{ $product->name }}">
                <img src="{{ asset($product->image()) }}" alt="{{ $product->name }}" loading="lazy" />
                <i class="fa-solid fa-magnifying-glass-plus"></i>
            </button>
            @endforeach
        </div>
        {{ $products->links('pagination') }}
        @else
        <p class="zf-empty">No products found in this category yet.</p>
        @endif
    </div>
</section>

</div>

<div class="zf-lb" id="zfLb" aria-hidden="true">
    <button type="button" class="close" aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
    <button type="button" class="prev" aria-label="Previous"><i class="fa-solid fa-chevron-left"></i></button>
    <img src="" alt="" id="zfLbImg" />
    <button type="button" class="next" aria-label="Next"><i class="fa-solid fa-chevron-right"></i></button>
    <div class="count" id="zfLbCount"></div>
</div>
@endsection

@push('js')
<script>
    // Click an image to see it large; arrows / keyboard to move between images
    (function(){
        var items = Array.prototype.slice.call(document.querySelectorAll('#zfImgGrid .zf-img'));
        if(!items.length) return;
        var lb = document.getElementById('zfLb'), img = document.getElementById('zfLbImg'), count = document.getElementById('zfLbCount'), cur = 0;
        function show(i){
            cur = (i + items.length) % items.length;
            img.src = items[cur].dataset.src;
            img.alt = items[cur].querySelector('img').alt;
            count.textContent = (cur + 1) + ' / ' + items.length;
        }
        function open(i){ show(i); lb.classList.add('open'); lb.setAttribute('aria-hidden','false'); document.body.classList.add('zf-lb-open'); }
        function close(){ lb.classList.remove('open'); lb.setAttribute('aria-hidden','true'); document.body.classList.remove('zf-lb-open'); }
        items.forEach(function(el, i){ el.addEventListener('click', function(){ open(i); }); });
        lb.querySelector('.close').addEventListener('click', close);
        lb.querySelector('.prev').addEventListener('click', function(e){ e.stopPropagation(); show(cur - 1); });
        lb.querySelector('.next').addEventListener('click', function(e){ e.stopPropagation(); show(cur + 1); });
        lb.addEventListener('click', function(e){ if(e.target === lb) close(); });
        document.addEventListener('keydown', function(e){
            if(!lb.classList.contains('open')) return;
            if(e.key === 'Escape') close();
            if(e.key === 'ArrowLeft') show(cur - 1);
            if(e.key === 'ArrowRight') show(cur + 1);
        });
    })();
</script>
@endpush
