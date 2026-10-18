{{-- Technologies logo row: Admin > Technologies (stored as brands, type 2). Featured first, then newest. --}}
@php
    $txTechs = \App\Models\Attribute::where('type',2)->where('status','active')
        ->orderBy('fetured','desc')->latest()->limit(12)->get(['id','name']);
@endphp
<section class="tx-brands">
    <div class="container">
        <div class="tx-brand-row">
            @forelse($txTechs as $tech)
                @if($tech->imageFile)
                <div class="tx-brand tx-brand-logo"><img src="{{ asset($tech->image()) }}" alt="{{ $tech->name }}" title="{{ $tech->name }}" loading="lazy"></div>
                @else
                <div class="tx-brand">{{ $tech->name }}</div>
                @endif
            @empty
                {{-- Sample logos until technologies are added in the admin panel --}}
                <div class="tx-brand xs"><i class="fa-solid fa-envelope-open" style="font-size:44px"></i><span>MIGHTY<br>BUILDING</span></div>
                <div class="tx-brand" style="font-family:Georgia,serif;font-weight:700">Jupiter</div>
                <div class="tx-brand"><i class="fa-solid fa-cube"></i>dyte</div>
                <div class="tx-brand" style="font-weight:500">fampay<i class="fa-solid fa-check" style="font-size:28px"></i></div>
                <div class="tx-brand sm"><i class="fa-solid fa-location-dot" style="font-size:34px;letter-spacing:0"></i>SWIGG</div>
            @endforelse
        </div>
    </div>
</section>
