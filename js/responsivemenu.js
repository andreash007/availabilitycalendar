(function ($) {
  Drupal.behaviors.responsivemenu = {
    attach: function (context, settings) {
      
      var cacheMode;
      
      function ResponsiveMenu() {
        if ($( document ).width() < 621) {
          mode = 1;
          if (mode != cacheMode) {
            $('#header').addClass('adaptive');
            $('#header').removeClass('full');
            cacheMode = mode;
          }
        }
        else {
          mode = 0;
          if (mode != cacheMode) {
            $('#header').addClass('full');
            $('#header').removeClass('adaptive');
            cacheMode = mode; 
          }
        }
      }

      ResponsiveMenu();
      $(window).resize(ResponsiveMenu);
      
      $('#navbar-toggle').click(function(){
        $("#main-menu .menu").toggle();
      });

    }
  };
}(jQuery));