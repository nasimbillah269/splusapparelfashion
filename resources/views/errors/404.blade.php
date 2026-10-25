@extends(welcomeTheme().'layouts.master')
@section('title')
<title>{{websiteTitle('Page Not Found')}}</title>
@endsection

@push('css')
<style>
    .zf-404{background:#f2f2f2;padding:110px 15px 120px;text-align:center;font-family:'Rubik',sans-serif;color:#222}
    .zf-404 h1{font-family:'Teko',sans-serif;font-weight:600;font-size:200px;line-height:.85;color:#fd5b00;margin:0}
    .zf-404 h2{font-family:'Teko',sans-serif;font-weight:500;font-size:48px;color:#1d1d1d;margin:10px 0 8px}
    .zf-404 p{max-width:480px;margin:0 auto 32px;font-size:15px}
    .zf-404 .zf-btn{display:inline-block;background:#fd5b00;color:#fff;font-family:'Teko',sans-serif;font-size:17px;letter-spacing:.5px;text-transform:uppercase;padding:12px 30px 9px;text-decoration:none;transition:.3s}
    .zf-404 .zf-btn:hover{background:#d94e00;color:#fff}
    @media (max-width:575px){ .zf-404 h1{font-size:130px} .zf-404 h2{font-size:36px} }
</style>
@endpush

@section('contents')
<section class="zf-404">
    <h1>404</h1>
    <h2>Oops! Page Not Found</h2>
    <p>The page you are looking for may have been moved, renamed or is no longer available.</p>
    <a href="{{route('index')}}" class="zf-btn"><i class="fa-solid fa-house"></i> Return Home</a>
</section>
@endsection
