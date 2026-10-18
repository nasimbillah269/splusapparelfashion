@extends(welcomeTheme().'layouts.master')
@section('title')
<title>{{websiteTitle($page->seo_title?:$page->name)}}</title>
@endsection
@section('SEO')
<meta name="title" property="og:title" content="{{websiteTitle($page->seo_title?:$page->name)}}" />
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
@include(welcomeTheme().'services.includes.servicesList')
@endsection
