var DefaultWidth = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
if (DefaultWidth < 418) {
  MaxCount = 11;
  CacheMode = 2;
} 
else if (DefaultWidth < 625) {
  MaxCount = 5;
  CacheMode = 1;
}
else if (DefaultWidth > 625) {
  MaxCount = 3;
  CacheMode = 0;
}

jQuery(document).ready(function($) {
  // Add responsive functionality to calendar
  width = $(window).width();
  $Forward = $('.cal-buttons a.cal-forward');
  $Backward = $('.cal-buttons a.cal-backward');
  CountClick = 0;
  Top = 0;
  // MaxCount = 3; // Default value(will be overwritten)
  $CalViewport = $(".content div.cal-viewport");
  $CalViewportInner = $("div.cal-viewport-inner"),
  // Scroll = 2,
  // MonthHeight = 219.
  ScrollHeight = 468; // MonthHeight * Scroll
  
  // Change mode if needed after window resize
  function CheckMode() {
    var ResizeWidth = $(window).width();
      
    if (ResizeWidth < 418) {
      Mode = 2;
    }
    else if (ResizeWidth < 625) {
      Mode = 1;
    }
    else if (ResizeWidth > 625) {
      Mode = 0;
    }
    
    if((typeof Mode != 'undefined') & (Mode != CacheMode)) {
      // Set default mode parameters to calendar
      CalendarVievport(Mode);
      
      // Reset parameters after window resize 
      CacheMode = Mode;
      Top = 0;
      $CalViewportInner.css("top", "0");
      $Forward.removeAttr( "disabled" );
      $Backward.attr( "disabled", "disabled" );
      CountClick = 0;
    }
  }

  function CalendarVievport(Mode) {
    // Set MaxCount & CSS based on Mode
    if (Mode == 2) {
      MaxCount = 11;
      $CalViewport.removeAttr('style'); // Fix for IE
      $CalViewport.css({
        "width": "210px",
        "height": "470px"
      });
    }
    else if (Mode == 1) {
      MaxCount = 5;
      $CalViewport.removeAttr('style'); // Fix for IE
      $CalViewport.css({
        "width": "418px",
        "height": "470px"
      });
    }
    else if (Mode == 0) {
      MaxCount = 3;
      $CalViewport.removeAttr('style'); // Fix for IE
      $CalViewport.css({
        "width": "650px",
        "height": "470px"
      });
    }
  }

  $(window).resize(CheckMode);
  
  // Max Forward Click
  $Forward.click(function () {
    CountClick += 1;
    Top = Top + ScrollHeight;
    
    // Add Scrolling
    if(CountClick <= MaxCount) {
      $CalViewportInner.animate({top: "-" + Top}, 600);
    }
    
    if(CountClick < MaxCount) {
      $(this).removeAttr( "disabled" );
    }
    else {
      $(this).attr( "disabled", "disabled" );
    }
    
    if(CountClick > 0) {
      $Backward.removeAttr( "disabled" );
    }
  });
  
  // Max Backward Click
  $Backward.click(function () {
    if (CountClick > 0) {
      CountClick -= 1;
      Top = Top - ScrollHeight;
      $CalViewportInner.animate({top: "-" + Top}, 600);
      
      if(CountClick > 0) {
        $(this).removeAttr( "disabled" );
      }

      if (CountClick == 0) {
        $(this).attr( "disabled", "disabled" );			
      }
    }
  });
});