@php
    $svcIcons = ['ti ti-fingerprint','ti ti-shield-lock','ti ti-cloud-computing','ti ti-hexagon-3d','ti ti-heart-handshake','ti ti-bulb','ti ti-cpu','ti ti-user-shield'];
@endphp
<a href="{{route('serviceView',$service->slug?:'no-title')}}" class="tx-svc-card">
    <div class="icon"><i class="{{ $svcIcons[($loop->index ?? 0) % count($svcIcons)] }}"></i></div>
    <h4>{{$service->name}}</h4>
    <p>{{ Str::limit(strip_tags($service->short_description), 90) }}</p>
</a>
