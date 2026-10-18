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

<div class="">
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
</div>


<div class="membershipDivMain">
    <div class="container">
        <div class="membershipForm">
            
            @include(welcomeTheme().'alerts')
            
             <form action="{{route('registrationMail')}}" id="registerForm" method="post" enctype="multipart/form-data" >
                 @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="name1" class="form-label">Name <span style="color: red">*</span></label>
                        <input type="text" class="form-control" id="name1" name="name" value="{{old('name')}}" placeholder="Name" required="">
                        @if ($errors->has('name'))
                        <p style="color: red; margin: 0;">{{ $errors->first('name') }}</p>
                        @endif
                    </div>
                    
                    <div class="col-md-6">
                        <label for="fatherName" class="form-label">Father's Name <span style="color: red">*</span></label>
                        <input type="text" class="form-control" id="fatherName" name="father_name" value="{{old('father_name')}}" placeholder="Father's Name" required="">
                        @if ($errors->has('father_name'))
                        <p style="color: red; margin: 0;">{{ $errors->first('father_name') }}</p>
                        @endif
                    </div>
                    
                    <div class="col-md-6">
                        <label for="email1" class="form-label">Email <span style="color: red">*</span></label>
                        <input type="email" class="form-control" id="email1" name="email" value="{{old('email')}}" placeholder="Email" required="">
                        @if ($errors->has('email'))
                        <p style="color: red; margin: 0;">{{ $errors->first('email') }}</p>
                        @endif
                    </div>
                   
                    <div class="col-md-6">
                        <label for="mobile1" class="form-label">Mobile <span style="color: red">*</span></label>
                        <input type="text" class="form-control" id="mobile1" name="mobile" value="{{old('mobile')}}" placeholder="Mobile" required="">
                        @if ($errors->has('mobile'))
                        <p style="color: red; margin: 0;">{{ $errors->first('mobile') }}</p>
                        @endif
                    </div>
                   
                    <div class="col-md-6">
                        <label for="village" class="form-label">Village <span style="color: red">*</span></label>
                        <input type="text" class="form-control" id="village" name="village" value="{{old('village')}}" placeholder="Village" required="">
                        @if ($errors->has('village'))
                        <p style="color: red; margin: 0;">{{ $errors->first('village') }}</p>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <label for="post" class="form-label">Post <span style="color: red">*</span></label>
                        <input type="text" class="form-control" id="post" name="post_area" value="{{old('post_area')}}" placeholder="Post" required="">
                        @if ($errors->has('post_area'))
                        <p style="color: red; margin: 0;">{{ $errors->first('post_area') }}</p>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <label for="policeStation1" class="form-label">Police Station <span style="color: red">*</span></label>
                        <input type="text" class="form-control" id="policeStation1" name="police_status" value="{{old('police_status')}}" placeholder="Police Station" required="">
                        @if($errors->has('police_status'))
                        <p style="color: red; margin: 0;">{{ $errors->first('police_status') }}</p>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <label for="district" class="form-label">District <span style="color: red">*</span></label>
                        <select class="form-select" id="district" name="district" required="">
                            <option value="" >Select District</option>
                            @foreach(geoData(3) as $district)
                            <option value="{{$district->name}}">{{$district->name}}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('district'))
                        <p style="color: red; margin: 0;">{{ $errors->first('district') }}</p>
                        @endif
                    </div>
                  
                    <div class="col-md-6">
                        <label for="pin" class="form-label">Pin <span style="color: red">*</span></label>
                        <input type="number" class="form-control" id="pin" placeholder="Pin" name="pin_code" value="{{old('pin_code')}}" required="">
                        @if ($errors->has('pin_code'))
                        <p style="color: red; margin: 0;">{{ $errors->first('pin_code') }}</p>
                        @endif
                    </div>
                   
                    <div class="col-md-6">
                        <label for="photo" class="form-label">Photo Upload <span style="color: red">*</span></label>
                        <input type="file" class="form-control" id="photo" name="photo"  accept="image/*" style="border: none; background: none;  margin: 0;  padding: 0;" required="">
                        @if ($errors->has('photo'))
                        <p style="color: red; margin: 0;">{{ $errors->first('photo') }}</p>
                        @endif
                    </div>
                    
                    <div class="col-md-6">
                        <label for="NIDFront" class="form-label">Adhar Card Front Page <span style="color: red">*</span></label>
                        <input type="file" class="form-control" id="NIDFront" name="nid_card" accept="image/*" style="border: none; background: none;  margin: 0;  padding: 0;" required="">
                        @if ($errors->has('nid_card'))
                        <p style="color: red; margin: 0;">{{ $errors->first('nid_card') }}</p>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <label for="paymentScreenshot" class="form-label" >Payment Screenshot Upload <span style="color: red">*</span></label>
                        <input type="file" class="form-control" id="paymentScreenshot" name="payment_screenshort" accept="image/*" style="border: none; background: none;  margin: 0;  padding: 0;" required="">
                        @if ($errors->has('payment_screenshort'))
                        <p style="color: red; margin: 0;">{{ $errors->first('payment_screenshort') }}</p>
                        @endif
                    </div>
                </div>
                <div class="mt-4">
                    <!--<button type="submit" class="btn btn-success">Submit</button>-->
                    <button class="g-recaptcha btn btn-success" 
                    data-sitekey="6LdTLTkrAAAAADMlQDwpl77bDA5tYg68ff5iv6Fx" 
                    data-callback='onSubmit' 
                    data-action='submit'>Submit</button>
                    
                </div>
            </form>
        </div>
    </div>
</div>

@endsection 
@push('js') 
 <script src="https://www.google.com/recaptcha/api.js"></script>
 
  <script>
   function onSubmit(token) {
       var recaptchaInput = document.createElement('input');
            recaptchaInput.type = 'hidden';
            recaptchaInput.name = 'recaptchaToken';
            recaptchaInput.value = token;
            document.getElementById("registerForm").appendChild(recaptchaInput);
     document.getElementById("registerForm").submit();
   }
 </script>
 
 

@endpush