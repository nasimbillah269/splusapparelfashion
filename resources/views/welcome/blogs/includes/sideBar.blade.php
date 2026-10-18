<aside class="tx-sidebar">
    <div>
        <form action="{{route('blogSearch')}}" class="tx-side-search">
            <input type="text" name="search" value="{{request()->search}}" placeholder="Search..." required />
            <button type="submit">Search</button>
        </form>
    </div>

    <div>
        <h4>Recent Posts</h4>
        @foreach(App\Models\Post::where('type',1)->where('status','active')->whereDate('created_at','<=',date('Y-m-d'))->latest()->limit(3)->get(['id','name','slug','created_at']) as $lPost)
        <div class="tx-recent">
            <a href="{{route('blogView',$lPost->slug?:'no-title')}}"><img src="{{asset($lPost->image())}}" alt="{{$lPost->name}}"></a>
            <div>
                <h6><a href="{{route('blogView',$lPost->slug?:'no-title')}}">{{Str::limit($lPost->name, 45)}}</a></h6>
                <small><i class="fa-regular fa-calendar"></i>{{$lPost->created_at->format('F d, Y')}}</small>
            </div>
        </div>
        @endforeach
    </div>

    @php $sideCtgs = App\Models\Attribute::where('type',6)->where('status','active')->whereNull('parent_id')->orderBy('name')->get(); @endphp
    @if($sideCtgs->count())
    <div>
        <h4>Categories</h4>
        <ul class="tx-cats">
            @foreach($sideCtgs as $ctg)
            <li><a href="{{route('blogCategory',$ctg->slug?:'no-title')}}"><span>{{$ctg->name}}</span><span>({{$ctg->activePosts()->count()}})</span></a></li>
            @endforeach
        </ul>
    </div>
    @endif

    @php $sideTags = App\Models\Attribute::where('type',7)->where('status','active')->whereNull('parent_id')->orderBy('name')->limit(12)->get(); @endphp
    @if($sideTags->count())
    <div>
        <h4>Tags</h4>
        <div class="tx-tags">
            @foreach($sideTags as $tag)
            <a href="{{route('blogTag',$tag->slug?:'no-title')}}">{{$tag->name}}</a>
            @endforeach
        </div>
    </div>
    @endif
</aside>
