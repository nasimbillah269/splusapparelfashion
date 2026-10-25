@extends(welcomeTheme().'layouts.master')
@section('title')
<title>{{$page->seo_title?:websiteTitle($page->name)}}</title>
@endsection
@section('SEO')
<meta name="title" property="og:title" content="{{$page->seo_title?:websiteTitle($page->name)}}" />
<meta name="description" property="og:description" content="{!!$page->seo_description?:general()->meta_description!!}" />
<meta name="keywords" content="{{$page->seo_keyword?:general()->meta_keyword}}" />
<meta name="image" property="og:image" content="{{asset($page->image())}}" />
<meta name="url" property="og:url" content="{{route('pageView',$page->slug?:'no-title')}}" />
<link rel="canonical" href="{{route('pageView',$page->slug?:'no-title')}}">
@endsection
@push('css')
<style>
    .zf-home{font-family:'Rubik',sans-serif;color:#222;font-size:14px;line-height:1.7}
    .zf-home h1,.zf-home h2,.zf-home h3,.zf-home h4,.zf-home h5{font-family:'Teko',sans-serif;font-weight:500;color:#1d1d1d;margin:0;line-height:1.1;text-transform:none}
    .zf-home p{margin:0}
    .zf-home img{max-width:100%;display:block}
    .zf-sub{display:block;font-size:11px;font-weight:600;letter-spacing:.5px;text-transform:uppercase;color:#fd5b00;margin-bottom:8px}
    .zf-wrap{max-width:1170px;margin:0 auto;padding:0 15px}
    .zf-center{text-align:center}

    /* Page banner: same white frame as the home hero */
    .zf-pbanner{position:relative;height:460px;display:flex;align-items:center;background:#1a3c8f center/cover no-repeat}
    .zf-pbanner::before{content:"";position:absolute;inset:0;background:rgba(10,30,90,.45)}
    .zf-pbanner .zf-wrap{position:relative;width:100%}
    .zf-pbox{position:relative;display:inline-block;padding:45px 45px 40px}
    .zf-pbox::before{content:"";position:absolute;left:0;top:0;bottom:0;width:260px;border:9px solid #fff;border-right:0;transform:scaleY(0);transform-origin:top;animation:zfFrame .8s ease .2s forwards}
    .zf-pbox::after{content:"";position:absolute;left:0;top:0;width:260px;border-top:9px solid #fff}
    @keyframes zfFrame{to{transform:scaleY(1)}}
    .zf-pbox h1{color:#fff;font-size:76px;position:relative}
    .zf-crumb{display:flex;flex-wrap:wrap;gap:10px;list-style:none;margin:6px 0 0;padding:0;font-family:'Teko',sans-serif;font-size:18px;color:#fff;position:relative}
    .zf-crumb li + li::before{content:"/";margin-right:10px;color:#fd5b00}
    .zf-crumb a{color:#fff;text-decoration:none}
    .zf-crumb a:hover{color:#fd5b00}

    /* Main + sidebar */
    .zf-sp{background:#fff;padding:100px 0 90px}
    .zf-sp > .zf-wrap{display:grid;grid-template-columns:1fr 340px;gap:50px;align-items:start}
    .zf-sp-hero{position:relative;height:440px;overflow:hidden;margin-bottom:45px}
    .zf-sp-hero img{width:100%;height:100%;object-fit:cover}
    .zf-sp-hero .icon{position:absolute;left:0;bottom:0;width:110px;height:110px;background:#fd5b00;color:#fff;display:flex;align-items:center;justify-content:center;font-size:54px}
    .zf-sp-main h2{font-size:50px;margin-bottom:20px}
    .zf-sp-main h2 b{color:#fd5b00;font-weight:600}
    .zf-sp-lead{font-size:17px;color:#444;border-left:4px solid #fd5b00;padding-left:20px;margin-bottom:20px;line-height:1.7}
    .zf-sp-body p{text-align:justify;margin-bottom:14px;font-size:15px;line-height:1.85}
    .zf-sp-body h3,.zf-sp-body h4{font-size:28px;margin:24px 0 10px}
    .zf-sp-body ul{padding-left:20px;margin-bottom:16px}
    .zf-sp-split{display:grid;grid-template-columns:1fr 1fr;gap:30px;align-items:center;margin:35px 0 50px}
    .zf-sp-split .img{height:280px;overflow:hidden}
    .zf-sp-split .img img{width:100%;height:100%;object-fit:cover}
    .zf-checks{list-style:none;padding:0;margin:0;display:grid;gap:12px}
    .zf-checks li{display:flex;gap:12px;align-items:flex-start;font-family:'Teko',sans-serif;font-size:19px;line-height:1.25}
    .zf-checks i{color:#fd5b00;margin-top:3px;font-size:16px}
    .zf-sp-h3{font-size:36px;margin-bottom:24px}
    .zf-feat-grid{display:grid;grid-template-columns:1fr 1fr;gap:20px}
    .zf-feat{display:flex;gap:18px;background:#f2f2f2;padding:28px 25px;transition:.35s;border-bottom:3px solid transparent}
    .zf-feat:hover{background:#2a2b30;border-color:#fd5b00}
    .zf-feat i{font-size:42px;color:#fd5b00;flex:0 0 42px;line-height:1}
    .zf-feat h4{font-size:24px;margin-bottom:6px;transition:.35s}
    .zf-feat p{font-size:13px;transition:.35s}
    .zf-feat:hover h4{color:#fff}
    .zf-feat:hover p{color:#b5b5b5}

    .zf-side{position:sticky;top:140px;display:grid;gap:30px}
    .zf-side-box{background:#f2f2f2;padding:30px 28px}
    .zf-side-box h4{font-size:28px;margin-bottom:18px;padding-bottom:12px;border-bottom:2px solid #e2e2e2;position:relative}
    .zf-side-box h4::after{content:"";position:absolute;left:0;bottom:-2px;width:50px;height:2px;background:#fd5b00}
    .zf-side-nav{list-style:none;margin:0;padding:0;display:grid;gap:8px}
    .zf-side-nav a{display:flex;justify-content:space-between;align-items:center;background:#fff;padding:13px 18px;color:#222;font-family:'Teko',sans-serif;font-size:18px;text-decoration:none;transition:.3s}
    .zf-side-nav a i{font-size:12px;color:#fd5b00;transition:.3s}
    .zf-side-nav a:hover,.zf-side-nav a.active{background:#fd5b00;color:#fff}
    .zf-side-nav a:hover i,.zf-side-nav a.active i{color:#fff}
    .zf-side-help{position:relative;background:#2a2b30 center/cover no-repeat;padding:40px 30px;color:#fff;overflow:hidden}
    .zf-side-help::before{content:"";position:absolute;inset:0;background:rgba(42,43,48,.88)}
    .zf-side-help > *{position:relative}
    .zf-side-help i.big{font-size:46px;color:#fd5b00;display:block;margin-bottom:10px}
    .zf-side-help h4{color:#fff !important;font-size:30px;margin-bottom:8px}
    .zf-side-help p{color:#ccc;font-size:13px;margin-bottom:18px}
    .zf-side-help a{display:block;color:#fff;font-family:'Teko',sans-serif;font-size:22px;text-decoration:none;line-height:1.3}
    .zf-side-help a:hover{color:#fd5b00}

    /* Numbers */
    .zf-sp-stats{background:#fd5b00;padding:60px 0}
    .zf-sp-stats .zf-wrap{display:grid;grid-template-columns:repeat(3,1fr);gap:20px}
    .zf-sp-stat{display:flex;align-items:center;gap:20px;color:#fff;padding-left:25px;border-left:1px solid rgba(255,255,255,.35)}
    .zf-sp-stat b{font-family:'Teko',sans-serif;font-size:58px;font-weight:500;line-height:.9}
    .zf-sp-stat small{font-family:'Teko',sans-serif;font-size:18px;line-height:1.15;text-transform:uppercase;letter-spacing:.5px}

    /* Process */
    .zf-steps{background:#f2f2f2;padding:95px 0 100px}
    .zf-steps h2{font-size:56px;margin-bottom:50px}
    .zf-steps h2 b{color:#fd5b00;font-weight:600}
    .zf-step-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:25px}
    .zf-step{position:relative;background:#fff;padding:45px 28px 35px;text-align:left;transition:.35s}
    .zf-step:hover{transform:translateY(-6px);box-shadow:0 15px 30px rgba(0,0,0,.08)}
    .zf-step .no{position:absolute;right:22px;top:12px;font-family:'Teko',sans-serif;font-size:64px;line-height:1;color:rgba(253,91,0,.12)}
    .zf-step i{font-size:44px;color:#fd5b00;display:block;margin-bottom:16px}
    .zf-step h4{font-size:26px;margin-bottom:8px}
    .zf-step p{font-size:13px}

    /* Prev / next */
    .zf-sp-pager{background:#fff;border-bottom:1px solid #eee}
    .zf-sp-pager .zf-wrap{display:flex;justify-content:space-between;gap:20px;padding-top:35px;padding-bottom:35px}
    .zf-sp-pager a{display:flex;align-items:center;gap:16px;color:#222;text-decoration:none}
    .zf-sp-pager a.next{text-align:right;margin-left:auto}
    .zf-sp-pager a i{width:50px;height:50px;border:2px solid #222;display:flex;align-items:center;justify-content:center;transition:.3s;flex:0 0 50px}
    .zf-sp-pager a:hover i{background:#fd5b00;border-color:#fd5b00;color:#fff}
    .zf-sp-pager small{display:block;font-size:11px;font-weight:600;text-transform:uppercase;color:#fd5b00;letter-spacing:.5px}
    .zf-sp-pager span{font-family:'Teko',sans-serif;font-size:24px;line-height:1.1}

    /* CTA */
    .zf-cta-wrap{background:linear-gradient(#f2f2f2 50%,#fff 50%);padding:0 0 110px}
    .zf-cta{max-width:1200px;margin:0 auto;background:#fff;box-shadow:0 5px 30px rgba(0,0,0,.08);display:flex;align-items:center;padding:42px 90px;gap:40px}
    .zf-cta .zf-sub{font-family:'Teko',sans-serif;letter-spacing:2px;font-weight:400;font-size:14px}
    .zf-cta h3{font-size:44px}
    .zf-cta-left{flex:1}
    .zf-btn-line{display:inline-block;border:2px solid #222;font-family:'Teko',sans-serif;font-size:16px;text-transform:uppercase;color:#222;padding:12px 26px 9px;text-decoration:none;transition:.3s;white-space:nowrap}
    .zf-btn-line:hover{background:#fd5b00;border-color:#fd5b00;color:#fff}

    @media (max-width:1199px){
        .zf-sp > .zf-wrap{grid-template-columns:1fr 300px;gap:35px}
        .zf-step-grid{grid-template-columns:repeat(2,1fr)}
        .zf-cta{padding:40px}
    }
    @media (max-width:991px){
        .zf-pbanner{height:360px}
        .zf-pbox h1{font-size:56px}
        .zf-sp{padding:70px 0}
        .zf-sp > .zf-wrap{grid-template-columns:1fr}
        .zf-side{position:static}
        .zf-sp-stats .zf-wrap{grid-template-columns:1fr;gap:25px}
        .zf-cta{flex-direction:column;text-align:center;margin:0 15px}
    }
    @media (max-width:575px){
        .zf-pbanner{height:300px}
        .zf-pbox{padding:30px 25px}
        .zf-pbox::before,.zf-pbox::after{width:180px}
        .zf-pbox h1{font-size:42px}
        .zf-sp-hero{height:280px}
        .zf-sp-hero .icon{width:80px;height:80px;font-size:38px}
        .zf-sp-main h2,.zf-steps h2{font-size:38px}
        .zf-sp-split,.zf-feat-grid,.zf-step-grid{grid-template-columns:1fr}
        .zf-sp-pager .zf-wrap{flex-direction:column}
        .zf-sp-pager a.next{margin-left:0;justify-content:flex-end}
        .zf-cta{padding:30px 20px}
    }
</style>
@endpush

@section('contents')
@php
    $zfImg = fn($id, $w = 1200) => str_contains($id, '/') ? asset($id) : 'https://images.unsplash.com/photo-'.$id.'?auto=format&fit=crop&w='.$w.'&q=75';

    // Content for each service page, keyed by page slug.
    // Admin can still override: Description (main text), Feature Image (main photo), Banner.
    $svcPages = [
        'research-development' => [
            'icon' => 'ti ti-bulb',
            'title' => 'Ideas Turned Into <b>Ready Products</b>',
            'lead' => 'Our in-house R&D team studies trends, fabrics and costing so every new style reaches you market ready and on budget.',
            'text' => [
                'Product development starts long before the first sample. Our designers and technical team follow global trend reports, fabric innovations and buyer seasons to propose fresh, commercial styles for your range.',
                'We test new fabric qualities, washes, prints and finishes, then build tech packs and costing that match your target price. This saves time in sampling and helps you make faster buying decisions.',
            ],
            'checks' => ['Trend research and seasonal forecasting', 'New fabric, wash and print development', 'Tech pack and pattern support', 'Target price costing and value engineering'],
            'features' => [
                ['ti ti-trending-up', 'Trend Analysis', 'Seasonal mood boards and colour stories for your market.'],
                ['ti ti-flask', 'Fabric Innovation', 'New blends, sustainable yarns and special finishes.'],
                ['ti ti-ruler-measure', 'Technical Design', 'Accurate tech packs, specs and grading.'],
                ['ti ti-calculator', 'Smart Costing', 'Options that hit your price without losing quality.'],
            ],
            'stats' => [['500+', 'New Styles<br>Every Year'], ['30+', 'Fabric<br>Innovations'], ['48h', 'Costing<br>Turnaround']],
            'steps' => [
                ['ti ti-search', 'Research', 'Study trends, buyer history and target market.'],
                ['ti ti-pencil', 'Concept', 'Sketches, mood boards and fabric options.'],
                ['ti ti-file-description', 'Tech Pack', 'Specs, measurements and bill of materials.'],
                ['ti ti-coin', 'Costing', 'Final price ready for sample approval.'],
            ],
            'img' => ['1452860606245-08befc0ff44b', '1519389950473-47ba0277781c'],
        ],
        'sample-development' => [
            'icon' => 'ti ti-needle-thread',
            'title' => 'Fast And Accurate <b>Sampling</b>',
            'lead' => 'From proto to PP sample, our sampling unit turns your design into a real garment quickly and exactly to spec.',
            'text' => [
                'A good sample is the base of a smooth bulk order. Our dedicated sample room works with skilled pattern makers and sample machinists who follow your tech pack and comments closely.',
                'We submit proto, fit, size set, salesman and pre-production samples on a clear timeline, and we keep every comment recorded so the bulk matches the approved sample.',
            ],
            'checks' => ['Proto, fit and size set samples', 'Salesman and photo samples', 'Pre-production (PP) samples', 'Lab dips, strike-offs and wash tests'],
            'features' => [
                ['ti ti-scissors', 'Pattern Making', 'CAD and manual patterns with accurate grading.'],
                ['ti ti-hanger', 'Fit Samples', 'Fit corrections made quickly from your comments.'],
                ['ti ti-palette', 'Lab Dips', 'Colour matching to your standard under light box.'],
                ['ti ti-truck-delivery', 'Quick Courier', 'Samples dispatched to your office on schedule.'],
            ],
            'stats' => [['7', 'Days Proto<br>Sample'], ['98%', 'First Fit<br>Approval'], ['2000+', 'Samples<br>Per Year']],
            'steps' => [
                ['ti ti-file-text', 'Tech Pack Review', 'Check specs, trims and fabric details.'],
                ['ti ti-scissors', 'Pattern & Cutting', 'Pattern made and sample fabric cut.'],
                ['ti ti-needle', 'Sewing', 'Sample sewn by senior machinists.'],
                ['ti ti-send', 'Submission', 'Measured, checked and sent for approval.'],
            ],
            'img' => ['images/sample-jeans-rack.jpg', 'images/sample-tshirt-rack.jpg'],
        ],
        'merchandising' => [
            'icon' => 'ti ti-users-group',
            'title' => 'One Team Managing <b>Your Order</b>',
            'lead' => 'Our merchandisers are your single point of contact, managing every detail from enquiry to shipment.',
            'text' => [
                'Each buyer gets a dedicated merchandising team that understands their brand, quality standard and timeline. They handle costing, sampling, material booking and production follow-up for you.',
                'With a clear time and action plan and regular updates, you always know the status of your order. Problems are solved early, before they affect your delivery date.',
            ],
            'checks' => ['Dedicated merchandiser for each buyer', 'Time and action (T&A) calendar', 'Weekly order status reports', 'Material booking and follow-up'],
            'features' => [
                ['ti ti-calendar-event', 'T&A Planning', 'A clear calendar for every milestone of the order.'],
                ['ti ti-message-dots', 'Fast Response', 'Replies to buyer queries within 24 hours.'],
                ['ti ti-checklist', 'Order Tracking', 'Material, production and inspection followed daily.'],
                ['ti ti-report-analytics', 'Status Reports', 'Regular reports with photos and updates.'],
            ],
            'stats' => [['24h', 'Response<br>Time'], ['40+', 'Buyers<br>Managed'], ['100%', 'Order<br>Visibility']],
            'steps' => [
                ['ti ti-mail', 'Enquiry', 'Receive design, quantity and target price.'],
                ['ti ti-file-dollar', 'Quotation', 'Costing and factory selection.'],
                ['ti ti-calendar', 'Order Planning', 'T&A plan and material booking.'],
                ['ti ti-eye-check', 'Follow-up', 'Production tracked until shipment.'],
            ],
            'img' => ['1517245386807-bb43f82c33c4', '1567401893414-76b7b1e5a7a5'],
        ],
        'fabric-sourcing' => [
            'icon' => 'ti ti-texture',
            'title' => 'The Right Fabric At The <b>Right Price</b>',
            'lead' => 'We source woven, denim, knit and sweater yarns from trusted mills in Bangladesh and abroad.',
            'text' => [
                'Fabric is the largest part of a garment cost and the heart of its quality. Our sourcing team works with a wide network of local and overseas mills to find the right quality, weight and finish for every style.',
                'We check fabric test reports, shrinkage, colour fastness and GSM before bulk, and we can source certified organic, recycled and BCI cotton fabrics on request.',
            ],
            'checks' => ['Woven, denim, knit and yarn sourcing', 'Organic, recycled and BCI options', 'Fabric testing before bulk cutting', 'Competitive mill prices and lead times'],
            'features' => [
                ['ti ti-building-factory-2', 'Trusted Mills', 'Long term partners in Bangladesh, China and India.'],
                ['ti ti-leaf', 'Sustainable Choices', 'Certified organic and recycled fabrics.'],
                ['ti ti-microscope', 'Fabric Testing', 'Shrinkage, GSM and colour fastness checked.'],
                ['ti ti-clock-hour-4', 'Short Lead Time', 'Greige stock and local mills for fast orders.'],
            ],
            'stats' => [['50+', 'Partner<br>Mills'], ['3', 'Sourcing<br>Countries'], ['100%', 'Tested<br>Fabric']],
            'steps' => [
                ['ti ti-list-search', 'Requirement', 'Quality, weight, width and finish defined.'],
                ['ti ti-swatch', 'Swatches', 'Mill options and swatches shared.'],
                ['ti ti-test-pipe', 'Testing', 'Lab test and approval before booking.'],
                ['ti ti-package', 'Bulk Booking', 'Fabric booked and delivery tracked.'],
            ],
            'img' => ['images/fabric-swatches.jpg', 'images/fabric-shorts-rack.jpg'],
        ],
        'production' => [
            'icon' => 'ti ti-building-factory',
            'title' => 'Bulk Production With <b>Full Control</b>',
            'lead' => 'Over one million pieces a month made in compliant partner factories, managed closely by our own team.',
            'text' => [
                'We place each order in the factory that fits it best, by product type, capacity and compliance. Our production team visits the floor daily to follow cutting, sewing, finishing and packing.',
                'Daily output reports, inline checks and early problem solving keep quality high and delivery dates safe, even for large and complex orders.',
            ],
            'checks' => ['13+ compliant partner factories', 'Woven, denim, knit and sweater lines', 'Daily production and output reports', 'Inline quality checks on the floor'],
            'features' => [
                ['ti ti-shield-check', 'Compliant Factories', 'Audited factories with BSCI, WRAP and Sedex.'],
                ['ti ti-chart-bar', 'Daily Reports', 'Cutting, sewing and finishing output tracked.'],
                ['ti ti-users', 'Skilled Workforce', 'Experienced operators for every product type.'],
                ['ti ti-adjustments', 'Flexible Capacity', 'Small runs and large volume orders both handled.'],
            ],
            'stats' => [['1M', 'Pieces<br>Per Month'], ['13+', 'Partner<br>Factories'], ['4', 'Product<br>Categories']],
            'steps' => [
                ['ti ti-scissors', 'Cutting', 'Fabric relaxed, spread and cut to pattern.'],
                ['ti ti-needle-thread', 'Sewing', 'Assembled on lines with inline checks.'],
                ['ti ti-wash', 'Washing & Finishing', 'Wash, iron and final finishing.'],
                ['ti ti-box', 'Packing', 'Folded, tagged and packed to buyer standard.'],
            ],
            'img' => ['images/production-rack-wide.jpg', 'images/production-denim-jackets.jpg'],
        ],
        'qa-and-qc' => [
            'icon' => 'ti ti-rosette-discount-check',
            'title' => 'Quality Checked At <b>Every Step</b>',
            'lead' => 'Our QA and QC team inspects every order to a 2.5 AQL standard, from raw material to final packing.',
            'text' => [
                'Quality is not checked only at the end. Our QA team approves fabric and trims before cutting, our QC team performs inline and mid-line checks during sewing, and every order goes through a final random inspection.',
                'We share inspection reports with photos and welcome third-party inspections from your nominated agency at any stage.',
            ],
            'checks' => ['Raw material and trims inspection', 'Inline and mid-line inspection', 'Final random inspection at 2.5 AQL', 'Measurement, needle and metal checks'],
            'features' => [
                ['ti ti-zoom-check', 'Material Inspection', 'Fabric 4-point system and trims checked.'],
                ['ti ti-eye', 'Inline Checks', 'Defects found and fixed during sewing.'],
                ['ti ti-ruler-2', 'Measurement Audit', 'Every size checked against the spec sheet.'],
                ['ti ti-file-certificate', 'Inspection Reports', 'Detailed reports with photos for each order.'],
            ],
            'stats' => [['2.5', 'AQL<br>Standard'], ['3', 'Inspection<br>Stages'], ['0', 'Tolerance For<br>Needle Defects']],
            'steps' => [
                ['ti ti-clipboard-check', 'Pre-Production', 'Fabric, trims and PP sample approved.'],
                ['ti ti-eye-search', 'Inline', 'Random checks on every sewing line.'],
                ['ti ti-list-check', 'Pre-Final', 'Finished goods checked before packing.'],
                ['ti ti-certificate', 'Final Inspection', 'AQL inspection and shipment approval.'],
            ],
            'img' => ['images/qa-denim-jacket-wide.jpg', 'images/qa-denim-jacket.jpg'],
        ],
        'delivery-and-shipment' => [
            'icon' => 'ti ti-ship',
            'title' => 'On Time, Every <b>Shipment</b>',
            'lead' => 'We handle booking, documents and customs so your goods reach your warehouse safely and on schedule.',
            'text' => [
                'Delivery dates are a promise. Our shipping team works with trusted freight forwarders to book space early and move goods by sea or air from Chattogram and Dhaka.',
                'We prepare all export documents, follow customs clearance and share shipment tracking until your cargo arrives. FOB, CIF and DDP terms are all available.',
            ],
            'checks' => ['Sea and air freight booking', 'Export documents and customs clearance', 'FOB, CIF and DDP terms', 'Shipment tracking until arrival'],
            'features' => [
                ['ti ti-anchor', 'Sea Freight', 'FCL and LCL from Chattogram port.'],
                ['ti ti-plane', 'Air Freight', 'Urgent orders shipped by air from Dhaka.'],
                ['ti ti-file-invoice', 'Documentation', 'Invoice, packing list, B/L and certificates.'],
                ['ti ti-map-pin', 'Live Tracking', 'Updates from factory gate to your warehouse.'],
            ],
            'stats' => [['5000+', 'Shipments<br>Delivered'], ['98%', 'On Time<br>Delivery'], ['20+', 'Destination<br>Countries']],
            'steps' => [
                ['ti ti-calendar-check', 'Booking', 'Space booked with forwarder in advance.'],
                ['ti ti-files', 'Documents', 'Export papers prepared and checked.'],
                ['ti ti-truck', 'Stuffing', 'Cartons loaded and container sealed.'],
                ['ti ti-world', 'Delivery', 'Cargo tracked until arrival.'],
            ],
            'img' => ['1494412574643-ff11b0a5c1c3', '1586528116311-ad8dd3c8310d'],
        ],
        'trimming-accessories' => [
            'icon' => 'ti ti-tag',
            'title' => 'Every Detail, <b>Perfectly Matched</b>',
            'lead' => 'Buttons, zippers, labels, tags and packaging sourced to your brand standard and delivered on time.',
            'text' => [
                'Trims and accessories give a garment its brand identity. We source and develop buttons, zippers, rivets, woven and printed labels, hang tags, poly bags and cartons from nominated and approved suppliers.',
                'Every trim is approved against your standard before bulk, and booked early in the T&A plan so it never delays production.',
            ],
            'checks' => ['Buttons, zippers, rivets and snaps', 'Woven labels, care labels and hang tags', 'Poly bags, cartons and packaging', 'Nominated supplier management'],
            'features' => [
                ['ti ti-circle-dot', 'Buttons & Zippers', 'Metal, plastic and eco options to your design.'],
                ['ti ti-tags', 'Labels & Tags', 'Woven, printed and RFID labels and hang tags.'],
                ['ti ti-package', 'Packaging', 'Poly bags, cartons and stickers to buyer rules.'],
                ['ti ti-recycle', 'Eco Trims', 'Recycled and FSC certified options available.'],
            ],
            'stats' => [['100+', 'Trim<br>Suppliers'], ['100%', 'Approved Before<br>Bulk'], ['0', 'Delays From<br>Trims']],
            'steps' => [
                ['ti ti-list-details', 'Trims List', 'Bill of materials from the tech pack.'],
                ['ti ti-brush', 'Development', 'Artwork and samples made for approval.'],
                ['ti ti-shopping-cart', 'Booking', 'Bulk quantity booked with suppliers.'],
                ['ti ti-checks', 'In-House Check', 'Trims inspected before issue to line.'],
            ],
            'img' => ['1528396518501-b53b655eb9b3', '1620799140408-edc6dcb6d633'],
        ],
    ];

    $svc = $svcPages[$page->slug] ?? reset($svcPages);

    // Sidebar + prev/next: all pages that use this template, in header menu order
    $svcList = \App\Models\Post::where('type',0)->where('template','Service Page')->where('status','active')->get(['id','name','slug']);
    $svcOrder = array_keys($svcPages);
    $svcList = $svcList->sortBy(fn($p) => ($i = array_search($p->slug, $svcOrder)) === false ? 99 : $i)->values();
    $svcIdx = $svcList->search(fn($p) => $p->id == $page->id);
    $svcPrev = $svcIdx !== false && $svcIdx > 0 ? $svcList[$svcIdx - 1] : null;
    $svcNext = $svcIdx !== false && $svcIdx < $svcList->count() - 1 ? $svcList[$svcIdx + 1] : null;

    $zfBanner = $page->bannerFile ? asset($page->banner()) : $zfImg($svc['img'][0], 1920);
    $zfMain = $page->imageFile ? asset($page->image()) : $zfImg($svc['img'][0], 1200);
    $zfPhone = general()->mobile;
    $zfEmail = general()->email;
@endphp

<div class="zf-home">

<!-- ================= Banner ================= -->
<section class="zf-pbanner" style="background-image:url('{{ $zfBanner }}')">
    <div class="zf-wrap">
        <div class="zf-pbox">
            <h1>{{ $page->name }}</h1>
            <ul class="zf-crumb">
                <li><a href="{{ route('index') }}">Home</a></li>
                <li>Services</li>
                <li>{{ $page->name }}</li>
            </ul>
        </div>
    </div>
</section>

<!-- ================= Main ================= -->
<section class="zf-sp">
    <div class="zf-wrap">
        <div class="zf-sp-main">
            <div class="zf-sp-hero">
                <img src="{{ $zfMain }}" alt="{{ $page->name }}">
                <span class="icon"><i class="{{ $svc['icon'] }}"></i></span>
            </div>

            <span class="zf-sub">{{ $page->name }}</span>
            <h2>{!! $svc['title'] !!}</h2>
            <p class="zf-sp-lead">{{ $svc['lead'] }}</p>
            <div class="zf-sp-body">
                @if(trim(strip_tags((string) $page->description)))
                {!! $page->description !!}
                @else
                @foreach($svc['text'] as $t)
                <p>{{ $t }}</p>
                @endforeach
                @endif
            </div>

            <div class="zf-sp-split">
                <div class="img"><img src="{{ $zfImg($svc['img'][1], 700) }}" alt="{{ $page->name }}" loading="lazy"></div>
                <ul class="zf-checks">
                    @foreach($svc['checks'] as $c)
                    <li><i class="fa-solid fa-circle-check"></i> {{ $c }}</li>
                    @endforeach
                </ul>
            </div>

            <h3 class="zf-sp-h3">What We Offer</h3>
            <div class="zf-feat-grid">
                @foreach($svc['features'] as $f)
                <div class="zf-feat">
                    <i class="{{ $f[0] }}"></i>
                    <div>
                        <h4>{{ $f[1] }}</h4>
                        <p>{{ $f[2] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <aside class="zf-side">
            <div class="zf-side-box">
                <h4>Our Services</h4>
                <ul class="zf-side-nav">
                    @foreach($svcList as $s)
                    <li><a href="{{ route('pageView', $s->slug) }}" class="{{ $s->id == $page->id ? 'active' : '' }}">{{ $s->name }} <i class="fa-solid fa-chevron-right"></i></a></li>
                    @endforeach
                </ul>
            </div>
            <div class="zf-side-help" style="background-image:url('{{ $zfImg($svc['img'][1], 600) }}')">
                <i class="ti ti-headset big"></i>
                <h4>Need Any Help?</h4>
                <p>Talk to our team about your next order. We reply within 24 hours.</p>
                @if($zfPhone)<a href="tel:{{ preg_replace('/[^0-9+]/', '', $zfPhone) }}"><i class="fa-solid fa-phone"></i> {{ $zfPhone }}</a>@endif
                @if($zfEmail)<a href="mailto:{{ $zfEmail }}"><i class="fa-solid fa-envelope"></i> {{ $zfEmail }}</a>@endif
            </div>
        </aside>
    </div>
</section>

<!-- ================= Numbers ================= -->
<section class="zf-sp-stats">
    <div class="zf-wrap">
        @foreach($svc['stats'] as $s)
        <div class="zf-sp-stat">
            <b>{{ $s[0] }}</b>
            <small>{!! $s[1] !!}</small>
        </div>
        @endforeach
    </div>
</section>

<!-- ================= Process ================= -->
<section class="zf-steps">
    <div class="zf-wrap zf-center">
        <span class="zf-sub">How It Works</span>
        <h2>Our {{ $page->name }} <b>Process</b></h2>
        <div class="zf-step-grid">
            @foreach($svc['steps'] as $k => $s)
            <div class="zf-step">
                <span class="no">0{{ $k + 1 }}</span>
                <i class="{{ $s[0] }}"></i>
                <h4>{{ $s[1] }}</h4>
                <p>{{ $s[2] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ================= CTA ================= -->
<div class="zf-cta-wrap">
    <div class="zf-cta">
        <div class="zf-cta-left">
            <span class="zf-sub">For Business Collaboration</span>
            <h3>Discuss Your Next Order With Us</h3>
        </div>
        <a href="{{ templateUrl('Contact Us') }}" class="zf-btn-line">Contact Us</a>
    </div>
</div>

<!-- ================= Prev / next ================= -->
@if($svcPrev || $svcNext)
<nav class="zf-sp-pager">
    <div class="zf-wrap">
        @if($svcPrev)
        <a href="{{ route('pageView', $svcPrev->slug) }}" class="prev"><i class="fa-solid fa-arrow-left"></i><div><small>Previous</small><span>{{ $svcPrev->name }}</span></div></a>
        @endif
        @if($svcNext)
        <a href="{{ route('pageView', $svcNext->slug) }}" class="next"><div><small>Next</small><span>{{ $svcNext->name }}</span></div><i class="fa-solid fa-arrow-right"></i></a>
        @endif
    </div>
</nav>
@endif

</div>
@endsection
