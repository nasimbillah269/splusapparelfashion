{{-- One product card. Params: $product, $ctgName (optional label above the name) --}}
<div class="zf-pcard">
    <a href="{{ route('productView', $product->slug ?: 'no-title') }}" class="zf-pcard-img">
        <img src="{{ asset($product->image()) }}" alt="{{ $product->name }}" loading="lazy" />
        <span class="view">View Details</span>
    </a>
    <div class="zf-pcard-body">
        @if(!empty($ctgName))<small>{{ $ctgName }}</small>@endif
        <h3><a href="{{ route('productView', $product->slug ?: 'no-title') }}">{{ $product->name }}</a></h3>
        @if($product->short_description)
        <p>{{ Str::limit(strip_tags($product->short_description), 90) }}</p>
        @endif
    </div>
</div>
