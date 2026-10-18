@extends(welcomeTheme().'layouts.app') 
@section('title')
<title>{{websiteTitle('Register')}}</title>
@endsection 
@section('SEO')
<meta name="description" content="{!!general()->meta_description!!}" />
<meta name="keywords" content="{{general()->meta_keyword}}" />
<meta property="og:title" content="{{websiteTitle('Register')}}" />
<meta property="og:description" content="{!!general()->meta_description!!}" />
<meta property="og:image" content="{!!general()->meta_description!!}" />
<meta property="og:url" content="{{route('register')}}" />
<link rel="canonical" href="{{route('register')}}">
@endsection 
@push('css')
<style>
    .lostpassheader{
        text-align:center;   
    }
    .login-part {
        border: 1px solid #d5d5d5;
        padding: 25px;
        border-radius: 10px;
    }
</style>
@endpush 

@section('contents')
<br>
<div class="lostregis">
	<div class="lostpassheader">
		<h3>My Account</h3>
		<p>Sign-Up</p>
	</div>
	<div class="container">
	    <div class="row">
	        <div class="col-md-3"></div>
	        <div class="col-md-6">
	            <div class="login-part">
            		<h4>REGISTER</h4>
            		@include(welcomeTheme().'alerts')
            		<form action="{{route('register')}}" method="post">
            		    @csrf
            			<label for="name">Username *</label>
            			<div class="form-group form-group-section">
            			    <input type="name" name="name" value="{{old('name')}}" class="form-control control-section" placeholder="Your Name" required="">
            			    @if($errors->has('name'))
                                <span style="color:red;display: block;">{{ $errors->first('name') }}</span>
                            @endif
            			</div>
            
            			<label for="email">Email address *</label>
            			<div class="form-group form-group-section">
            			    <input type="email" name="email" value="{{old('email')}}" class="form-control control-section" placeholder="Email Address" required="">
            			    @if($errors->has('email'))
                                <span style="color:red;display: block;">{{ $errors->first('email') }}</span>
                            @endif
            			</div>
            
            			<label for="password">Password *</label>
            			<div class="form-group form-group-section">
            				<div class="input-group">
								<input type="password" class="form-control control-section password" id="password" name="password" placeholder="Enter Password" required="" />
								<div class="input-group-append">
									<span class="input-group-text showPassword" style="cursor: pointer;"><i class="fa fa-eye-slash"></i></span>
								</div>
							</div>
            			    @if($errors->has('password'))
                                <span style="color:red;display: block;">{{ $errors->first('password') }}</span>
                            @endif
            			</div>
            
            			<p>
            				Your personal data will be used to support your experience throughout this website, to manage access to your account, and for other purposes described in our
            			</p>
            			<a href="#">Privacy Policy</a>
            			<div>
            				<button type="submit" class="btn submitbutton">REGISTER</button>
            			</div>
            		</form>
            		
                    <div class="row">
                        <div class="col-md-12">
                            <a href="{{route('login')}}">Alrady Have An Account? <span>Log-In</span></a>
                        </div>
                    </div>
            		
        		</div>
	        </div>
	        <div class="col-md-3"></div>
	    </div>

	</div>
</div>
<br>
@endsection 
@push('js') 
@endpush
