{{-- One project card. $p comes from projectCards() in app/helpers.php --}}
<div class="tx-case-slide">
    <img src="{{ $p['image'] }}" alt="{{ $p['name'] }}" loading="lazy">
    <div class="tx-case-info">
        @if($p['cat'])
        <small>{{ $p['cat'] }}</small>
        @endif
        <h4><span>{{ $p['line1'] }}</span>@if($p['line2'])<br><span>{{ $p['line2'] }}</span>@endif</h4>
        @if($p['text'])
        <p>{{ $p['text'] }}</p>
        @endif
        @if(!empty($p['link']))
        <a href="{{ $p['link'] }}" class="tx-view-btn" target="_blank" rel="noopener">View Project <i class="ti ti-arrow-up-right"></i></a>
        @endif
    </div>
</div>
