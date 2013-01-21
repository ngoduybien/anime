
// EDITABLE AREA
// ==============================================================

$(document).ready(function() {
  
  // Cufon
  // ------------------------------------------------------------
  
  Cufon.replace('h2, h3, h4', { 
    fontFamily: 'Quicksand Book',
    hover: true
  });
  
  Cufon.replace('#topbar', {
    fontFamily: 'PT Sans', 
    fontSize: '20px',
    textShadow: '1px 1px black' 
  });
  
  Cufon.now();
  
  
  
  // Adjust Boxed Layout
  // ------------------------------------------------------------
  $().adjust_boxed_layout();
  
  
  
  // Content Toggler
  // ------------------------------------------------------------
  $(".toggler").toggler();
  
  
  
  // Nivo Slider
  // ------------------------------------------------------------
  
  if($.isFunction($.fn.nivoSlider)) {
    $(window).load(function() {
    
      // Startpage Slider
    	$("#showcase .items").nivoSlider();
    	
    	// Normal Slider
    	$(".slider:not(.automatic, .show-nav-arrows)").nivoSlider({
    		slices: 20,
    		manualAdvance: true // Force manual transitions
    	});
    	
    	// Automatic Slider
    	$(".slider.automatic:not(.show-nav-arrows)").nivoSlider({
    		slices: 20,
    		controlNav: true
    	});
    	
    	// Slider with navigation arrows
    	$(".slider.show-nav-arrows").nivoSlider({
    		slices: 20,
    		directionNavHide: false, // Only show on hover
    		manualAdvance: true // Force manual transitions
    	});
    	
    });
  }
  
  
  
  // Fancybox
  // ------------------------------------------------------------
  
  if($.isFunction($.fn.fancybox) && !$.isFunction($.fn.prettyPhoto)) {
    $("a[rel^='lightbox']").fancybox({
      'hideOnContentClick' : true,
  		'titlePosition' : 'over',
  		'transitionIn'	: 'elastic',
  		'transitionOut'	: 'elastic',
  		'overlayColor'  : 'black',
  		'overlayOpacity': 0.7,
  		'speedIn' :	600, 
  		'speedOut':	300, 
  		'padding' :	0
  	});
  }
  
  
  
  // prettyPhoto
  // ------------------------------------------------------------
  if($.isFunction($.fn.prettyPhoto) && !$.isFunction($.fn.fancybox)) {
    $("a[rel^='lightbox']").prettyPhoto({
  			animationSpeed: 'fast', // fast/slow/normal
  			opacity: 0.80,          // Value between 0 and 1
  			theme: 'facebook',      // light_rounded / dark_rounded / light_square / dark_square / facebook
  			overlay_gallery: false  // If set to true, a gallery will overlay the fullscreen image on mouse over
  		});
  	}


  
  // Superfish
  // ------------------------------------------------------------
  
  if($.isFunction($.fn.superfish)) {
    $('#header ul.nav').superfish({ 
      delay:       500,                             // delay on mouseout in milliseconds
      animation:   {opacity:'show',height:'show'},  // fade-in and slide-down animation 
      speed:       'fast',                          // faster animation speed 
      autoArrows:  true,                            // disable generation of arrow mark-up 
      dropShadows: false                            // disable drop shadows 
    });
  }
  
  
  
  // Mark Right Navigation Elements
  // ------------------------------------------------------------
  
  $('#header ul.nav > li').mark_right_nav_elements();
  
  
  
  // Sliding Links
  // ------------------------------------------------------------
  
  if(!$("body").hasClass("no-sliding-links")) {
    $('#sidebar .nav ul li a').sliding_links({ offset: 4 });
    $('#footer .nav ul li a').sliding_links({ offset: 3 });
  }
  
  
  
  // Image Captions
  // ------------------------------------------------------------
  
  $(".img-with-caption").image_caption_auto_width();
  
  
  
  // Rounded Image
  // ------------------------------------------------------------
  
  $("img.rounded").rounded_image();
  
  
  
  // Rounded Box
  // ------------------------------------------------------------
  
  if($.fn.rounded_image.has_border_radius()) {
    $("object.rounded, iframe.rounded").each(function() {
      $(this).wrap("<div class='rounded-box' />");
    });
    
    $(".rounded-box").rounded_box();
  }
  
  
  
  // Lightbox Overlay
  // ------------------------------------------------------------
  
  $(window).load(function() {
    $(":not(.slider) > a[rel^='lightbox'] img").lightbox_overlay();
    $("a[rel^='lightbox'] .rounded").lightbox_overlay();
  }); 
  
  
  
  // Fix flash object z-index
  // ------------------------------------------------------------
  
  $().flashback();
  
  
  
  // Browser detection
  // ------------------------------------------------------------
  
  $().browser_detection();
  
  
  
  // Contact Form
  // ------------------------------------------------------------
  
  if($.isFunction($.fn.validate) && $.isFunction($.fn.ajaxForm)) {
    $("#contactform").validate({
  	  errorClass: "invalid",
  	  errorPlacement: function(error, element) {
        error.hide();
      },
      submitHandler: function(form) {
      	$(form).ajaxSubmit();
      }
  	});
  }
  else if($.isFunction($.fn.ajaxForm)) {
    $("#contactform").ajaxSubmit();
  }
  
  if($.isFunction($.fn.ajaxForm)) {
    function init_ajax_form(form) {
      $(form).ajaxForm({
        target: "form .message",
        beforeSubmit: before_submit,
        success: success
      });
      function before_submit() {
        $(form).find("button").attr("disabled", true); 
        $(form).find(".spinner").fadeIn();
        $(form).find(".message").animate({ opacity: 0 }).slideUp();
      }
      function success() {
        $(form).find("button").attr("disabled", false); 
        $(form).find(".spinner").fadeOut();
        $(form).find(".message").slideDown().animate({ opacity: 1 });
      }
    }
    
    init_ajax_form("#contactform");
  }
  
});










