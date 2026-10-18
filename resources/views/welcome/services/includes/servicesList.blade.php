<section class="tx-svc-page">
    <div class="container">
        @if($services->count())
        <div class="tx-svc-grid">
            @foreach($services as $service)
                @include(welcomeTheme().'services.includes.serviceGrid')
            @endforeach
        </div>
        {{$services->links(welcomeTheme().'blogs.pagination')}}
        @else
        <p class="tx-empty">No services available right now.</p>
        @endif
    </div>
</section>

<section class="tx-help-wrap">
    <div class="container">
        <div class="tx-help">
            <h3>To make requests for further information, contact us</h3>
            @if(general()->mobile)
            <div class="tx-help-call">
                <i class="fa-solid fa-headset"></i>
                <p>Call Us For Any inquiry</p>
                <a href="tel:{{ preg_replace('/[^0-9+]/', '', general()->mobile) }}">{{general()->mobile}}</a>
            </div>
            @endif
        </div>
    </div>
</section>

@include(welcomeTheme().'layouts.includes.brands')
