{{-- Certification logos row (home page + Certification page).
     Logos uploaded in Admin > Galleries (location "Certification Page") replace the built-in ones. --}}
@php
    $certLogoGallery = \App\Models\Attribute::where('type',4)->where('status','active')->where('location','Certification Page')->first();
    $certLogoFiles = $certLogoGallery
        ? \App\Models\Media::where('src_type',3)->where('use_Of_file',3)->where('src_id',$certLogoGallery->id)->orderBy('drag')->get()
        : collect();
@endphp
@once
@push('css')
<style>
    .zf-cert-logos{display:flex;justify-content:center;align-items:center;gap:70px;flex-wrap:wrap;padding-bottom:80px}
    .zf-cert-logos .logo{height:110px;display:flex;align-items:center;justify-content:center;transition:.3s;filter:grayscale(.1)}
    .zf-cert-logos .logo:hover{transform:scale(1.07)}
    .zf-cert-logos svg{height:100%;width:auto}
    .zf-cert-logos img{max-height:100%;max-width:200px;width:auto;object-fit:contain}
    @media (max-width:767px){ .zf-cert-logos{gap:35px} .zf-cert-logos .logo{height:80px} }
</style>
@endpush
@endonce
<div class="zf-cert-logos">
    @if($certLogoFiles->count())
        @foreach($certLogoFiles as $logo)
        @php $logoName = $logo->caption ?: Str::headline((string) $logo->alt_text); @endphp
        <div class="logo" title="{{ $logoName }}"><img src="{{ asset($logo->image()) }}" alt="{{ $logoName }}" loading="lazy"></div>
        @endforeach
    @else
    <div class="logo" title="Sedex">
        <svg viewBox="0 0 120 120"><circle cx="60" cy="60" r="56" fill="none" stroke="#bbb" stroke-dasharray="2 3"/><circle cx="60" cy="60" r="34" fill="#fd5b00"/><text x="60" y="66" text-anchor="middle" font-family="Arial" font-weight="700" font-size="16" fill="#fff">Sedex</text></svg>
    </div>
    <div class="logo" title="OEKO-TEX STeP">
        <svg viewBox="0 0 170 90"><text x="85" y="38" text-anchor="middle" font-family="Arial" font-weight="700" font-size="26" fill="#666">OEKO-TEX<tspan font-size="12">®</tspan></text><text x="85" y="54" text-anchor="middle" font-family="Arial" font-size="8" fill="#888">CONFIDENCE IN TEXTILES</text><text x="112" y="74" text-anchor="middle" font-family="Arial" font-weight="700" font-size="15" fill="#4a7fc1">STeP</text><rect x="134" y="61" width="16" height="16" rx="3" fill="#6ab04c"/></svg>
    </div>
    <div class="logo" title="Confidence in Textiles">
        <svg viewBox="0 0 150 100"><path d="M10 70 Q75 0 140 50" fill="none" stroke="#3a9a3a" stroke-width="5"/><circle cx="110" cy="35" r="16" fill="none" stroke="#e8a23b" stroke-width="4" stroke-dasharray="3 2"/><text x="75" y="60" text-anchor="middle" font-family="Arial" font-weight="700" font-size="13" fill="#fd5b00">CONFIDENCE</text><text x="75" y="74" text-anchor="middle" font-family="Arial" font-weight="700" font-size="11" fill="#fd5b00">IN TEXTILES</text><text x="75" y="88" text-anchor="middle" font-family="Arial" font-size="7" fill="#3a9a3a">Tested for harmful substances</text></svg>
    </div>
    <div class="logo" title="ISO">
        <svg viewBox="0 0 150 100"><ellipse cx="75" cy="50" rx="62" ry="40" fill="none" stroke="#1d6fb8" stroke-width="3"/><path d="M13 50 H137 M75 10 V90" stroke="#1d6fb8" stroke-width="2"/><text x="75" y="64" text-anchor="middle" font-family="Arial Black,Arial" font-weight="900" font-size="42" fill="#1d6fb8" stroke="#fff" stroke-width="1.5" paint-order="stroke">ISO</text></svg>
    </div>
    <div class="logo" title="GOTS">
        <svg viewBox="0 0 120 120"><circle cx="60" cy="60" r="56" fill="#fff" stroke="#0a8a3a" stroke-width="3"/><circle cx="60" cy="60" r="34" fill="#0a8a3a"/><path d="M60 38 C45 50 45 70 60 84 C75 70 75 50 60 38Z" fill="#fff"/><path d="M60 46 V80" stroke="#0a8a3a" stroke-width="3"/><text x="60" y="20" text-anchor="middle" font-family="Arial" font-weight="700" font-size="9" fill="#0a8a3a">GLOBAL ORGANIC TEXTILE</text><text x="60" y="110" text-anchor="middle" font-family="Arial" font-weight="700" font-size="10" fill="#0a8a3a">GOTS</text></svg>
    </div>
    @endif
</div>