// PLUGINS
// ==============================================================




(function($)
{	

  // Adjust Boxed Layout
  // ------------------------------------------------------------
  
	$.fn.adjust_boxed_layout = function(options) {
		//var options = $.extend(defaults, options);
		$.fn.adjust_boxed_layout.options = $.extend({}, $.fn.adjust_boxed_layout.defaults, options);
		
    if($('body').hasClass($.fn.adjust_boxed_layout.options.tag_class)) {
      jQuery.event.add(window, "load", $.fn.adjust_boxed_layout.activate);
      jQuery.event.add(window, "resize", $.fn.adjust_boxed_layout.activate);
    }
	};
	
	$.fn.adjust_boxed_layout.activate = function() {
    if($(window).width() < $.fn.adjust_boxed_layout.options.max_resolution)
      $('body').removeClass($.fn.adjust_boxed_layout.options.tag_class);
    else
      $('body').addClass($.fn.adjust_boxed_layout.options.tag_class);
	};
	
	$.fn.adjust_boxed_layout.options = {};
	
	$.fn.adjust_boxed_layout.defaults = {
		tag_class: 'boxed', 
		max_resolution: 1080
	};
	
	
	
  // Mark Right Navigation Elements
  // ------------------------------------------------------------
    
  $.fn.mark_right_nav_elements = function(options) {
    
    var defaults = {
      class_name: 'right'
    };
    
    var options = $.extend(defaults, options);
    var link_count = this.size();
      
    return this.each(function(i) {
      if((link_count - 2) < i+1)
        $(this).addClass(options.class_name);
    });
  };
  
  
  
  // Sliding Links
  // ------------------------------------------------------------
  
  $.fn.sliding_links = function(options) {
    
    var defaults = {
      offset: 5,
      animation_speed: 120
    };
    
    var options = $.extend(defaults, options);
  
    pl_def = '';
    pr_def = '';
    
    return this.each(function() {
    
      $(this).hover(
        function() {
          pl_def = $(this).css("padding-left");
          pr_def = $(this).css("padding-right");
          
          $(this).animate({
            paddingLeft: parseInt($(this).css("padding-left").replace("px", "")) + options.offset + "px",
            paddingRight: parseInt($(this).css("padding-right").replace("px", "")) - options.offset + "px"
          }, options.animation_speed);
        },
        function() {
          bc_hover = $(this).css("background-color");
          $(this).animate({
            paddingLeft: pl_def,
            paddingRight: pr_def
          }, options.animation_speed);
        }
      );
    
    });
  };
  
  
  
  // Image Captions
  // ------------------------------------------------------------
  
  $.fn.image_caption_auto_width = function() {
    return this.each(function() {
      img = $(this).contents("img");
      $(this).css('width', img.width());
    });
  };
  
  
  
  // Rounded Corners
  // ------------------------------------------------------------
  
  $.fn.rounded_image = function() {
    if($.fn.rounded_image.has_border_radius()) {
      return this.each(function() {
        if($(this).width == 0 || $(this).height == 0)
          $(this).load(function() { $.fn.rounded_image.create_bg_img($(this)); });
        else
          $.fn.rounded_image.create_bg_img($(this));
      });
    }
  };
  
  $.fn.rounded_image.create_bg_img = function(object) {
    classes = object.attr("class");
    object.wrap("<div class='"+classes+"' />");
    var img_src = object.attr("src");
    var img_height = object.height();
    var img_width = object.width();
    object.parent()
      .css("background-image", "url(" + img_src + ")")
      .css("background-repeat","no-repeat")
      .css("height", img_height + "px")
      .css("width", img_width + "px");
    object.remove();
  };
  
  $.fn.rounded_image.has_border_radius = function() {
    var d = document.createElement("div").style;
    if(typeof d.borderRadius !== "undefined") return true;
    if(typeof d.WebkitBorderRadius !== "undefined") return true;
    if(typeof d.MozBorderRadius !== "undefined") return true;
    return false;
  };
  
  
  
  // Rounded Box
  // ------------------------------------------------------------
  
  $.fn.rounded_box = function() {
    return this.each(function() {
      $(this).prepend("<div class='rounded-corners-lt'></div>");
      $(this).prepend("<div class='rounded-corners-rt'></div>");
      $(this).prepend("<div class='rounded-corners-lb'></div>");
      $(this).prepend("<div class='rounded-corners-rb'></div>");
    });
  }
  
  
  
  // Lightbox Overlay
  // ------------------------------------------------------------
  
  $.fn.lightbox_overlay = function(options) {
    
    var defaults = {
      opacity: 0.5,
      animation_speed: 200,
      class_name: 'lightbox-image'
    };
    
    var options = $.extend(defaults, options);
    
    return this.each(function() {
    
      var img  = $(this);
      var link = $(this).parent();
      var bg   = $("<span class='"+ options.class_name +"'></span>").appendTo(link);
  		
  		link.bind('mouseenter', function() {
  			var width    = img.width();
  			var height   = img.height();
  			var position = img.position();
  			bg.css({ width:width, height:height, top:position.top, left:position.left });
  		});
    
      $(this).hover(
        function() { img.stop().animate({ opacity: options.opacity }, options.animation_speed); },
    	  function() { img.stop().animate({ opacity: 1 }, options.animation_speed); }
      ); 
      
    });
    
  };
  
  
  
  // Content Toggler
  // ------------------------------------------------------------
  
  $.fn.toggler = function(options) {
  
    var defaults = {
      content: '.toggle-content'
    };
    
    var options = $.extend(defaults, options);
    
    var heading = $(this);
    var content = $(options.content);
    
    // Hide Toggle Content
    content.css("display", "none");
    
    return this.each(function() {
      $(this).bind('click', function() {
      
        if($(this).is(".active")) {
          if($(this).next(content)) {
            $(this).removeClass("active").next(content).slideUp();
          }
        }
        else {
          if($(this).is(".close-all")) {
            heading.removeClass("active");
            content.slideUp();
          }
          
          if($(this).next(content)) {
            $(this).addClass("active").next(content).slideDown();
          }
        }
        
      });
    });
    
  };
  
  
  
  // Fix flash object z-index
  // Code from: http://labs.kaliko.com/2009/11/change-wmode-with-jquery.html
  // ------------------------------------------------------------
  
  $.fn.flashback = function() {
    
    // For real browsers
    $("embed").attr("wmode", "opaque");
    
    // IE Fix
    var embed_tag;
    $("embed").each(function(i) {
      embed_tag = $(this).attr("outerHTML");
      if((embed_tag != null) && (embed_tag.length > 0)) {
        embed_tag = embed_tag.replace(/embed /gi, "embed wmode=\"opaque\" ");
        $(this).attr("outerHTML", embed_tag);
      }
      else {
        $(this).wrap("<div class='object-wrapper'></div>");
      }
    });
      
  };
  
  
  
  // Fix flash object z-index
  // ------------------------------------------------------------
  
  $.fn.browser_detection = function() {
    
    var is_chrome = navigator.userAgent.toLowerCase().indexOf('chrome') > -1;

    if(is_chrome) $("body").addClass("bd-chrome");
      
  };
  
  
	
})(jQuery);