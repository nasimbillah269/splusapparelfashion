<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta name="google-site-verification" content="3LFP8tpCZD3MHU0SVKY0o8VhnA3jYcK-TJWR9jYCnGs" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta http-equiv="x-ua-compatible" content="ie=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{csrf_token()}}" />
        @yield('title')
        <!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="{{asset(general()->favicon())}}" />
        @yield('SEO')
        <!-- Google Font CDN-->
        <link href="https://fonts.googleapis.com/css?family=Source Code Pro" rel="stylesheet" />
        
        
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        
        <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Aguafina+Script&family=Alfa+Slab+One&family=Bebas+Neue&family=Big+Shoulders:opsz,wght@10..72,100..900&family=Oswald:wght@200..700&family=Philosopher:ital,wght@0,400;0,700;1,400;1,700&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Poiret+One&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Saira:ital,wght@0,100..900;1,100..900&family=Unbounded:wght@200..900&display=swap" rel="stylesheet">
      
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        
        
        <link rel="stylesheet" type="text/css" href="{{asset(assetLink().'/css/demo.css')}}" />
        
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet" />
        
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:200,300,400,600,700" />

        <!-- Bootstrap CS CDN -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        
        <!--animate css cnd link-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    
        <!-- Font Awesome CSS CDN-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
        
        <!-- Slick Slider CSS CDN-->
        <link rel="stylesheet" type="text/css" href="{{asset(assetLink().'/css/slick.css')}}" />
        <link rel="stylesheet" type="text/css" href="{{asset(assetLink().'/css/slick-theme.css')}}" />
        
        <link rel="stylesheet" type="text/css" href="{{asset(assetLink().'/css/fancybox.css')}}" />

        <!-- Matis Menus CSS -->
        <link rel="stylesheet" href="{{asset(assetLink().'/css/metisMenu.css')}}" />
        
        <link rel="stylesheet" type="text/css" href="{{asset(assetLink().'/css/style.css')}}" />
        <link rel="stylesheet" type="text/css" href="{{asset(assetLink().'/css/style-v1.css')}}" />
        
       
        <link
          rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css"
        />
                
        @stack('css')
    </head>
    
    <body>
        
        <!-- Scroll to Top Button -->
        <button id="scrollTopBtn"><i class="fas fa-arrow-up"></i></button>
        
        <div class="languagePart mobileLang">
                        <div class="gtranslate_wrapper"></div>
                        
                        
                       
                    </div>

        
        <div id="myOverlay" class="overlay">
            <span class="closebtn" onclick="closeSearch()" title="Close Overlay">×</span>
            <div class="overlay-content">
                <form action="{{route('blogSearch')}}">
                    <input type="text" name="search" value="{{request()->search}}" placeholder="Search" title="Search for." />
                    <button type="submit"><i class="fa fa-search"></i></button>
                </form>
            </div>
        </div>
       
      
        
        <body class="theme-default">
            <div id="container">
                <header>
                    <div class="wrapper cf">
                        @if(menu('Header Menus'))
                        <nav id="main-nav">
                            <ul class="first-nav">
                                @php
                                    $mProductCtgs = \App\Models\Attribute::where('type',10)->where('status','active')->whereNull('parent_id')->orderBy('name')->get(['id','name','slug']);
                                    $mHasProductMenu = menu('Header Menus')->subMenus->contains(fn($m) => trim($m->menuLink(),'/') == 'products');
                                @endphp
                                @foreach(menu('Header Menus')->subMenus as $mi => $menu)
                                @if($mi == 1 && !$mHasProductMenu)
                                <li class="devices">
                                    @if($mProductCtgs->count())
                                    <span>Products</span>
                                    <ul>
                                        <li class="mobile"><a href="{{route('products')}}">All Products</a></li>
                                        @foreach($mProductCtgs as $ctg)
                                        <li class="mobile"><a href="{{route('productCategory',$ctg->slug?:'no-title')}}">{{$ctg->name}}</a></li>
                                        @endforeach
                                    </ul>
                                    @else
                                    <a href="{{route('products')}}">Products</a>
                                    @endif
                                </li>
                                @endif
                                <li class="devices">
                                    
                                    @if($menu->subMenus->count() > 0)
                                    <span>{{$menu->menuName()}}</span>
                                    <ul>
                                        @foreach($menu->subMenus as $menu)
                                        <li class="mobile">
                                            <a href="{{asset($menu->menuLink())}}">{{$menu->menuName()}}</a>
                                            
                                            @if($menu->subMenus->count() > 0)
                                            <ul>
                                                @foreach($menu->subMenus as $menu)
                                                <li><a href="{{asset($menu->menuLink())}}">{{$menu->menuName()}}</a></li>
                                                @endforeach
                                            </ul>
                                            @endif
                                            
                                        </li>
                                        @endforeach
                                    </ul>
                                    @else
                                    <a href="{{asset($menu->menuLink())}}">{{$menu->menuName()}}</a>
                                    @endif
                                    
                                </li>
                                @endforeach
                            </ul>
                        </nav>
                        @endif
                        <a class="toggle" href="#">
                            <span></span>
                        </a>
                    </div>
                </header>
            </div>
        </body>
        
        <!--Header Part Include Start-->
        @include(welcomeTheme().'layouts.header')

        <!--Main Content Section Start-->
        <div class="main-content">
        @yield('contents')
        </div>
        <!--Main Content Section End-->
        
        <!--Footer Part Include Start-->
        @include(welcomeTheme().'layouts.footer')
        
        

         <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="{{asset(assetLink().'/js/hc-offcanvas-nav.js')}}"></script>
        
        <!-- Bootstrap Script  CDN-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>-->
         <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <!--iconify Script CDN-->
        <script src="https://code.iconify.design/1/1.0.7/iconify.min.js"></script>
        <!-- Sweet Alert CDN -->
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>

        <!-- Metis Menus Script -->
        <script src="{{asset(assetLink().'/js/metisMenu.min.js')}}"></script>

        <!-- Slick slider CDN -->
        <!--<script type="text/javascript" src="{{asset(assetLink().'/js/slick.min.js')}}"></script>-->
           <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
        
         <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
         
         
         
         
        <!--<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>-->
        
        
        

