<!--@if($slider =slider('Front Page Slider'))-->

<!--<div id="homeSlider" class="carousel slide" data-ride="carousel">-->
<!--  <div class="carousel-inner">-->
<!--  	@foreach($slider->subSliders as $i=>$slider)-->
<!--    <div class="carousel-item {{$i==0?'active':''}}">-->
<!--	      <img style="width:100%;" src="{{asset($slider->image())}}" alt="{{$slider->name}}" title="{{$slider->name}}" />-->
        <!--<div class="carousel-caption d-none d-md-block">-->
        <!-- @if($slider->name)  -->
        <!--  <h1>{!!$slider->name!!}</h1>-->
        <!--  @endif-->
        <!--  @if($slider->description)-->
        <!--  <p>{!!$slider->description!!}</p>-->
        <!--  @endif-->
        <!--  {{---->
        <!--  @if($slider->seo_title && $slider->seo_description)-->
        <!--  <a href="{{$slider->seo_description}}" class="btn btn-sm btn-success">{!!$slider->seo_title!!}</a>-->
        <!--  @endif--}}-->
        <!--</div>-->
<!--    </div>-->
<!--	@endforeach-->
<!--  </div>-->
<!--  <a class="carousel-control-prev" href="#homeSlider" role="button" data-slide="prev">-->
<!--    <span class="carousel-control-prev-icon" aria-hidden="true"></span>-->
<!--    <span class="sr-only">Previous</span>-->
<!--  </a>-->
<!--  <a class="carousel-control-next" href="#homeSlider" role="button" data-slide="next">-->
<!--    <span class="carousel-control-next-icon" aria-hidden="true"></span>-->
<!--    <span class="sr-only">Next</span>-->
<!--  </a>-->
<!--</div>-->
<!--@endif-->


@if($slider = slider('Front Page Slider'))
<div id="homeSlider" class="carousel slide carousel-fade" data-ride="carousel" data-interval="5000">
  <div class="carousel-inner">
  	@foreach($slider->subSliders as $i => $slider)
    <div class="carousel-item {{$i==0?'active':''}}">
      <img style="width:100%;" src="{{asset($slider->image())}}" alt="{{$slider->name}}" title="{{$slider->name}}" />
    </div>
	@endforeach
  </div>
  <a class="carousel-control-prev" href="#homeSlider" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#homeSlider" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
@endif