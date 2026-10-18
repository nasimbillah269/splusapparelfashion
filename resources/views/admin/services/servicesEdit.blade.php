@extends(adminTheme().'layouts.app') @section('title')
<title>{{websiteTitle('Services Edit')}}</title>
@endsection @push('css')

<style type="text/css">
    .faqRow {
        border: 1px solid #e3ebf3;
        border-radius: 4px;
        padding: 12px 15px;
        margin-bottom: 12px;
    }
    .catagorydiv {
        max-height: 300px;
        overflow: auto;
    }
    .catagorydiv ul {
        padding-left: 20px;
    }
    .catagorydiv ul li {
        list-style: none;
    }
</style>
@endpush @section('contents')

<div class="content-header row">
    <div class="content-header-left col-md-6 col-12 mb-2">
        <h3 class="content-header-title mb-0">Service Edit</h3>
        <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard </a></li>
                    <li class="breadcrumb-item active">Service Edit</li>
                </ol>
            </div>
        </div>
    </div>
    <div class="content-header-right col-md-6 col-12 mb-md-0 mb-2">
        <div class="btn-group float-md-right" role="group" aria-label="Button group with nested dropdown">
            <a class="btn btn-outline-primary" href="{{route('admin.services')}}">BACK</a>
            @isset(json_decode(Auth::user()->permission->permission, true)['services']['add'])
			       	<a class="btn btn-outline-primary" href="{{route('admin.servicesAction','create')}}">Add Services</a>
			      @endisset
            <a class="btn btn-outline-primary reloadPage" href="javascript:void(0)">
                <i class="fa-solid fa-rotate"></i>
            </a>
        </div>
    </div>
</div>