<script>
    window.gtranslateSettings = {
        default_language: "en",
        native_language_names: true,
        detect_browser_language: true,
        languages: ["bn", "ar", "en"],
        wrapper_selector: ".gtranslate_wrapper"
    };

    window.onload = function () {
        if (window.__gtranslateInitialized) return;
        window.__gtranslateInitialized = true;

        var userLanguage = navigator.language || navigator.userLanguage;
        userLanguage = userLanguage.split("-")[0];

        if (userLanguage === "bn") {
            var gtranslateElement = document.querySelector(".gtranslate_wrapper select");
            if (gtranslateElement) {
                gtranslateElement.value = "bn";
                gtranslateElement.dispatchEvent(new Event("change"));
            }
            console.log("yes");
        }else{
            console.log("no"+userLanguage);
        }
    };
</script>
<script src="https://cdn.gtranslate.net/widgets/latest/dropdown.js" defer></script>


<script>
$(document).ready(function () {
  let hasCounted = false;

  const observer = new IntersectionObserver((entries, observer) => {
    entries.forEach(entry => {
      if (entry.isIntersecting && !hasCounted) {
        hasCounted = true;

        $('.counter').each(function () {
          const $this = $(this);
          const countTo = parseInt($this.attr('data-target'));
          const suffix = $this.attr('data-suffix') || '';

          $({ countNum: 0 }).animate({ countNum: countTo }, {
            duration: 2000,
            easing: 'swing',
            step: function () {
              $this.text(Math.floor(this.countNum) + suffix);
            },
            complete: function () {
              $this.text(countTo + suffix);
            }
          });
        });

        observer.unobserve(entry.target);
      }
    });
  }, {
    threshold: 0.3
  });

  const section = document.querySelector('.homeCounterPart');
  if (section) observer.observe(section);
});
</script>



<script>
  $(document).ready(function () {
    $('.faq-question').click(function () {
      var answer = $(this).next('.faq-answer');
      var icon = $(this).find('.icon');

      // Close other open answers
      $('.faq-answer').not(answer).slideUp();
      $('.faq-question .icon').not(icon).text('+');

      // Toggle current
      answer.slideToggle();
      icon.text(icon.text() === '+' ? '−' : '+');
    });
  });
