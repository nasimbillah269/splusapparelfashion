@extends(welcomeTheme().'layouts.master')
@section('title')
<title>{{websiteTitle($post->seo_title?:$post->name)}}</title>
@endsection
@section('SEO')
<meta name="title" property="og:title" content="{{websiteTitle($post->seo_title?:$post->name)}}" />
<meta name="description" property="og:description" content="{!!$post->seo_description?:general()->meta_description!!}" />
<meta name="keywords" content="{{$post->seo_keyword?:general()->meta_keyword}}" />
<meta name="image" property="og:image" content="{{asset($post->image())}}" />
<meta name="url" property="og:url" content="{{route('blogView',$post->slug?:'no-title')}}" />
<link rel="canonical" href="{{route('blogView',$post->slug?:'no-title')}}">
@endsection

@section('contents')
@php
    $postUrl = route('blogView', $post->slug ?: 'no-title');
    $crumbs = [];
    if($ctg = $post->postCategories->first()){
        $crumbs[] = [$ctg->name, route('blogCategory', $ctg->slug ?: 'no-title')];
    }
    $crumbs[] = [$post->name, null];
    $base = App\Models\Post::where('type',1)->where('status','active')->whereDate('created_at','<=',date('Y-m-d'));
    $prevPost = (clone $base)->where('id','<',$post->id)->orderBy('id','desc')->first(['id','name','slug']);
    $nextPost = (clone $base)->where('id','>',$post->id)->orderBy('id','asc')->first(['id','name','slug']);
    $commentCount = $post->postComments->where('status','active')->count();
@endphp

@include(welcomeTheme().'layouts.includes.pageBanner', [
    'title' => $post->name,
    'crumbs' => $crumbs,
    'bannerImage' => $post->bannerFile ? asset($post->banner()) : null,
])

<section class="tx-post">
    <div class="container">
        <div class="tx-post-grid">
            <div>
                <div class="tx-post-thumb"><img src="{{asset($post->image())}}" alt="{{$post->name}}"></div>

                <h2 class="tx-post-title">{{$post->name}}</h2>
                <div class="tx-post-meta">
                    @if($post->user)
                    <a href="{{route('blogAuthor',[$post->user->id, Str::slug($post->user->name)])}}" style="display:flex;align-items:center;gap:8px">
                        <img src="{{asset($post->user->image())}}" alt="{{$post->user->name}}">{{$post->user->name}}
                    </a>
                    @endif
                    <span><i class="fa-regular fa-calendar"></i>{{$post->created_at->format('F d, Y')}}</span>
                    <span><i class="fa-regular fa-comments"></i>{{$commentCount}} Comments</span>
                </div>

                <div class="tx-content">{!!$post->description!!}</div>

                <div class="tx-post-foot">
                    <div class="tags">
                        <i class="fa-solid fa-tag"></i>
                        @forelse($post->postCategories as $i => $c)
                            <a href="{{route('blogCategory',$c->slug?:'no-title')}}">{{$c->name}}</a>@if(!$loop->last),@endif
                        @empty
                            <span>Uncategorized</span>
                        @endforelse
                    </div>
                    <div class="tx-share">
                        Share this post
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{urlencode($postUrl)}}" target="_blank" rel="noopener" aria-label="Share on Facebook"><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="https://twitter.com/intent/tweet?url={{urlencode($postUrl)}}&text={{urlencode($post->name)}}" target="_blank" rel="noopener" aria-label="Share on X"><i class="fa-brands fa-x-twitter"></i></a>
                        <a href="https://www.linkedin.com/sharing/share-offsite/?url={{urlencode($postUrl)}}" target="_blank" rel="noopener" aria-label="Share on LinkedIn"><i class="fa-brands fa-linkedin-in"></i></a>
                    </div>
                </div>

                @if($post->user)
                <div class="tx-author">
                    <img src="{{asset($post->user->image())}}" alt="{{$post->user->name}}">
                    <div>
                        <h5>{{$post->user->name}}</h5>
                        <p>Our team creates, prototypes and tests functional, user-friendly and engaging digital experiences that are intuitive, visually appealing and meet business goals.</p>
                    </div>
                </div>
                @endif

                @if($prevPost || $nextPost)
                <div class="tx-postnav">
                    @if($prevPost)
                    <a href="{{route('blogView',$prevPost->slug?:'no-title')}}"><i class="fa-solid fa-chevron-left"></i>{{$prevPost->name}}</a>
                    @else <span></span> @endif
                    @if($nextPost)
                    <a href="{{route('blogView',$nextPost->slug?:'no-title')}}" class="next">{{$nextPost->name}}<i class="fa-solid fa-chevron-right"></i></a>
                    @endif
                </div>
                @endif

                @if($relatedPosts->count())
                <div class="tx-related">
                    <h3>Related Posts</h3>
                    <div class="tx-related-grid">
                        @foreach($relatedPosts as $rPost)
                        <div>
                            <a href="{{route('blogView',$rPost->slug?:'no-title')}}" class="thumb"><img src="{{asset($rPost->image())}}" alt="{{$rPost->name}}"></a>
                            <h6><a href="{{route('blogView',$rPost->slug?:'no-title')}}">{{$rPost->name}}</a></h6>
                            <small><i class="fa-regular fa-calendar"></i>{{$rPost->created_at->format('F d, Y')}}</small>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <div class="tx-comments">
                    <h3>{{$commentCount}} Comments</h3>
                    @forelse($comments as $comment)
                    <div class="tx-comment">
                        <img src="{{asset($comment->image())}}" alt="{{$comment->name}}">
                        <div>
                            <h6>{{$comment->name}}</h6>
                            <small>{{$comment->created_at->format('F d, Y \a\t g:i a')}}</small>
                            <p>{!!nl2br(e($comment->content))!!}</p>
                        </div>
                    </div>
                    @empty
                    <p style="color:var(--muted)">No comments yet. Be the first to comment.</p>
                    @endforelse
                    {{$comments->links(welcomeTheme().'blogs.pagination')}}
                </div>

                <div class="tx-reply" id="reply">
                    <h3>Leave a Reply</h3>
                    <p>Your email address will not be published. Required fields are marked *</p>
                    @if(Session::has('success'))
                    <div class="tx-alert success">{{Session::get('success')}}</div>
                    @endif
                    <form action="{{route('blogComments',$post->slug)}}#reply" method="post">
                        @csrf
                        <div class="tx-form-row">
                            <div class="tx-field">
                                <input type="text" name="name" value="{{old('name')}}" class="tx-input" placeholder="Name*" required>
                                @error('name')<span class="tx-error">{{$message}}</span>@enderror
                            </div>
                            <div class="tx-field">
                                <input type="email" name="email" value="{{old('email')}}" class="tx-input" placeholder="Email*" required>
                                @error('email')<span class="tx-error">{{$message}}</span>@enderror
                            </div>
                        </div>
                        <div class="tx-field">
                            <input type="text" name="website" value="{{old('website')}}" class="tx-input" placeholder="Website*" required>
                            @error('website')<span class="tx-error">{{$message}}</span>@enderror
                        </div>
                        <div class="tx-field">
                            <textarea name="comment" class="tx-input" placeholder="Comment*" required>{{old('comment')}}</textarea>
                            @error('comment')<span class="tx-error">{{$message}}</span>@enderror
                        </div>
                        <button type="submit" class="tx-btn">Post A Comment</button>
                    </form>
                </div>
            </div>

            @include(welcomeTheme().'blogs.includes.sideBar')
        </div>
    </div>
</section>
@endsection
