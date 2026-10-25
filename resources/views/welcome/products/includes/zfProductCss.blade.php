{{-- Shared look for the product pages (same theme as the home page) --}}
@push('css')
<style>
    .zf-home{font-family:'Rubik',sans-serif;color:#222;font-size:14px;line-height:1.7}
    .zf-home h1,.zf-home h2,.zf-home h3,.zf-home h4,.zf-home h5{font-family:'Teko',sans-serif;font-weight:500;color:#1d1d1d;margin:0;line-height:1.1;text-transform:none}
    .zf-home p{margin:0}
    .zf-home img{max-width:100%;display:block}
    .zf-sub{display:block;font-size:11px;font-weight:600;letter-spacing:.5px;text-transform:uppercase;color:#fd5b00;margin-bottom:8px}
    .zf-wrap{max-width:1170px;margin:0 auto;padding:0 15px}
    .zf-center{text-align:center}
    .zf-title{font-size:56px;margin-bottom:45px}
    .zf-title b{color:#fd5b00;font-weight:600}
    .zf-btn{display:inline-flex;align-items:center;gap:10px;background:#fd5b00;color:#fff;font-family:'Teko',sans-serif;font-size:18px;letter-spacing:.5px;text-transform:uppercase;padding:13px 30px 10px;border:2px solid #fd5b00;text-decoration:none;transition:.3s}
    .zf-btn:hover{background:#d94e00;border-color:#d94e00;color:#fff}
    .zf-btn.line{background:transparent;color:#222;border-color:#222}
    .zf-btn.line:hover{background:#222;color:#fff}
    .zf-empty{background:#f2f2f2;padding:50px 20px;text-align:center;font-family:'Teko',sans-serif;font-size:22px;color:#777}

    /* Page banner: same white frame as the home hero */
    .zf-pbanner{position:relative;height:420px;display:flex;align-items:center;background:#1a3c8f center/cover no-repeat}
    .zf-pbanner::before{content:"";position:absolute;inset:0;background:rgba(10,30,90,.45)}
    .zf-pbanner .zf-wrap{position:relative;width:100%}
    .zf-pbox{position:relative;display:inline-block;padding:45px 45px 40px;max-width:100%}
    .zf-pbox::before{content:"";position:absolute;left:0;top:0;bottom:0;width:260px;border:9px solid #fff;border-right:0;transform:scaleY(0);transform-origin:top;animation:zfFrame .8s ease .2s forwards}
    .zf-pbox::after{content:"";position:absolute;left:0;top:0;width:260px;border-top:9px solid #fff}
    @keyframes zfFrame{to{transform:scaleY(1)}}
    .zf-pbox h1{color:#fff;font-size:70px;position:relative}
    .zf-crumb{display:flex;flex-wrap:wrap;gap:10px;list-style:none;margin:6px 0 0;padding:0;font-family:'Teko',sans-serif;font-size:18px;color:#fff;position:relative}
    .zf-crumb li + li::before{content:"/";margin-right:10px;color:#fd5b00}
    .zf-crumb a{color:#fff;text-decoration:none}
    .zf-crumb a:hover{color:#fd5b00}

    /* Category cards */
    .zf-pcat-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:20px}
    .zf-pcat{position:relative;height:360px;overflow:hidden;display:block;text-decoration:none;background:#2a2b30}
    .zf-pcat img{width:100%;height:100%;object-fit:cover;transition:transform .7s}
    .zf-pcat:hover img{transform:scale(1.1)}
    .zf-pcat::after{content:"";position:absolute;inset:0;background:linear-gradient(transparent 35%,rgba(0,0,0,.85))}
    .zf-pcat-body{position:absolute;left:0;right:0;bottom:0;padding:24px;z-index:1;display:flex;align-items:flex-end;justify-content:space-between;gap:10px;text-align:left}
    .zf-pcat h3{color:#fff;font-size:28px;border-left:4px solid #fd5b00;padding-left:12px}
    .zf-pcat small{display:block;color:#ccc;font-size:12px;padding-left:16px;margin-top:4px}
    .zf-pcat .arrow{width:42px;height:42px;flex:0 0 42px;background:#fd5b00;color:#fff;display:flex;align-items:center;justify-content:center;transform:translateX(60px);transition:.4s}
    .zf-pcat:hover .arrow{transform:none}

    /* Product card */
    .zf-pgrid{display:grid;grid-template-columns:repeat(3,1fr);gap:25px}
    .zf-pgrid.cols-4{grid-template-columns:repeat(4,1fr)}
    .zf-pcard{background:#fff;border:1px solid #ececec;transition:.35s;display:flex;flex-direction:column}
    .zf-pcard:hover{box-shadow:0 15px 35px rgba(0,0,0,.09);transform:translateY(-5px);border-color:transparent}
    .zf-pcard-img{position:relative;display:block;height:300px;overflow:hidden;background:#f2f2f2}
    .zf-pcard-img img{width:100%;height:100%;object-fit:cover;transition:transform .7s}
    .zf-pcard:hover .zf-pcard-img img{transform:scale(1.08)}
    .zf-pcard-img .view{position:absolute;left:50%;bottom:20px;transform:translate(-50%,20px);opacity:0;background:#fd5b00;color:#fff;font-family:'Teko',sans-serif;font-size:16px;letter-spacing:.5px;text-transform:uppercase;padding:9px 22px 6px;white-space:nowrap;transition:.35s}
    .zf-pcard:hover .zf-pcard-img .view{opacity:1;transform:translate(-50%,0)}
    .zf-pcard-body{padding:20px 22px 22px;border-top:3px solid #fd5b00;flex:1}
    .zf-pcard-body small{display:block;color:#fd5b00;font-size:11px;font-weight:600;text-transform:uppercase;letter-spacing:.5px;margin-bottom:4px}
    .zf-pcard-body h3{font-size:24px}
    .zf-pcard-body h3 a{color:#1d1d1d;text-decoration:none;transition:.25s}
    .zf-pcard-body h3 a:hover{color:#fd5b00}
    .zf-pcard-body p{font-size:13px;color:#666;margin-top:6px}

    /* Pagination */
    .zf-home ul.pager{display:flex;flex-wrap:wrap;justify-content:center;gap:6px;list-style:none;padding:0;margin:45px 0 0}
    .zf-home ul.pager li{padding:0}
    .zf-home ul.pager a,.zf-home ul.pager span{display:flex;align-items:center;justify-content:center;min-width:42px;height:42px;padding:0 12px;border:1px solid #ddd;color:#222;text-decoration:none;font-family:'Teko',sans-serif;font-size:18px}
    .zf-home ul.pager .active span,.zf-home ul.pager a:hover{background:#fd5b00;border-color:#fd5b00;color:#fff}
    .zf-home ul.pager .disabled span{color:#bbb}

    /* CTA */
    .zf-cta-wrap{background:linear-gradient(#f2f2f2 50%,#fff 50%);padding:0 0 110px}
    .zf-cta{max-width:1200px;margin:0 auto;background:#fff;box-shadow:0 5px 30px rgba(0,0,0,.08);display:flex;align-items:center;padding:42px 90px;gap:40px}
    .zf-cta .zf-sub{font-family:'Teko',sans-serif;letter-spacing:2px;font-weight:400;font-size:14px}
    .zf-cta h3{font-size:44px}
    .zf-cta-left{flex:1}

    @media (max-width:1199px){
        .zf-pcat-grid,.zf-pgrid.cols-4{grid-template-columns:repeat(3,1fr)}
        .zf-cta{padding:40px}
    }
    @media (max-width:991px){
        .zf-pbanner{height:340px}
        .zf-pbox h1{font-size:52px}
        .zf-pcat-grid,.zf-pgrid,.zf-pgrid.cols-4{grid-template-columns:repeat(2,1fr)}
        .zf-cta{flex-direction:column;text-align:center;margin:0 15px}
    }
    @media (max-width:575px){
        .zf-pbanner{height:280px}
        .zf-pbox{padding:30px 25px}
        .zf-pbox::before,.zf-pbox::after{width:180px}
        .zf-pbox h1{font-size:40px}
        .zf-title{font-size:38px}
        .zf-pcat-grid,.zf-pgrid,.zf-pgrid.cols-4{grid-template-columns:1fr}
        .zf-pcat{height:300px}
        .zf-pcat .arrow{transform:none}
        .zf-pcard-img{height:320px}
        .zf-cta{padding:30px 20px}
    }
</style>
@endpush
