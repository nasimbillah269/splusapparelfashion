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
<style>
    .galleryMain {
        padding: 50px 0;
    }
    .gallery {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }
        .gallery a {
                display: block;
                width: 270px;
                height: 200px;
                overflow: hidden;
                border-radius: 5px;
        }
        .gallery img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }
        .gallery a:hover img {
            transform: scale(1.1);
        }
        
        .video-item {
            position: relative;
            display: inline-block;
            cursor: pointer;
        }
        
        
        
        .video-item .play-icon {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 34px;
            color: #f7f2f2;
            background: rgb(247 0 0 / 60%);
            border-radius: 50%;
            padding: 6px 14px;
            pointer-events: none;
            transition: 0.3s;
            width: 60px;
            height: 60px;
        }
        
        .video-item:hover .play-icon {
            background: rgba(0, 0, 0, 0.8);
        }
    
</style>
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


<div class="galleryMain">
    <div class="container">
        @foreach($page->postTags as $tag)
        @if($gallery = $tag->gallery)
        <div class="gallery">
            @foreach($gallery->galleryImages as $img)
            @if($img->file_type == 5)
            <a data-fancybox="gallery" data-src="{{ asset($img->file_url) }}" class="video-item">
                <video>
                    <source src="{{ asset($img->file_url) }}" type="video/mp4">
                </video>
                <div class="play-icon">&#9658;</div> <!-- Play Icon -->
            </a>
            @else
            <a data-fancybox="gallery" data-src="{{ asset($img->image()) }}">
                <img src="{{ asset($img->image()) }}" alt="Image">
            </a>
            @endif
            @endforeach
        </div>
        @endif
        @endforeach
    </div>
</div>





@endsection @push('js') @endpush