<div class="content-body">
    <!-- Basic Elements start -->
    <section class="basic-elements">
        @include('admin.alerts')
        <form action="{{route('admin.servicesAction',['update',$service->id])}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header" style="border-bottom: 1px solid #e3ebf3;">
                            <h4 class="card-title">Service Edit</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Service Name </label>
                                    <input type="text" class="form-control {{$errors->has('name')?'error':''}}" name="name" placeholder="Enter Post Name" value="{{$service->name?:old('name')}}" required="" />
                                    @if ($errors->has('name'))
                                    <p style="color: red; margin: 0; font-size: 10px;">{{ $errors->first('name') }}</p>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="short_description">Short Description <small class="text-muted">(intro paragraph under the title)</small></label>
                                    <textarea name="short_description" class="form-control {{$errors->has('short_description')?'error':''}}" placeholder="Enter Short Description">{!!$service->short_description!!}</textarea>
                                    @if ($errors->has('short_description'))
                                    <p style="color: red; margin: 0; font-size: 10px;">{{ $errors->first('short_description') }}</p>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="description">Description <small class="text-muted">(content below the main image)</small></label>
                                    <textarea name="description" class="{{$errors->has('description')?'error':''}} summernote" placeholder="Enter Description">{!!$service->description!!}</textarea>
                                    @if ($errors->has('description'))
                                    <p style="color: red; margin: 0; font-size: 10px;">{{ $errors->first('description') }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header" style="border-bottom: 1px solid #e3ebf3;">
                            <h4 class="card-title">Service FAQs</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <p class="text-muted" style="font-size:12px;">Shown as an accordion at the bottom of the service page. The first one opens by default. Remove all to hide the FAQ section.</p>
                                <div id="faqRows">
                                    @foreach(serviceFaqs($service) as $faq)
                                    <div class="faqRow">
                                        <div class="form-group">
                                            <label>Question</label>
                                            <input type="text" name="faq_question[]" class="form-control" value="{{$faq['q']}}" placeholder="e.g. How long does it take to finish a project?" />
                                        </div>
                                        <div class="form-group">
                                            <label>Answer</label>
                                            <textarea name="faq_answer[]" rows="2" class="form-control" placeholder="Answer">{{$faq['a'] ?? ''}}</textarea>
                                        </div>
                                        <a href="javascript:void(0)" class="btn btn-sm btn-outline-danger removeFaq"><i class="fa fa-trash"></i> Remove</a>
                                    </div>
                                    @endforeach
                                </div>
                                @if ($errors->has('faq_question.*') || $errors->has('faq_answer.*'))
                                <p style="color: red; margin: 0; font-size: 10px;">Question max 250 and answer max 2000 characters.</p>
                                @endif
                                <a href="javascript:void(0)" class="btn btn-sm btn-outline-primary mt-1" id="addFaq"><i class="fa fa-plus"></i> Add FAQ</a>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header" style="border-bottom: 1px solid #e3ebf3;">
                            <h4 class="card-title">SEO Optimize</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="seo_title">SEO Meta Title</label>
                                    <input type="text" class="form-control {{$errors->has('seo_title')?'error':''}}" name="seo_title" placeholder="Enter SEO Meta Title" value="{{$service->seo_title?:old('seo_title')}}" />
                                    @if ($errors->has('seo_title'))
                                    <p style="color: red; margin: 0; font-size: 10px;">{{ $errors->first('seo_title') }}</p>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="seo_description">SEO Meta Description </label>
                                    <textarea name="seo_description" class="form-control {{$errors->has('seo_description')?'error':''}}" placeholder="Enter SEO Meta Description">{!!$service->seo_description!!}</textarea>
                                    @if ($errors->has('seo_description'))
                                    <p style="color: red; margin: 0; font-size: 10px;">{{ $errors->first('seo_description') }}</p>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="seo_keyword">SEO Meta Keyword </label>
                                    <textarea name="seo_keyword" class="form-control {{$errors->has('seo_keyword')?'error':''}}" placeholder="Enter SEO Meta Keyword">{!!$service->seo_keyword!!}</textarea>
                                    @if ($errors->has('seo_keyword'))
                                    <p style="color: red; margin: 0; font-size: 10px;">{{ $errors->first('seo_keyword') }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header" style="border-bottom: 1px solid #e3ebf3;">
                            <h4 class="card-title">Service Images</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="image">Service Image <small class="text-muted">(main image on the page)</small></label>
                                    <input type="file" name="image" class="form-control {{$errors->has('image')?'error':''}}" />
                                    @if ($errors->has('image'))
                                    <p style="color: red; margin: 0; font-size: 10px;">{{ $errors->first('image') }}</p>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <img src="{{asset($service->image())}}" style="max-width: 100px;" />
                                    @isset(json_decode(Auth::user()->permission->permission, true)['services']['add'])
                                    @if($service->imageFile)
                                    <a href="{{route('admin.mediesDelete',$service->imageFile->id)}}" class="mediaDelete" style="color: red;"><i class="fa fa-trash"></i></a>
                                    @endif
                                    @endisset
                                </div>
                                <div class="form-group">
                                    <label for="banner">Banner Image <small class="text-muted">(page header background, e.g. 1920×500)</small></label>
                                    <input type="file" name="banner" class="form-control {{$errors->has('banner')?'error':''}}" />
                                    @if ($errors->has('banner'))
                                    <p style="color: red; margin: 0; font-size: 10px;">{{ $errors->first('banner') }}</p>
                                    @endif
                                </div>
                                @if($service->bannerFile)
                                <div class="form-group">
                                    <img src="{{asset($service->banner())}}" style="max-width: 160px;" />
                                    @isset(json_decode(Auth::user()->permission->permission, true)['services']['add'])
                                    <a href="{{route('admin.mediesDelete',$service->bannerFile->id)}}" class="mediaDelete" style="color: red;"><i class="fa fa-trash"></i></a>
                                    @endisset
                                </div>
                                @endif
                                <div class="form-group">
                                    <label for="gallery_image">Service Gallery <small class="text-muted">(shown under the description)</small></label>
                                    <input type="file" name="gallery_image[]" class="form-control {{$errors->has('gallery_image')?'error':''}}"  multiple="" />
                                    @if ($errors->has('gallery_image'))
                                    <p style="color: red; margin: 0; font-size: 10px;">{{ $errors->first('gallery_image') }}</p>
                                    @endif
                                </div>
                                <div class="row">
                                    @foreach($service->galleryFiles as $galley)
                                    <div class="col-md-4 form-group">
                                    <img src="{{asset($galley->file_url)}}" style="max-width: 60px;max-height: 60px" />

                                    @isset(json_decode(Auth::user()->permission->permission, true)['services']['add'])
                                    <a href="{{route('admin.mediesDelete',$galley->id)}}" class="mediaDelete" style="color: red;"><i class="fa fa-trash"></i></a>
                                    @endisset
                                    </div>
                                    @endforeach
                                    
                                </div>
                                
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header" style="border-bottom: 1px solid #e3ebf3;">
                            <h4 class="card-title">Service Category</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                @if ($errors->has('categoryid*'))
                                <p style="color: red; margin: 0; font-size: 10px;">The Category Must Be a Number</p>
                                @endif
                                <div class="catagorydiv">
                                    <ul>
                                        @foreach($categories as $ctg)
                                        <li>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" value="{{$ctg->id}}" id="category_{{$ctg->id}}" name="categoryid[]" @foreach($service->serviceCtgs as $postctg)
                                                {{$postctg->reff_id==$ctg->id?'checked':''}} @endforeach/>
                                                <label class="custom-control-label" for="category_{{$ctg->id}}">{{$ctg->name}}</label>
                                            </div>
                                            @if($ctg->subCtgs->count() >0) @include('admin.services.includes.servicesEditSubctg',['subcategories' => $ctg->subCtgs,'i'=>1]) @endif
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="card">
                        <div class="card-header" style="border-bottom: 1px solid #e3ebf3;">
                            <h4 class="card-title">Service Action</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="status">Service Status</label>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="status" name="status" {{$service->status=='active'?'checked':''}}/>
                                            <label class="custom-control-label" for="status">Active</label>
                                        </div>
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="fetured">Service Fetured</label>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="fetured" name="fetured" {{$service->fetured?'checked':''}}/>
                                            <label class="custom-control-label" for="fetured">Active</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Published Date</label>
                                    <input type="date" class="form-control form-control-sm" name="created_at" value="{{$service->created_at->format('Y-m-d')}}">
                                    @if ($errors->has('created_at'))
                                    <p style="color: red; margin: 0; font-size: 10px;">{{ $errors->first('created_at') }}</p>
                                    @endif
                                </div>
                                @isset(json_decode(Auth::user()->permission->permission, true)['services']['add'])
                                <button type="submit" class="btn btn-primary mr-sm-1 mb-1 mb-sm-0">Save changes</button>
                                @endisset
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
    <!-- Basic Inputs end -->
</div>

@endsection @push('js')

<script>
    $(".summernote").summernote({
        placeholder: "Hello stand alone ui",
        tabsize: 2,
        height: 120,
        toolbar: [
            ["style", ["style"]],
            ["font", ["bold", "underline"]],
            ["color", ["color"]],
            ["para", ["ul", "ol", "paragraph"]],
            ["table", ["table"]],
            ["insert", ["link", "picture"]],
            ["view", ["fullscreen", "codeview"]],
        ],
    });

    $('#addFaq').on('click', function () {
        $('#faqRows').append(
            '<div class="faqRow">' +
            '<div class="form-group"><label>Question</label><input type="text" name="faq_question[]" class="form-control" placeholder="Question" /></div>' +
            '<div class="form-group"><label>Answer</label><textarea name="faq_answer[]" rows="2" class="form-control" placeholder="Answer"></textarea></div>' +
            '<a href="javascript:void(0)" class="btn btn-sm btn-outline-danger removeFaq"><i class="fa fa-trash"></i> Remove</a>' +
            '</div>'
        );
    });
    $(document).on('click', '.removeFaq', function () {
        $(this).closest('.faqRow').remove();
    });
</script>

@endpush
