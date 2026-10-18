<ul class="submenu">
    @foreach($productCtgs as $ctg)
    <li>
        <a href="{{ route('productCategory',$ctg->slug?:'no-title') }}">{{ $ctg->name }}</a>
    </li>
    @endforeach
    <li class="submenuViewAll">
        <a href="{{ route('products') }}">View All Products <i class="fa-solid fa-arrow-right"></i></a>
    </li>
</ul>
