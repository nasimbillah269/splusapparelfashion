@extends(welcomeTheme().'layouts.app') @section('title')
<title>{{$page->seo_title?:websiteTitle($page->name)}}</title>
@endsection @section('SEO')
<meta name="title" property="og:title" content="{{$page->seo_title?:websiteTitle($page->name)}}" />
<meta name="description" property="og:description" content="{!!$page->seo_description?:general()->meta_description!!}" />
<meta name="keywords" content="{{$page->seo_keyword?:general()->meta_keyword}}" />
<meta name="image" property="og:image" content="{{asset($page->image())}}" />
<meta name="url" property="og:url" content="{{route('pageView',$page->slug?:'no-title')}}" />
<link rel="canonical" href="{{route('pageView',$page->slug?:'no-title')}}" />
@endsection @push('css')
<style></style>
@endpush @section('contents')

<div class="breadcrumb-area" @if($page->
    bannerFile) style="background-image:url({{asset($page->banner())}});background-repeat: no-repeat; background-size: cover;padding: 50px 0;" @endif >
    <div class="container">
        <div class="title">
            <h1>{{$page->name}}</h1>
            <ul>
                <li><a href="{{route('index')}}">Home</a></li>
                <li>{{$page->name}}</li>
            </ul>
        </div>
    </div>
</div>

