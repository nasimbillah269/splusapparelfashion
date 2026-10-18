@extends(welcomeTheme().'layouts.master')
@section('title')
<title>{{websiteTitle($category->seo_title?:$category->name)}}</title>
@endsection
@section('SEO')
<meta name="title" property="og:title" content="{{websiteTitle($category->seo_title?:$category->name)}}" />
<meta name="description" property="og:description" content="{!!$category->seo_description?:general()->meta_description!!}" />
<meta name="keywords" content="{{$category->seo_keyword?:general()->meta_keyword}}" />
<meta name="image" property="og:image" content="{{asset($category->image())}}" />
<meta name="url" property="og:url" content="{{route('blogCategory',$category->slug?:'no-title')}}" />
<link rel="canonical" href="{{route('blogCategory',$category->slug?:'no-title')}}">
@endsection

@section('contents')
@include(welcomeTheme().'layouts.includes.pageBanner', [
    'title' => $category->name,
    'crumbs' => [['Blog', null], [$category->name, null]],
    'bannerImage' => $category->bannerFile ? asset($category->banner()) : null,
])
@include(welcomeTheme().'blogs.includes.postsGrid')
@endsection
