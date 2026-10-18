<!DOCTYPE html>
 <html class="loading" lang="en" >
   <!-- BEGIN: Head-->
   <head>

     <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <!-- CSRF Token -->
     <meta name="csrf-token" content="{{ csrf_token() }}">
     <meta http-equiv="X-UA-Compatible" content="IE=edge" />
     <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui" />
     <meta name="description" content="" />
     <meta name="keywords" content="" />
     <meta name="author" content="NIT" />
     @yield('title')
     <script>
       // Apply saved admin theme before paint (no light flash in dark mode)
       (function () {
         try { if (localStorage.getItem('yg-admin-theme') === 'dark') document.documentElement.setAttribute('data-theme', 'dark'); } catch (e) {}
       })();
     </script>
     <link rel="apple-touch-icon" href="{{asset(general()->favicon())}}" />
     <link rel="shortcut icon" type="image/x-icon" href="{{asset(general()->favicon())}}" />

     <link rel="preconnect" href="https://fonts.googleapis.com" />
     <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
     <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />

     <!-- BEGIN: Vendor CSS-->
     <link rel="stylesheet" type="text/css" href="{{asset(assetLinkAdmin().'/app-assets/vendors/css/vendors.min.css')}}" />
     <link rel="stylesheet" type="text/css" href="{{asset(assetLinkAdmin().'/app-assets/vendors/css/forms/selects/select2.min.css')}}" />
     <!-- END: Vendor CSS-->

     <!-- BEGIN: Theme CSS-->
     <link rel="stylesheet" type="text/css" href="{{asset(assetLinkAdmin().'/app-assets/css/bootstrap.min.css')}}" />
     <link rel="stylesheet" type="text/css" href="{{asset(assetLinkAdmin().'/app-assets/css/bootstrap-extended.min.css')}}" />
     <link rel="stylesheet" type="text/css" href="{{asset(assetLinkAdmin().'/app-assets/css/colors.min.css')}}" />
     <link rel="stylesheet" type="text/css" href="{{asset(assetLinkAdmin().'/app-assets/css/components.min.css')}}" />
     <!-- END: Theme CSS-->

     <!-- BEGIN: Page CSS-->
     <link rel="stylesheet" type="text/css" href="{{asset(assetLinkAdmin().'/app-assets/css/core/menu/menu-types/vertical-menu-modern.css')}}" />
     <link rel="stylesheet" type="text/css" href="{{asset(assetLinkAdmin().'/app-assets/css/core/colors/palette-gradient.min.css')}}" />
     <link rel="stylesheet" type="text/css" href="{{asset(assetLinkAdmin().'/app-assets/fonts/simple-line-icons/style.min.css')}}" />
     <link rel="stylesheet" type="text/css" href="{{asset(assetLinkAdmin().'/app-assets/css/pages/card-statistics.min.css')}}" />
     <link rel="stylesheet" type="text/css" href="{{asset(assetLinkAdmin().'/app-assets/css/pages/vertical-timeline.min.css')}}" />
     <!-- END: Page CSS-->

     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"/>
     <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet" />
     <!-- BEGIN: Custom CSS-->
     <link rel="stylesheet" type="text/css" href="{{asset(assetLinkAdmin().'/app-assets/css/tag-editor.css')}}" />
     <link rel="stylesheet" type="text/css" href="{{asset(assetLinkAdmin().'/app-assets/css/style.css')}}" />
     <link rel="stylesheet" type="text/css" href="{{asset(assetLinkAdmin().'/app-assets/css/yg-admin.css')}}?v=6" />
     <!-- END: Custom CSS-->

     <!-- BEGIN: Theme JS-->
     <script src="{{asset(assetLinkAdmin().'/app-assets/js/JsBarcode.all.js')}}"></script>

    <meta http-equiv='cache-control' content='no-cache'>
    <meta http-equiv='expires' content='0'>
    <meta http-equiv='pragma' content='no-cache'>

    <style type="text/css">
        .note-editable {
            background: white;
        }
      ul.statuslist li::before {
          content: '';
          width: 1px;
          height: 16px;
          background: #dddee1;
          position: absolute;
          left: 0px;
          right: auto;
          top: 5px;
      }
      ul.statuslist li:first-child::before {
        width: 0;
      }
      ul.statuslist li {
          display: inline-block;
          position: relative;
          padding: 0 5px;
      }
      ul.statuslist {
          margin: 0;
          padding: 0;
          list-style: none;
          text-align: right;
      }

      .ibox-tools {
          display: block;
          float: none;
          margin-top: 0;
          position: absolute;
          top: 7px;
          right: 15px;
          padding: 0;
          text-align: right;
      }

      .btn.btn-md {
        padding: 5px 15px;
        margin: 5px;
      }
      .menuListBar table{
        margin: 0;
    }
    .menuListBar table tr td {
        padding: 5px 10px;
    }
    .removeItem{
       margin: 0 5px;
       display: inline-block;
       color: red;
       cursor: pointer; 
    }
    .menuListBarSection {
        min-height: 150px;
        position: relative;
    }
    .loader {
        position: absolute;
        height: 100%;
        width: 100%;
        text-align: center;
        margin-top: 50px;
        display: none;
    }
    .loader img {
        width: 100px;
    }
      .addNewLabelMenu{
            margin: 0 5px;
            cursor: pointer;
            color: #2e3192;
            border: 1px solid #2e3192;
            display: inline-block;
            line-height: 18px;
            width: 20px;
            text-align: center;
            border-radius: 10px;
      }
    </style>

     @stack('css')
   </head>
   <!-- END: Head-->

   <!-- BEGIN: Body-->
   <body class="vertical-layout vertical-menu-modern 2-columns fixed-navbar hell {{Request::is('admin/pos-orders/create')? 'menu-collapsed' : ''}} " data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">

    @include(adminTheme().'layouts.header')
    @include(adminTheme().'layouts.sidebar')

    

     <!-- BEGIN: Content-->
     <div class="app-content content">
       <div class="content-overlay"></div>
       <div class="content-wrapper">
         @yield('contents')
       </div>
     </div>
     <!-- END: Content-->


     @include(adminTheme().'layouts.footer')
     
     
     <!-- Modal -->
    <div class="modal fade text-left" id="MenuSetting" tabindex="-1" >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel1">Menus Setting</h4>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times; </span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" class="newMenuItem">
                        <div class="form-group">
                            <label>Select Menu</label>
                            <select class="form-control ajaxMenuSelect" name="location">
                                <option value="">Select Location</option>
                                <option value="Top Header" >Top Header</option>
                                <option value="Header Menus" >Header Menus</option>
                                <option value="Footer Two" >Footer Two</option>
                                <option value="Footer Three" >Footer Three</option>
                            </select>
                        </div>
                        <div class="menuListBarSection">
                            <span class="loader"><img src="{{asset('medies/loading.gif')}}"></span>
                            <div class="menuListBar">
                            
                            </div>
                            
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn grey btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
            </div>
        </div>
    </div>


     <!-- BEGIN: Vendor JS-->
     <script src="{{asset(assetLinkAdmin().'/app-assets/vendors/js/vendors.min.js')}}"></script>
     <!-- BEGIN Vendor JS-->

     <!-- BEGIN: Page Vendor JS-->
     <script src="{{asset(assetLinkAdmin().'/app-assets/vendors/js/charts/apexcharts/apexcharts.min.js')}}"></script>
     <script src="{{asset(assetLinkAdmin().'/app-assets/vendors/js/forms/select/select2.full.min.js')}}"></script>
     <!-- END: Page Vendor JS-->

     <!-- BEGIN: Theme JS-->
     <script src="{{asset(assetLinkAdmin().'/app-assets/js/core/app-menu.min.js')}}"></script>
     <script src="{{asset(assetLinkAdmin().'/app-assets/js/core/app.min.js')}}"></script>
     <script src="{{asset(assetLinkAdmin().'/app-assets/js/scripts/customizer.min.js')}}"></script>
     <!-- END: Theme JS-->
     
     <!-- Drag dropable data  -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script src="{{asset(assetLinkAdmin().'/app-assets/js/printThis.js')}}"></script>
    
    
    <!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
     <!-- BEGIN: Page JS-->
     <script src="{{asset(assetLinkAdmin().'/app-assets/js/scripts/cards/card-statistics.min.js')}}"></script>
     <script src="{{asset(assetLinkAdmin().'/app-assets/js/scripts/forms/select/form-select2.min.js')}}"></script>
     <script src="{{asset(assetLinkAdmin().'/app-assets/js/tag-editor.js')}}"></script>
     <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
     <!-- END: Page JS-->
     
     <script src="{{asset('tinymce/tinymce.min.js')}}"></script>
     
     <script type="text/javascript">
      $( function() {
              $( ".sortable" ).sortable();
              $( ".sortable" ).disableSelection();
          } );

    </script>
     <script>
      $(document).ready(function(){
          
           tinymce.init({
            selector: 'textarea.tinyEditor',
            height: 300,
            menubar: false,
            statusbar: false,
            plugins: 'lists advlist image link fullscreen advcode code',
            toolbar: 'undo redo | styles | bold italic underline | alignleft aligncenter alignright alignjustify |' + 
            'bullist numlist outdent advlist | link image | preview media fullscreen  | code |' +
            'forecolor backcolor emoticons | fontsize',
            image_title: true,
            automatic_uploads: true,
            file_picker_types: 'image',
            file_picker_callback: function (cb, value, meta) {
                var input = document.createElement('input');
                input.setAttribute('type', 'file');
                input.setAttribute('accept', 'image/*');
                input.onchange = function () {
                  var file = this.files[0];
                  var reader = new FileReader();
                  reader.onload = function () {
                    var id = 'blobid' + (new Date()).getTime();
                    var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
                    var base64 = reader.result.split(',')[1];
                    var blobInfo = blobCache.create(id, file, base64);
                    blobCache.add(blobInfo);
                    cb(blobInfo.blobUri(), { title: file.name });
                  };
                  reader.readAsDataURL(file);
                };
                input.click();
              },
            content_style: 'body{font-family:Helvetica,Arial,sans-serif; font-size:16px}',
            font_size_formats: '8px 10px 12px 14px 16px 18px 24px 36px 48px',
    
        });
        
        $('.MenuSetting').click(function(){
            
            $('#MenuSetting').modal('show');
            
            var id =$(this).data('id');
            $('.newMenuItem').val(id);
            
        });
         
        $(document).on('change','.ajaxMenuSelect',function(){
            
            var url ="{{route('admin.menusAction','menuFilter')}}";
            var location=$(this).val();
            $('.loader').show();
            $.ajax({
              url:url,
              dataType: 'json',
              cache: false,
              data:{location:location},
               success : function(data){
                $('.menuListBar').empty().append(data.viewData);
                $('.loader').hide();
               },error: function () {
                  alert('error');
                  $('.loader').hide();
                }
            });
            
        });
        
        $(document).on('click','.addMenu',function(){
            
            var url ="{{route('admin.menusAction','menuFilter')}}";
            var id  =$('.newMenuItem').val();
            var type  =$('.newMenuItem').data('type');
            var parentItem  =$(this).data('id');
            var menulocation  =$('.ajaxMenuSelect').val();
            $('.loader').show();
            $.ajax({
              url:url,
              dataType: 'json',
              cache: false,
              data:{addmenuitem:id,addtype:type,parentItem:parentItem,menulocation:menulocation},
               success : function(data){
                $('.menuListBar').empty().append(data.viewData);
                $('.loader').hide();
               },error: function () {
                  alert('error');
                  $('.loader').hide();
                }
            });
            
        });
        
        $(document).on('click','.backMenus',function(){
            var url ="{{route('admin.menusAction','menuFilter')}}";
            var id  =$(this).data('id');
            var menulocation  =$('.ajaxMenuSelect').val();
            $('.loader').show();
            
            $.ajax({
              url:url,
              dataType: 'json',
              cache: false,
              data:{backmenuitem:id,menulocation:menulocation},
              success : function(data){
                $('.menuListBar').empty().append(data.viewData);
                $('.loader').hide();
              },error: function () {
                  alert('error');
                  $('.loader').hide();
                }
            });
            
            
        });
        
        $(document).on('click','.removeItem',function(){
            var url ="{{route('admin.menusAction','menuFilter')}}";
            var id  =$(this).data('id');
            var menulocation  =$('.ajaxMenuSelect').val();
            $('.loader').show();
            
            $.ajax({
              url:url,
              dataType: 'json',
              cache: false,
              data:{removeItem:id,menulocation:menulocation},
               success : function(data){
                $('.menuListBar').empty().append(data.viewData);
                $('.loader').hide();
               },error: function () {
                  alert('error');
                  $('.loader').hide();
                }
            });
            
        });
        
        
        $(document).on('click','.addNewLabelMenu',function(){
            var url ="{{route('admin.menusAction','menuFilter')}}";
            var id  =$(this).data('id');
            var menulocation  =$('.ajaxMenuSelect').val();
            $('.loader').show();
            
            $.ajax({
              url:url,
              dataType: 'json',
              cache: false,
              data:{nextLavelMenu:id,menulocation:menulocation},
               success : function(data){
                $('.menuListBar').empty().append(data.viewData);
                $('.loader').hide();
               },error: function () {
                  alert('error');
                  $('.loader').hide();
                }
            });
            
        });
          

        $('#PrintAction').on("click", function () {
            $('.PrintAreaContact').printThis();
          });

        $('#PrintAction2').on("click", function () {
            $('.PrintAreaContact2').printThis();
          });

         $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            });

            $(document).on('click','.reloadPage',function(){

                location.reload();
                return true;

            });
          
          $(document).on('click','.showPassword',function(){
                $(this).toggleClass('active-show');
                if ($(this).hasClass('active-show')) {
                    $('input.password').prop('type','text');
                    $(this).empty().append('<i class="fa fa-eye"></i>');
                } else {
                    $('input.password').prop('type','password');
                    $(this).empty().append('<i class="fa fa-eye-slash"></i>');
                }
            });


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


            $('.mediaDelete').click(function(e){
                e.preventDefault();

              var url =$(this).attr('href');

              if(confirm("Are you sure you want to delete this?")){
                
                $.ajax({
                  url : url,
                  type:'GET',
                  cache: false,
                  contentType: false,
                  dataType: 'json',
                  beforeSend: function()
                  {
                    
                  },
                  complete: function()
                  {
                      
                  },
                  }).done(function (data) {
                     
                     location.reload(true);
                    
                  }).fail(function () {
                      alert('fail');
                  });
                  
              }else{
                  return false;
              }

            });
          
      });
    </script>

    <script type="text/javascript">
      ///Check Box Select With Count show

          $(function() {
            $('.checkCounter').text('0');
            var generallen = $("input[name='checkid[]']:checked").length;
            if (generallen > 0) {
              $(".checkCounter").text('(' + generallen + ')');
            } else {
              $(".checkCounter").text(' ');
            }
            
          })
          
          function updateCounter() {
            var len = $("input[name='checkid[]']:checked").length;
            if (len > 0) {
              $(".checkCounter").text('(' + len + ')');
            } else {
              $(".checkCounter").text(' ');
            }
          }
          
          $("input:checkbox").on("change", function() {
            updateCounter();
          });

       
        $(document).ready(function(){
          $('#checkall').click(function() {
              var checked = $(this).prop('checked');
              $('input:checkbox').prop('checked', checked);
              updateCounter();
            });
        });
        
        ///Check Box Select With Count show
      </script>

    <script>
      // Dark / light mode toggle in the header
      (function () {
        var btn = document.getElementById('ygThemeToggle');
        if (!btn) return;
        btn.addEventListener('click', function () {
          var root = document.documentElement;
          var dark = root.getAttribute('data-theme') !== 'dark';
          if (dark) { root.setAttribute('data-theme', 'dark'); } else { root.removeAttribute('data-theme'); }
          try { localStorage.setItem('yg-admin-theme', dark ? 'dark' : 'light'); } catch (e) {}
        });
      })();
    </script>

      @stack('js')
   </body>
   <!-- END: Body-->
 </html>