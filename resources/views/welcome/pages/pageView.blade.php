@extends(welcomeTheme().'layouts.app') @section('title')
<title>{{$page->seo_title?:websiteTitle($page->name)}}</title>
@endsection @section('SEO')
<meta name="title" property="og:title" content="{{$page->seo_title?:websiteTitle($page->name)}}" />
<meta name="description" property="og:description" content="{!!$page->seo_description?:general()->meta_description!!}" />
<meta name="keywords" content="{{$page->seo_keyword?:general()->meta_keyword}}" />
<meta name="image" property="og:image" content="{{asset($page->image())}}" />
<meta name="url" property="og:url" content="{{route('pageView',$page->slug?:'no-title')}}" />
<link rel="canonical" href="{{route('pageView',$page->slug?:'no-title')}}" />
@endsection @push('css')
<style></style>
@endpush @section('contents')

<div class="breadcrumb-area" @if($page->
    bannerFile) style="background-image:url({{asset($page->banner())}});background-repeat: no-repeat; background-size: cover;padding: 50px 0;" @endif >
    <div class="container">
        <div class="title">
            <h1>{{$page->name}}</h1>
            <ul>
                <li><a href="{{route('index')}}">Home</a></li>
                <li>{{$page->name}}</li>
            </ul>
        </div>
    </div>
</div>

<div class="blogCompany">
    <div class="container">
        <div class="pageContent">
            
            @if ($page->imageFile)
            <div class="row">
                <div class="col-md-6">
                    <div class="pageImage">
                        <img src="{{asset($page->image())}}" alt="{{$page->name}}"/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="pageDescription">
                        {!!$page->description!!}
                    </div>
                </div>
            </div>
            @else
            
            <div class="pageLeargeDescription">
                {!!$page->description!!}
            </div>
            @endif
            
            
        </div>
    </div>
    @if($page->hasNitEditorContent->count() > 0)
        @include(welcomeTheme().'pages.nitEditor.primary',['datas'=>$page->hasNitEditorContent])
    @endif
</div>

@endsection @push('js') @endpush