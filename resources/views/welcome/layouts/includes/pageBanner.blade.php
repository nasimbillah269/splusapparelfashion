{{-- Inner page banner. Params: $title, $crumbs (array of [label, url|null]), $bannerImage (optional) --}}
@php
    $bannerImage = $bannerImage ?? 'https://images.unsplash.com/photo-1522071820081-009f0129c71c?auto=format&fit=crop&w=2000&q=75';
@endphp
<section class="tx-banner">
    <div class="tx-banner-bg" style="background-image:url('{{$bannerImage}}')"></div>
    <div class="shape s1"></div>
    <div class="shape s2"></div>
    <svg viewBox="0 0 1920 540" preserveAspectRatio="none">
        <path d="M0 330 L300 40 Q340 0 380 40" fill="none" stroke="#fff" stroke-width="1" opacity=".5"/>
        <path d="M0 360 L60 430 Q90 470 140 440 L520 100" fill="none" stroke="#fff" stroke-width="1" opacity=".4"/>
        <path d="M1500 540 Q1500 480 1560 430 L1920 140" fill="none" stroke="#fff" stroke-width="1"/>
    </svg>
    <div class="tx-banner-content">
        <h1>{{$title}}</h1>
        <ul class="tx-crumb">
            <li><a href="{{route('index')}}">Home</a></li>
            @foreach($crumbs ?? [] as $c)
            <li>@if(!empty($c[1]))<a href="{{$c[1]}}">{{$c[0]}}</a>@else{{$c[0]}}@endif</li>
            @endforeach
        </ul>
    </div>
</section>
