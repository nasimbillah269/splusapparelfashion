@extends(welcomeTheme().'layouts.master')
@section('title')
<title>{{websiteTitle($author->name)}}</title>
@endsection
@section('SEO')
<meta name="title" property="og:title" content="{{websiteTitle($author->name)}}" />
<meta name="description" property="og:description" content="{!!general()->meta_description!!}" />
<meta name="url" property="og:url" content="{{url()->current()}}" />
<link rel="canonical" href="{{url()->current()}}">
@endsection

@section('contents')
@include(welcomeTheme().'layouts.includes.pageBanner', [
    'title' => $author->name,
    'crumbs' => [['Author', null], [$author->name, null]],
])
@include(welcomeTheme().'blogs.includes.postsGrid')
@endsection
