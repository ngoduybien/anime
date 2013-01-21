$(document).ready(function() {
  styleswitcher();
});





function styleswitcher() {

  var ss              = $("#styleswitcher");
  var show_ss_button  = $(".show-styleswitcher-button");
  var close_ss_button = ss.find(".close-button")
  var toggler         = ss.find(".toggler");
  var display_status_cookie_name = "digitalis_ss_ds";
  var toggler_status_cookie_name = "digitalis_ss_ts";
  var display_status  = get_cookie_value(display_status_cookie_name);
  
  // Hide or show Styleswitcher depending on cookie value
  if(display_status == "hide") {
    ss.hide();
    show_ss_button.show();
  }
  else {
    ss.show();
    show_ss_button.hide();
  }
  
  // When close button is clicked...
  close_ss_button.click(function() {
    $(this).parent().hide();
    show_ss_button.show();
    set_cookie_value(display_status_cookie_name, "hide");
  });
  
  // When show button is clicked...
  show_ss_button.click(function() {
    $(this).hide().next().show();
    set_cookie_value(display_status_cookie_name, "show");
  });
  
  // Toggler titles
  toggler_active_title = toggler.children().html();
  toggler_hidden_title = "Less Options...";
  
  // Show toggler content depending on cookie value
  if(get_cookie_value(toggler_status_cookie_name) == "show") {
    toggler.click();
    toggler.children().html(toggler_hidden_title);
  }
  
  // When toggler is clicked...
  toggler.click(function() {
    if(toggler.hasClass("active")) {
      set_cookie_value(toggler_status_cookie_name, "show");
      $(this).children().html(toggler_hidden_title);
    }
    else {
      set_cookie_value(toggler_status_cookie_name, "hide");
      $(this).children().html(toggler_active_title);
    }
  });
  
  // Auto submit when example style is choosen
  $("#ss_example-style").change(function() {
    $(this).parents("form").find('input[name=submit]').click();
  });
  
  /*
  input_click_handler($("#ss_no-footer"), $("#ss_no-footer-gradient, #ss_show-footer-bar, #ss_inline-footer-bar"));
  input_click_handler($("#ss_show-footer-bar"), $("#ss_inline-footer-bar"));
  input_click_handler($("#ss_minimal-layout"), $("#ss_no-header-gradient, #ss_no-footer-gradient, #ss_no-navigation-background"));
  */
}

// Set display status cookie
function set_cookie_value(name, value) {
  d = new Date();
  d.setTime (d.getTime() + (60 * 60 * 1000));
  document.cookie = name+"="+value+"; expires="+d+"; path=/";
}

// Get cookie value
function get_cookie_value(cookie_name) {
  var results = document.cookie.match ( '(^|;) ?' + cookie_name + '=([^;]*)(;|$)' );
  if(results)
    return (unescape(results[2]));
  else
    return null;
}

/*
function input_click_handler(trigger, targets) {
  trigger.bind('click', function() {
    disable(trigger, targets);
  });
  
  $(window).load(function() {
    disable(trigger, targets, true);
  }); 
}

function disable(trigger, targets, init) {
  var checked_trigger = trigger.is(":checked");
  var value = checked_trigger;
  targets.each(function() {
    if(init && $(this).is(":disabled")) {
      value = $(this).is(":disabled");
    }
    $(this).attr('disabled', value);
  });
  
}
*/



