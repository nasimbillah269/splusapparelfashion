{{-- Company certificates (home page + Certification page). Images live in public/images/certificates. --}}
@php
    $zfCertDocs = [
        ['bgbha-membership.webp', 's/b BGBA'],
        ['trade-license.webp', 'Trade License (DNCC)'],
        ['vat-registration.webp', 's/b BIN Certificate'],
        ['buying-house-registration.webp', 'Buying House Registration (DOT)'],
    ];
@endphp
<style>
    .zf-cert-docs{display:grid;grid-template-columns:repeat(4,1fr);gap:30px;padding-bottom:80px}
    .zf-cert-doc{display:block;background:#fff;padding:15px 15px 20px;color:inherit;text-decoration:none;box-shadow:0 5px 20px rgba(0,0,0,.05);transition:.3s}
    .zf-cert-doc:hover{transform:translateY(-5px);box-shadow:0 12px 30px rgba(0,0,0,.1)}
    .zf-cert-doc .img{aspect-ratio:7/5;overflow:hidden;background:#fff;border:1px solid #eee}
    .zf-cert-doc img{width:100%;height:100%;object-fit:contain}
    .zf-cert-doc h4{font-size:20px;margin:16px 0 0;transition:color .3s}
    .zf-cert-doc:hover h4{color:#fd5b00}
    @media (max-width:991px){ .zf-cert-docs{grid-template-columns:repeat(2,1fr)} }
    @media (max-width:575px){ .zf-cert-docs{grid-template-columns:1fr;gap:20px} }
</style>
<div class="zf-cert-docs">
    @foreach($zfCertDocs as $d)
    <a href="{{ asset('images/certificates/'.$d[0]) }}" class="zf-cert-doc" target="_blank" rel="noopener">
        <div class="img"><img src="{{ asset('images/certificates/'.$d[0]) }}" alt="{{ $d[1] }}" loading="lazy"></div>
        <h4>{{ $d[1] }}</h4>
    </a>
    @endforeach
</div>
