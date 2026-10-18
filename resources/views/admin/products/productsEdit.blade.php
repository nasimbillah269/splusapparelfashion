@extends(adminTheme().'layouts.app') @section('title')
<title>{{websiteTitle('Product Edit')}}</title>
@endsection @push('css')

<style type="text/css">
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
        <h3 class="content-header-title mb-0">Product Edit</h3>
        <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard </a></li>
                    <li class="breadcrumb-item active">Product Edit</li>
                </ol>
            </div>
        </div>
    </div>
    <div class="content-header-right col-md-6 col-12 mb-md-0 mb-2">
        <div class="btn-group float-md-right" role="group" aria-label="Button group with nested dropdown">
            <a class="btn btn-outline-primary" href="{{route('admin.products')}}">BACK</a>
            @isset(json_decode(Auth::user()->permission->permission, true)['services']['add'])
			       	<a class="btn btn-outline-primary" href="{{route('admin.productsAction','create')}}">Add Product</a>
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
        <form action="{{route('admin.productsAction',['update',$product->id])}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header" style="border-bottom: 1px solid #e3ebf3;">
                            <h4 class="card-title">Product Edit</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Product Name </label>
                                    <input type="text" class="form-control {{$errors->has('name')?'error':''}}" name="name" placeholder="e.g. Slim Fit Denim Jeans" value="{{$product->name?:old('name')}}" required="" />
                                    @if ($errors->has('name'))
                                    <p style="color: red; margin: 0; font-size: 10px;">{{ $errors->first('name') }}</p>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="short_description">Short Description </label>
                                    <textarea name="short_description" rows="4" class="form-control {{$errors->has('short_description')?'error':''}}" placeholder="One or two sentences about the product">{{ old('short_description', $product->short_description) }}</textarea>
                                    @if ($errors->has('short_description'))
                                    <p style="color: red; margin: 0; font-size: 10px;">{{ $errors->first('short_description') }}</p>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="description">Product Details <small class="text-muted">(fabric, sizes, colours, MOQ etc.)</small></label>
                                    <textarea name="description" class="{{$errors->has('description')?'error':''}} tinyEditor" placeholder="Enter Product Details">{!! old('description', $product->description) !!}</textarea>
                                    @if ($errors->has('description'))
                                    <p style="color: red; margin: 0; font-size: 10px;">{{ $errors->first('description') }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header" style="border-bottom: 1px solid #e3ebf3;">
                            <h4 class="card-title">Product Image</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="image">Product Image</label>
                                    <input type="file" name="image" class="form-control {{$errors->has('image')?'error':''}}" />
                                    @if ($errors->has('image'))
                                    <p style="color: red; margin: 0; font-size: 10px;">{{ $errors->first('image') }}</p>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <img src="{{asset($product->image())}}" style="max-width: 100px;" />
                                    @isset(json_decode(Auth::user()->permission->permission, true)['services']['add'])
                                    @if($product->imageFile)
                                    <a href="{{route('admin.mediesDelete',$product->imageFile->id)}}" class="mediaDelete" style="color: red;"><i class="fa fa-trash"></i></a>
                                    @endif
                                    @endisset
                                </div>
                                <div class="form-group">
                                    <label for="gallery_image">Product Gallery <small class="text-muted">(more photos, shown as thumbnails)</small></label>
                                    <input type="file" name="gallery_image[]" class="form-control {{$errors->has('gallery_image')?'error':''}}" multiple="" />
                                    @if ($errors->has('gallery_image'))
                                    <p style="color: red; margin: 0; font-size: 10px;">{{ $errors->first('gallery_image') }}</p>
                                    @endif
                                </div>
                                <div class="row">
                                    @foreach($product->galleryFiles as $galley)
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
                            <h4 class="card-title">Product Category</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <p class="text-muted" style="font-size: 12px;">The product is listed under the selected category in the website "Products" menu.</p>
                                @if ($errors->has('categoryid*'))
                                <p style="color: red; margin: 0; font-size: 10px;">The Category Must Be a Number</p>
                                @endif
                                <div class="catagorydiv">
                                    <ul>
                                        @foreach($categories as $ctg)
                                        <li>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" value="{{$ctg->id}}" id="category_{{$ctg->id}}" name="categoryid[]" @foreach($product->productCtgs as $postctg)
                                                {{$postctg->reff_id==$ctg->id?'checked':''}} @endforeach/>
                                                <label class="custom-control-label" for="category_{{$ctg->id}}">{{$ctg->name}}</label>
                                            </div>
                                            @if($ctg->subCtgs->count() >0) @include('admin.products.includes.productsEditSubctg',['subcategories' => $ctg->subCtgs,'i'=>1]) @endif
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                                @if($categories->isEmpty())
                                <p style="font-size: 12px;">No categories yet. <a href="{{route('admin.productsCategories')}}">Add categories</a></p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header" style="border-bottom: 1px solid #e3ebf3;">
                            <h4 class="card-title">Product Action</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="status">Product Status</label>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="status" name="status" {{$product->status=='active'?'checked':''}}/>
                                            <label class="custom-control-label" for="status">Active</label>
                                        </div>
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="fetured">Featured</label>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="fetured" name="fetured" {{$product->fetured?'checked':''}}/>
                                            <label class="custom-control-label" for="fetured">Show on Home</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Published Date</label>
                                    <input type="date" class="form-control form-control-sm" name="created_at" value="{{$product->created_at->format('Y-m-d')}}">
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

@endsection