</script>









  <script type="text/javascript">
        $('.travel-slider').slick({
          autoplay:true,
          autoplaySpeed:2000,
          dots: false,
          infinite: true,
          speed: 3000,
          slidesToShow: 4,
          slidesToScroll: 1,
          responsive: [
            {
              breakpoint: 1024,
              settings: {
                slidesToShow: 3,
                slidesToScroll: 1,
                infinite: true,
                dots: true,
              }
            },
            {
              breakpoint: 600,
              settings: {
                slidesToShow: 2,
                slidesToScroll: 1
              }
            },
            {
              breakpoint: 480,
              settings: {
                slidesToShow: 1,
                slidesToScroll: 1
              }
            }
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
          ]
        });
        
     
   </script>


        

        <script>
              Fancybox.bind('[data-fancybox="gallery"]', {
              }); 
        </script>
        
        <script>
            $('.accordion-header').click(function() {
                const icon = $(this).find('i');
                $('.accordion-header').not(this).removeClass('active').find('i').attr('class', 'fas fa-plus');
                $('.accordion-content').not($(this).next()).slideUp();
        
                $(this).toggleClass('active');
                $(this).next('.accordion-content').slideToggle();
                icon.toggleClass('fa-plus fa-minus');
            });
        </script>
        
        <script>
            $(document).ready(function () {
                $(window).scroll(function () {
                    if ($(this).scrollTop() > 200) {
                        $('#scrollTopBtn').fadeIn();
                    } else {
                        $('#scrollTopBtn').fadeOut();
                    }
                });
        
                $('#scrollTopBtn').click(function () {
                    $('html, body').animate({scrollTop: 0}, 600);
                    return false;
                });
            });
        </script>
        
        <script>
            $(document).ready(function () {
                $(window).scroll(function () {
                    if ($(this).scrollTop() > 50) {
                        $('.main-header').addClass('sticky-active');
                    } else {
                        $('.main-header').removeClass('sticky-active');
                    }
                });
            });
        </script>

        <script>
            (function ($) {
                "use strict";

                // call our plugin
                var Nav = new hcOffcanvasNav("#main-nav", {
                    disableAt: false,
                    customToggle: ".toggle",
                    levelSpacing: 40,
                    navTitle: "Main Menu",
                    levelTitles: true,
                    levelTitleAsBack: true,
                    pushContent: false,
                    labelClose: false,
                });

                // add new items to original nav
                $("#main-nav")
                    .find("li.add")
                    .children("a")
                    .on("click", function () {
                        var $this = $(this);
                        var $li = $this.parent();
                        var items = eval("(" + $this.attr("data-add") + ")");

                        $li.before('<li class="new"><a href="#">' + items[0] + "</a></li>");

                        items.shift();

                        if (!items.length) {
                            $li.remove();
                        } else {
                            $this.attr("data-add", JSON.stringify(items));
                        }

                        Nav.update(true); // update DOM
                    });

                // demo settings update

                const update = function (settings) {
                    if (Nav.isOpen()) {
                        Nav.on("close.once", function () {
                            Nav.update(settings);
                            Nav.open();
                        });

                        Nav.close();
                    } else {
                        Nav.update(settings);
                    }
                };

                $(".actions")
                    .find("a")
                    .on("click", function (e) {
                        e.preventDefault();

                        var $this = $(this).addClass("active");
                        var $siblings = $this.parent().siblings().children("a").removeClass("active");
                        var settings = eval("(" + $this.data("demo") + ")");

                        if ("theme" in settings) {
                            $("body")
                                .removeClass()
                                .addClass("theme-" + settings["theme"]);
                        } else {
                            update(settings);
                        }
                    });

                $(".actions")
                    .find("input")
                    .on("change", function () {
                        var $this = $(this);
                        var settings = eval("(" + $this.data("demo") + ")");

                        if ($this.is(":checked")) {
                            update(settings);
                        } else {
                            var removeData = {};
                            $.each(settings, function (index, value) {
                                removeData[index] = false;
                            });

                            update(removeData);
                        }
                    });
            })(jQuery);
        </script>

        <script>
            $(document).ready(function(){

           
            $("#division").on("change", function(){
                var id = $(this).val();
                  if(id==''){
                   $('#district').empty().append('<option value="">No District</option>');
                   $('#city').empty().append('<option value="">No City</option>');
                  }
                  var url ='{{url('geo/filter')}}' + '/'+id;
                  $.get(url,function(data){
                    $('#district').empty().append(data.geoData);
                    $('#city').empty().append('<option value="">No City</option>');
                  });   
            });

            $("#district").on("change", function(){
                var id = $(this).val();
                  if(id==''){
                   $('#city').empty().append('<option value="">No City</option>');
                  }
                  var url ='{{url('geo/filter')}}' + '/'+id;
                  $.get(url,function(data){
                    $('#city').empty().append(data.geoData);  
                  });   
            });
            
        });
        </script>
        
        <script>
            $(document).on('click','.subsriberbtm',function(e){
              e.preventDefault();
               var url = $('#subscirbeForm').data('url');
               var subscribeEmail =$('#subscribeEmail').val();
                    $.ajax({
                      url: url,
                      type: 'POST',
                      dataType: 'json',
                       data: {email : subscribeEmail},
                      cache: false,
        
                    })
                    .done(function(data) {
                        if(data.success)
                          {
                            $("#subscribeemailMsg").html("<p style='color: #f6f6f6;background: #009688;margin: 5px 0;padding: 4px 5px;border-radius: 4px;font-weight: bold;line-height: 14px;font-size: 12px;'>"+ data.message +"</p>");
                            $("#subscribeEmail").css("border","");
                            $("#subscirbeForm")[0].reset();
                          }else{
                            $("#subscribeemailMsg").html("<p style='color: #f6f6f6;background: #ff9800;margin: 5px 0;padding: 4px 5px;border-radius: 4px;font-weight: bold;line-height: 14px;font-size: 12px;'>"+ data.message +"</p>");
                          }
                    })
                    .fail(function() {
                      // alert("error");
                    });
        
            });
        
            $("#subscribeEmail").keyup(function(){
                  if(validateEmail()){
                      $("#subscribeEmail").css("border","2px solid #EEEEEE");
                      $("#subscribeemailMsg").html("<p style='color: #f6f6f6;background: #009688;margin: 5px 0;padding: 4px 5px;border-radius: 4px;font-weight: bold;line-height: 14px;font-size: 12px;'>Validated Email</p>");
                  }else{
                        var subscribeEmail=$("#subscribeEmail").val();
                       if(subscribeEmail==''||subscribeEmail==null || subscribeEmail=='undefined'){
                            $("#subscribeemailMsg").html("<p style='color: white;background: red;margin: 5px 0;padding: 4px 5px;border-radius: 4px;font-weight: bold;line-height: 14px;font-size: 12px;'>Please Get a Verified Email</p>");
                        }else{
                          $("#subscribeEmail").css("border","2px solid red");
                          $("#subscribeemailMsg").html("");
                        }
                  }
              });
        
            function validateEmail(){
                  var subscribeEmail=$("#subscribeEmail").val();
        
                   var reg =/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                   if(reg.test(subscribeEmail)){
                      return true;
                   }else{
                      return false;
              }
        
            }
        </script>
        

        
        <script>
            function openSearch() {
              document.getElementById("myOverlay").style.display = "block";
            }
            
            function closeSearch() {
              document.getElementById("myOverlay").style.display = "none";
            }
        </script>
        
        <script>
            (function ($) {
                "use strict";

                // call our plugin
                var Nav = new hcOffcanvasNav("#main-nav", {
                    disableAt: false,
                    customToggle: ".toggle",
                    levelSpacing: 40,
                    navTitle: "Main Menu",
                    levelTitles: true,
                    levelTitleAsBack: true,
                    pushContent: false,
                    labelClose: false,
                });

                // add new items to original nav
                $("#main-nav")
                    .find("li.add")
                    .children("a")
                    .on("click", function () {
                        var $this = $(this);
                        var $li = $this.parent();
                        var items = eval("(" + $this.attr("data-add") + ")");

                        $li.before('<li class="new"><a href="#">' + items[0] + "</a></li>");

                        items.shift();

                        if (!items.length) {
                            $li.remove();
                        } else {
                            $this.attr("data-add", JSON.stringify(items));
                        }

                        Nav.update(true); // update DOM
                    });

                // demo settings update

                const update = function (settings) {
                    if (Nav.isOpen()) {
                        Nav.on("close.once", function () {
                            Nav.update(settings);
                            Nav.open();
                        });

                        Nav.close();
                    } else {
                        Nav.update(settings);
                    }
                };

                $(".actions")
                    .find("a")
                    .on("click", function (e) {
                        e.preventDefault();

                        var $this = $(this).addClass("active");
                        var $siblings = $this.parent().siblings().children("a").removeClass("active");
                        var settings = eval("(" + $this.data("demo") + ")");

                        if ("theme" in settings) {
                            $("body")
                                .removeClass()
                                .addClass("theme-" + settings["theme"]);
                        } else {
                            update(settings);
                        }
                    });

                $(".actions")
                    .find("input")
                    .on("change", function () {
                        var $this = $(this);
                        var settings = eval("(" + $this.data("demo") + ")");

                        if ($this.is(":checked")) {
                            update(settings);
                        } else {
                            var removeData = {};
                            $.each(settings, function (index, value) {
                                removeData[index] = false;
                            });

                            update(removeData);
                        }
                    });
            })(jQuery);
        </script>
        
        @stack('js')
        
        
    </body>
</html>
