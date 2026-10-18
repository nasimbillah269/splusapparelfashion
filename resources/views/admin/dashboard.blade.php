@extends(adminTheme().'layouts.app') @section('title')
<title>{{websiteTitle('Dashboard')}}</title>
@endsection @push('css')
<style>
    .yg-products{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));column-gap:28px}
    .yg-product{display:flex;align-items:center;gap:12px;min-width:0;padding:10px 6px;border-bottom:1px solid var(--yg-border);border-radius:var(--yg-radius-sm);color:var(--yg-text);text-decoration:none;transition:background .2s}
    .yg-product:hover{background:var(--yg-primary-50);color:var(--yg-text);text-decoration:none}
    .yg-product img{flex:0 0 44px;width:44px;height:44px;border-radius:10px;object-fit:cover;background:var(--yg-bg);border:1px solid var(--yg-border)}
    .yg-product-body{flex:1;min-width:0}
    .yg-product-body b{display:block;font-weight:600;font-size:13.5px;line-height:1.3;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
    .yg-product-meta{display:flex;align-items:center;gap:8px;margin-top:3px;font-size:11.5px;color:var(--yg-muted);white-space:nowrap;overflow:hidden}
    .yg-product-meta .ctg{background:var(--yg-primary-50);color:var(--yg-primary);padding:1px 8px;border-radius:20px;font-weight:600;overflow:hidden;text-overflow:ellipsis;max-width:150px}
    .yg-product .badge{flex:0 0 auto;font-size:10.5px}
    .yg-product .go{flex:0 0 28px;width:28px;height:28px;border-radius:8px;display:flex;align-items:center;justify-content:center;color:var(--yg-muted);font-size:12px;transition:.2s}
    .yg-product:hover .go{background:var(--yg-primary);color:#fff}
    @media (max-width:767px){ .yg-products{grid-template-columns:1fr} }
</style>
@endpush @section('contents')
@php
    $per = json_decode(optional(Auth::user()->permission)->permission ?? '[]', true) ?: [];
    $hour = (int) now()->format('G');
    $greeting = $hour < 12 ? 'Good morning' : ($hour < 17 ? 'Good afternoon' : 'Good evening');
@endphp
<div class="content-body">

    <!-- Welcome banner -->
    <div class="yg-welcome">
        <div>
            <span class="yg-date"><i class="fa-regular fa-calendar"></i> {{ now()->format('l, d F Y') }}</span>
            <h2>{{ $greeting }}, {{ Str::limit(Auth::user()->name, 24) }} 👋</h2>
            <p>Here's an overview of your website content. Keep products, pages and sliders up to date.</p>
        </div>
        <div class="yg-welcome-actions">
            <a href="{{ route('index') }}" target="_blank" class="btn btn-ghost"><i class="fa-solid fa-globe mr-50"></i> View Website</a>
            @isset($per['services']['add'])
            <a href="{{ route('admin.servicesAction','create') }}" class="btn btn-light"><i class="fa-solid fa-plus mr-50"></i> New Service</a>
            @endisset
        </div>
    </div>

    <!-- Totals -->
    <div class="yg-stats">
        <a href="{{ route('admin.services') }}" class="yg-stat">
            <span class="yg-stat-icon"><i class="fas fa-stream"></i></span>
            <div><h3>{{ $totals['services'] }}</h3><p>Services</p><small><i class="fa fa-arrow-up"></i> {{ $reports['services'] }} this month</small></div>
        </a>
        <a href="{{ route('admin.products') }}" class="yg-stat">
            <span class="yg-stat-icon c2"><i class="fas fa-box-open"></i></span>
            <div><h3>{{ $totals['projects'] }}</h3><p>Products</p></div>
        </a>
        <a href="{{ route('admin.posts') }}" class="yg-stat">
            <span class="yg-stat-icon c3"><i class="fas fa-file-alt"></i></span>
            <div><h3>{{ $totals['posts'] }}</h3><p>Blog Posts</p><small><i class="fa fa-arrow-up"></i> {{ $reports['posts'] }} this month</small></div>
        </a>
        <a href="{{ route('admin.pages') }}" class="yg-stat">
            <span class="yg-stat-icon c4"><i class="fas fa-copy"></i></span>
            <div><h3>{{ $totals['pages'] }}</h3><p>Pages</p></div>
        </a>
        <a href="{{ route('admin.clients') }}" class="yg-stat">
            <span class="yg-stat-icon c5"><i class="fas fa-comments"></i></span>
            <div><h3>{{ $totals['testimonials'] }}</h3><p>Testimonials</p></div>
        </a>
        <a href="{{ route('admin.brands') }}" class="yg-stat">
            <span class="yg-stat-icon c6"><i class="fas fa-microchip"></i></span>
            <div><h3>{{ $totals['technologies'] }}</h3><p>Technologies</p></div>
        </a>
        <a href="{{ route('admin.sliders') }}" class="yg-stat">
            <span class="yg-stat-icon c2"><i class="fas fa-chalkboard"></i></span>
            <div><h3>{{ $totals['sliders'] }}</h3><p>Hero Slides</p></div>
        </a>
        <a href="{{ route('admin.usersCustomer') }}" class="yg-stat">
            <span class="yg-stat-icon c3"><i class="fas fa-users"></i></span>
            <div><h3>{{ $totals['users'] }}</h3><p>Customers</p></div>
        </a>
    </div>

    <div class="row">
        <!-- Quick actions -->
        <div class="col-xl-4 col-lg-12">
            <div class="card">
                <div class="card-header"><h4 class="card-title">Quick Actions</h4></div>
                <div class="card-content">
                    <div class="card-body">
                        <div class="yg-quick">
                            @isset($per['services']['add'])
                            <a href="{{ route('admin.servicesAction','create') }}"><i class="fas fa-stream"></i> Service</a>
                            <a href="{{ route('admin.productsAction','create') }}"><i class="fas fa-box-open"></i> Product</a>
                            @endisset
                            @isset($per['posts']['add'])
                            <a href="{{ route('admin.postsAction','create') }}"><i class="fas fa-pen"></i> Blog Post</a>
                            @endisset
                            @isset($per['clients']['add'])
                            <a href="{{ route('admin.clientsAction','create') }}"><i class="fas fa-comments"></i> Testimonial</a>
                            @endisset
                            @isset($per['brands']['add'])
                            <a href="{{ route('admin.brandsAction','create') }}"><i class="fas fa-microchip"></i> Technology</a>
                            @endisset
                            @isset($per['sliders']['list'])
                            <a href="{{ route('admin.sliders') }}"><i class="fas fa-chalkboard"></i> Hero Slider</a>
                            @endisset
                            @isset($per['menus']['list'])
                            <a href="{{ route('admin.menus') }}"><i class="fas fa-bars"></i> Menus</a>
                            @endisset
                            @isset($per['medies']['list'])
                            <a href="{{ route('admin.medies') }}"><i class="fas fa-images"></i> Media</a>
                            @endisset
                            @isset($per['appsSetting']['general'])
                            <a href="{{ route('admin.setting','general') }}"><i class="fa fa-cog"></i> Settings</a>
                            @endisset
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent products -->
        <div class="col-xl-8 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Recent Products <a href="{{ route('admin.products') }}" class="yg-card-link">View all <i class="fa fa-chevron-right"></i></a></h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        @if($recentProducts->count())
                        <div class="yg-products">
                            @foreach($recentProducts as $item)
                            <a href="{{ route('admin.productsAction',['edit',$item->id]) }}" class="yg-product" title="Edit {{ $item->name }}">
                                <img src="{{ asset($item->image()) }}" alt="{{ $item->name }}" loading="lazy">
                                <span class="yg-product-body">
                                    <b>{{ $item->name ?: 'Untitled' }}</b>
                                    <span class="yg-product-meta">
                                        @php $ctgName = optional($item->productCategories->first())->name ?: 'No category'; @endphp<span class="ctg" title="{{ $ctgName }}">{{ $ctgName }}</span>
                                        <span>{{ $item->created_at->format('d M Y') }}</span>
                                    </span>
                                </span>
                                <span class="badge {{ $item->status=='active' ? 'badge-success' : 'badge-danger' }}">{{ ucfirst($item->status) }}</span>
                                <span class="go"><i class="fa-solid fa-pen"></i></span>
                            </a>
                            @endforeach
                        </div>
                        @else
                        <ul class="yg-list"><li class="yg-empty">No products yet</li></ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Latest blog posts -->
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Latest Blog Posts <a href="{{ route('admin.posts') }}" class="yg-card-link">View all <i class="fa fa-chevron-right"></i></a></h4>
        </div>
        <div class="card-content">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th style="min-width: 260px;">Title</th>
                                <th>Status</th>
                                <th>Published</th>
                                <th style="width: 90px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($posts->take(5) as $post)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset($post->image()) }}" style="width: 42px; height: 42px;" class="mr-1" alt="">
                                        <a href="{{ route('admin.postsAction',['edit',$post->id]) }}">{{ Str::limit($post->name ?: 'Untitled', 60) }}</a>
                                    </div>
                                </td>
                                <td><span class="badge {{ $post->status=='active' ? 'badge-success' : 'badge-danger' }}">{{ ucfirst($post->status) }}</span></td>
                                <td>{{ $post->created_at->format('d M Y') }}</td>
                                <td><a href="{{ route('admin.postsAction',['edit',$post->id]) }}" class="btn btn-sm btn-info">Edit</a></td>
                            </tr>
                            @empty
                            <tr><td colspan="4" class="text-center text-muted py-2">No blog posts yet</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
