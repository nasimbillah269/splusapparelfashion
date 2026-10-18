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

@section('contents')
@include(welcomeTheme().'layouts.includes.pageBanner', [
    'title' => $page->name,
    'crumbs' => [[$page->name, null]],
    'bannerImage' => $page->bannerFile ? asset($page->banner()) : null,
])



<section class="tx-case tx-projects">
    <div class="container">
        <div class="tx-center">
            <span class="tx-sub">Form Our Case Studies</span>
            <h2 class="tx-title">We delivered best solution</h2>
        </div>
        <div class="tx-project-grid">
            {{-- Admin > Projects (all active projects, newest first) --}}
            @foreach(projectCards() as $p)
                @include(welcomeTheme().'layouts.includes.projectCard')
            @endforeach
        </div>
    </div>
</section>
@endsection
