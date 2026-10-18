{{-- Product page banner. Params: $title, $crumbs (array of [label, url|null]), $bannerImage (optional) --}}
@php
    $bannerImage = $bannerImage ?? 'https://images.unsplash.com/photo-1558769132-cb1aea458c5e?auto=format&fit=crop&w=1920&q=75';
@endphp
<section class="zf-pbanner" style="background-image:url('{{ $bannerImage }}')">
    <div class="zf-wrap">
        <div class="zf-pbox">
            <h1>{{ $title }}</h1>
            <ul class="zf-crumb">
                <li><a href="{{ route('index') }}">Home</a></li>
                @foreach($crumbs ?? [] as $c)
                <li>@if(!empty($c[1]))<a href="{{ $c[1] }}">{{ $c[0] }}</a>@else{{ $c[0] }}@endif</li>
                @endforeach
            </ul>
        </div>
    </div>
</section>
