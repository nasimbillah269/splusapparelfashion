<section class="tx-blog-list">
    <div class="container">
        @if($posts->count())
        <div class="tx-blog-grid">
            @foreach($posts as $post)
                @include(welcomeTheme().'blogs.includes.blogGrid')
            @endforeach
        </div>
        {{$posts->links(welcomeTheme().'blogs.pagination')}}
        @else
        <p class="tx-empty">No posts found.</p>
        @endif
    </div>
</section>
