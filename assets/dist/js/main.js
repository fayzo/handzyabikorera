'use strict';

(function ($) {

 $(".table_adminLA").DataTable({
    "lengthChange": true,
    "pageLength":10,
    "lengthMenu": [[5,10, 25, 50, -1], [5,10, 25, 50, "All"]]
  });

  $(".table_adminLA1").DataTable({
    "lengthChange": true,
    "pageLength":10,
    "lengthMenu": [[5,10, 25, 50, -1], [5,10, 25, 50, "All"]]
  });

  $(".table_adminLA2").DataTable({
    "lengthChange": true,
    "pageLength":10,
    "lengthMenu": [[5,10, 25, 50, -1], [5,10, 25, 50, "All"]]
  });
  // this is for subscription email
  $(".table_adminLA3").DataTable({
    "lengthChange": true,
    "pageLength":10,
    "lengthMenu": [[5,10, 25, 50, -1], [5,10, 25, 50, "All"]]
  });

  // this is for subscription email
  $(".table_adminLA4").DataTable({
    "lengthChange": true,
    "pageLength":10,
    "lengthMenu": [[5,10, 25, 50, -1], [5,10, 25, 50, "All"]]
  });
  // this is for message to agent
  $(".table_adminLA5").DataTable({
    "lengthChange": true,
    "pageLength":10,
    "lengthMenu": [[5,10, 25, 50, -1], [5,10, 25, 50, "All"]]
  });

    /*-------------------
    Agent Slider
    --------------------- */
    

    $(".top-properties-carousel").owlCarousel({
        items: 1,
        dots: false,
        autoplay: true,
        margin: 0,
        loop: true,
        smartSpeed: 2000,
        nav: true,
        navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"]
    });


    
})(jQuery);