<div class="blogCompany">
    <div class="container">
        <div class="pageContent">
            
            @if ($page->imageFile)
            <div class="row">
                <div class="col-md-6">
                    <div class="pageImage">
                        <img src="{{asset($page->image())}}" alt="{{$page->name}}"/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="pageDescription">
                        {!!$page->description!!}
                    </div>
                </div>
            </div>
            @else
            
            <div class="pageLeargeDescription">
                {!!$page->description!!}
            </div>
            @endif
            
            
        </div>
    </div>
    @if($page->hasNitEditorContent->count() > 0)
        @include(welcomeTheme().'pages.nitEditor.primary',['datas'=>$page->hasNitEditorContent])
    @endif
    
    
    
    
    
    
    <div class="ourTeamPart">
        <div class="container">
            <div class="teamPartHead">
                <h4>Meet Our Expert Team</h4>
                <h5>
                    "Trusted Leaders. Complete Solutions."
                </h5>
                <p>
                    Your one-stop project integration partner for building successful industries in Bangladesh.
                    At FactoryBanai.com, we unite Bangladesh’s finest industrial leaders into one integrated platform.
                    From concept design to construction, logistics, and commissioning, we deliver seamless, trusted
                    solutions for building your factory — efficiently and reliably
                </p>
            </div>
            <div class="teamRow">
                <div class="row">
                    <div class="col-md-3">
                        <div class="profileImg">
                             <img src="{{asset(assetLink().'/images/user.jpg')}}" alt="featured">
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="teamRightPart">
                            <h2>
                               <span style="color: #e80849;">Engr.</span> <span style="color: #0da5c7;font-size: 25px;">Md. Alamgir Hossain,</span> LSSGB, CSCM, MBA (IBA, DU), Engineer (ME,BUET)
                            </h2>
                            <h6>"Connecting global ambition with local execution."</h6>
                            <p>
                                Engineer Md. Alamgir Hossain is the visionary Founder and Project Integrator at
                                FactoryBanai.com. With over two decades of industrial experience and academic credentials from
                                BUET and IBA-DU, he has led complex utility and energy projects from greenfield to commercial
                                operation. He brings together Bangladesh’s finest engineering minds under one platform to offer
                                foreign investors a seamless factory setup experience. As a Lean Six Sigma and Supply Chain
                                certified professional, he ensures technical integrity, cost control, and stakeholder alignment
                                throughout the industrial project lifecycle. 
                            <b>Representative of Integrated Project Leadership and Industrial Coordination.</b>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="teamRow">
                <div class="row">
                    <div class="col-md-3">
                          <div class="profileImg">
                             <img src="{{asset(assetLink().'/images/user.jpg')}}" alt="featured">
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="teamRightPart">
                            <h2>
                               <span style="color: #e80849;"> Architect </span> <span style="color: #0da5c7;font-size: 25px;">Dewan Shamshul Arif</span>  – Vista Architectural Consultant
                            </h2>
                            <h6>"Designing Spaces, Building Futures."</h6>
                            <p>
                                A visionary architect and BUET graduate, Architect Dewan Shamshul Arif leads Vista with a
                                passion for sustainable, world-class industrial design. His leadership in projects like the LEED
                                Platinum-certified ICL Green Factory and international collaborations with Moshe Safdie (Asian
                                University for Women) showcases his commitment to excellence, innovation, and compliance.
                            <b> Representative of Industrial Architecture and Sustainable Design Excellence. Read more…</b>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="teamRow">
                <div class="row">
                    <div class="col-md-3">
                          <div class="profileImg">
                             <img src="{{asset(assetLink().'/images/user.jpg')}}" alt="featured">
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="teamRightPart">
                            <h2>
                                 <span style="color: #e80849;"> Engineer </span> <span style="color: #0da5c7;font-size: 25px;"> Md. Kazi Iqbal Mahmud</span> – Imarat Design & Consultancy Ltd.
                            </h2>
                            <h6>"Structures that Stand. Trust that Lasts."</h6>
                            <p>
                                Engineer Md. Kazi Iqbal Mahmud, CEO of Imarat, is a structural safety expert with deep
                                experience in factory auditing, fire safety, and retrofitting under Nirapon and Elevate standards. His
                                meticulous leadership has ensured the safety and sustainability of over 100 industrial facilities
                                across Bangladesh. 
                            <b> Representative of Structural Integrity and Compliance Expertise. Read
                                more…</b>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="teamRow">
                <div class="row">
                    <div class="col-md-3">
                          <div class="profileImg">
                             <img src="{{asset(assetLink().'/images/user.jpg')}}" alt="featured">
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="teamRightPart">
                            <h2>
                               <span style="color: #e80849;"> Engineer </span> <span style="color: #0da5c7;font-size: 25px;"> Sohel Ahammed</span> – Bangladesh Erection Company (BEC)
                            </h2>
                            <h6>"Where Engineering Meets Execution."</h6>
                            <p>
                                Engineer Sohel Ahammed, a Mechanical Engineer from BUET, leads BEC with hands-on expertise
                                in machine erection, piping works, and factory mechanical installations. His team's workmanship
                                ensures industrial plants move from drawing board to operational reality with excellence.
                                <b>Representative of Industrial Installation and Commissioning Precision. Read more…</b>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="teamRow">
                <div class="row">
                    <div class="col-md-3">
                          <div class="profileImg">
                             <img src="{{asset(assetLink().'/images/user.jpg')}}" alt="featured">
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="teamRightPart">
                            <h2>
                                <span style="color: #e80849;"> Engineer </span> <span style="color: #0da5c7;font-size: 25px;">Md. Tajrul Islam</span> – VISCO Logistics Bangladesh Ltd.
                            </h2>
                            <h6>"Connecting Projects. Delivering Success."</h6>
                            <p>
                               Chairman of VISCO Logistics and a Certified Member of the Chartered Institute of Logistics and
                                Transport (CMILT), Engineer Md. Tajrul Islam brings precision to complex industrial logistics.
                                From megaprojects like the Dhaka Elevated Expressway to critical energy sector transports, he
                                ensures timely, safe, and efficient project delivery.
                                <b>Representative of Industrial Project Logistics and Heavy Cargo Handling. Read more…</b>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="teamRow">
                <div class="row">
                    <div class="col-md-3">
                          <div class="profileImg">
                             <img src="{{asset(assetLink().'/images/user.jpg')}}" alt="featured">
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="teamRightPart">
                            <h2>
                                <span style="color: #0da5c7;font-size: 25px;">Md. Alauddin Khan</span>, FCA – Financial Advisor & Compliance Partner
                            </h2>
                            <h6>"Accountability builds credibility."</h6>
                            <p>
                                Md. Alauddin Khan is a Fellow Chartered Accountant (FCA) with over 15 years of experience
                                leading finance functions in Bangladesh’s manufacturing and industrial sectors. Currently serving as
                                Financial Controller and Head of Procurement (Interim) at Apex Footwear Ltd, he has also held
                                senior roles at National Polymer, Dong Bang Group, and Square Textiles. His expertise in
                                feasibility studies, factory cost control, VAT/tax compliance, and investor reporting makes him a
                                critical financial advisor in industrial development.
                                <b> Representative of Financial Structuring and Compliance Expertise.</b>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="teamRow">
                <div class="row">
                    <div class="col-md-3">
                          <div class="profileImg">
                             <img src="{{asset(assetLink().'/images/user.jpg')}}" alt="featured">
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="teamRightPart">
                            <h2>
                               <span style="color: #e80849;">  Engr. </span> <span style="color: #0da5c7;font-size: 25px;">Gulzar Mahmud</span>  – CEO, Powercon Engineering & Automation Ltd
                            </h2>
                            <h6>"Empowering industries through precision and innovation."</h6>
                            <p>
                                Engineer Gulzar Mahmud leads Powercon Engineering & Automation Ltd., a prominent electrical
                                and power engineering firm in Bangladesh. With deep experience in generator systems, electrical
                                automation, and custom energy solutions, his firm serves industries with products such as diesel
                                gensets, synchronization panels, and power distribution units. Under his leadership, Powercon has
                                become a trusted name for factory energy infrastructure. He ensures every solution is engineered to
                                meet exact load, safety, and operational reliability standards.
                                <b> Representative of Power Systems and Electrical Infrastructure Solutions.</b>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    
    
    
    
    
    
    
    
    
</div>



@endsection @push('js') @endpush