@extends(welcomeTheme().'layouts.master')
@section('title')
<title>{{websiteTitle('Search')}}</title>
@endsection
@section('SEO')
<meta name="title" property="og:title" content="{{websiteTitle('Search')}}" />
<meta name="robots" content="noindex, follow" />
@endsection

@section('contents')
@include(welcomeTheme().'layouts.includes.pageBanner', [
    'title' => 'Search: '.request()->search,
    'crumbs' => [['Search', null]],
])
@include(welcomeTheme().'blogs.includes.postsGrid')
@endsection
