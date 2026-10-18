@php $postUrl = route('blogView', $post->slug ?: 'no-title'); @endphp
<div class="tx-blog-card">
    <a href="{{$postUrl}}" class="thumb">
        <img src="{{asset($post->image())}}" alt="{{$post->name}}" loading="lazy">
        <div class="tx-date">
            <b>{{$post->created_at->format('d')}}</b>
            <small>{{$post->created_at->format('M')}}</small>
        </div>
    </a>
    <div class="tx-blog-body">
        <div class="tx-meta">
            @if($post->user)
            <a href="{{route('blogAuthor',[$post->user->id, Str::slug($post->user->name)])}}"><i class="fa-regular fa-user"></i>{{$post->user->name}}</a>
            @else
            <span><i class="fa-regular fa-user"></i>Admin</span>
            @endif
            <span><i class="fa-regular fa-comments"></i>Comment {{$post->postComments->where('status','active')->count()}}</span>
        </div>
        <h4><a href="{{$postUrl}}">{{$post->name}}</a></h4>
        <a href="{{$postUrl}}" class="tx-more">Read More <i class="fa-solid fa-arrow-right-long"></i></a>
    </div>
</div>
