@extends(adminTheme().'layouts.app') @section('title')
<title>{{websiteTitle('Testimonial Edit')}}</title>
@endsection @push('css')
<style type="text/css"></style>
@endpush @section('contents')

<div class="content-header row">
    <div class="content-header-left col-md-6 col-12 mb-2">
        <h3 class="content-header-title mb-0">Testimonial Edit</h3>
        <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard </a></li>
                    <li class="breadcrumb-item active">Testimonial Edit</li>
                </ol>
            </div>
        </div>
    </div>
    <div class="content-header-right col-md-6 col-12 mb-md-0 mb-2">
        <div class="btn-group float-md-right" role="group" aria-label="Button group with nested dropdown">
            <a class="btn btn-outline-primary" href="{{route('admin.clients')}}">BACK</a>
            @isset(json_decode(Auth::user()->permission->permission, true)['clients']['add'])
            <a class="btn btn-outline-primary" href="{{route('admin.clientsAction',['create'])}}">Add Testimonial</a>
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
        @include(adminTheme().'alerts')
        <form action="{{route('admin.clientsAction',['update',$client->id])}}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="actionType" value="updateClient">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header" style="border-bottom: 1px solid #e3ebf3;">
                            <h4 class="card-title">Testimonial Edit</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Client Name(*) </label>
                                    <input type="text" class="form-control {{$errors->has('name')?'error':''}}" name="name" placeholder="e.g. James Smith" value="{{ old('name', $client->name) }}" required="" />
                                    @if ($errors->has('name'))
                                    <p style="color: red; margin: 0; font-size: 10px;">{{ $errors->first('name') }}</p>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="designation">Designation / Company </label>
                                    <input type="text" class="form-control {{$errors->has('designation')?'error':''}}" name="designation" placeholder="e.g. CFO Apple Corp" value="{{ old('designation', $client->short_description) }}" />
                                    @if ($errors->has('designation'))
                                    <p style="color: red; margin: 0; font-size: 10px;">{{ $errors->first('designation') }}</p>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="review">Review(*) </label>
                                    <textarea name="review" rows="5" class="form-control {{$errors->has('review')?'error':''}}" placeholder="What the client said about your work" required="">{{ old('review', trim(strip_tags((string) $client->description))) }}</textarea>
                                    @if ($errors->has('review'))
                                    <p style="color: red; margin: 0; font-size: 10px;">{{ $errors->first('review') }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header" style="border-bottom: 1px solid #e3ebf3;">
                            <h4 class="card-title">Client Photo</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="image">Photo <small class="text-muted">(square, e.g. 400×400)</small></label>
                                    <input type="file" name="image" class="form-control {{$errors->has('image')?'error':''}}" />
                                    @if ($errors->has('image'))
                                    <p style="color: red; margin: 0; font-size: 10px;">{{ $errors->first('image') }}</p>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <img src="{{asset($client->image())}}" style="max-width: 100px;" />
                                    @isset(json_decode(Auth::user()->permission->permission, true)['clients']['add'])
                                    @if($client->imageFile)
                                    <a href="{{route('admin.mediesDelete',$client->imageFile->id)}}" class="mediaDelete" style="color: red;"><i class="fa fa-trash"></i></a>
                                    @endif
                                    @endisset
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header" style="border-bottom: 1px solid #e3ebf3;">
                            <h4 class="card-title">Testimonial Action</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="status">Status</label>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="status" name="status" {{$client->status=='active'?'checked':''}}/>
                                            <label class="custom-control-label" for="status">Active</label>
                                        </div>
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="fetured">Featured</label>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="fetured" name="fetured" {{$client->fetured?'checked':''}}/>
                                            <label class="custom-control-label" for="fetured">Show first</label>
                                        </div>
                                    </div>
                                </div>
                                @isset(json_decode(Auth::user()->permission->permission, true)['clients']['add'])
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

@endsection
