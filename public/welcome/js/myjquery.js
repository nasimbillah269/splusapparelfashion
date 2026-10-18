$(document).ready(function(){
    
    /** CSRF Token Header Set **/
    $.ajaxSetup({
	    headers: {
	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    }
	});
	
	
	
	/** Sticky Header js **/

  var header = $('.sticky-header');
  var logo = $('.top-header');
  // var middle = $('.main-content');
    var win = $(window);
    win.on('scroll', function() {
        var scroll = win.scrollTop();
        if (scroll < 50){
            header.removeClass('stick');
            logo.removeClass('hideSection');
            // middle.removeClass('stickySpace');
        } else {
            header.addClass('stick');
            logo.addClass('hideSection');
            // middle.addClass('stickySpace');
        }
    });

    /** Sticky Header js **/
	
	
	/** Password Hide show Header js **/
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
    
    
    /** Subsribe Sweat Alert js **/
    $('.subscribe-button').click(function(e){
          e.preventDefault();
          Swal.fire('Thank You for your Subscribe!!');
      });
    /** Subsribe Sweat Alert js **/

    /** Mobile sidebar Menus  js **/
    $('.moble-menus-models').click(function(){
      $('.mobile-menu-side-modals').addClass('open-side');
      $("body").css('overflow-y','hidden');
    });

    $('.side-modals-close').click(function(){
      $('.side-modalsBar').removeClass('open-side');
      $("body").css('overflow-y','');
    })
    /** Mobile sidebar Menus  js **/
    
    /** Mobile sidebar Menus  js **/
    $('.mobile-menus-models').click(function(){
      $('.mobile-menu-side-modals2').addClass('open-side');
      $("body").css('overflow-y','hidden');
    });

    $('.side-modals-close2').click(function(){
      $('.side-modalsBar2').removeClass('open-side');
      $("body").css('overflow-y','');
    })
    /** Mobile sidebar Menus  js **/
    
    


    /** Matis Menus  js **/
      $('#menu').metisMenu({

      // enabled/disable the auto collapse.
      toggle: true,

      // prevent default event
      preventDefault: true,

      // default classes
      activeClass: 'active',
      collapseClass: 'collapse',
      collapseInClass: 'in',
      collapsingClass: 'collapsing',

      // .nav-link for Bootstrap 4
      triggerElement: 'span',

      // .nav-item for Bootstrap 4
      parentTrigger: 'li',

      // .nav.flex-column for Bootstrap 4
      subMenu: 'ul'

    });

    /** Matis Menus  js **/
	
	
	
	
	
	
	
	
	
	
	
	
});