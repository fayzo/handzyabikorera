<!--  footer -->
<div class="popupTweet"></div>

<!-- Footer Section Begin -->
    <footer class="footer-section set-bg" data-setbg="<?php echo BASE_URL;?>assets/image/img/footer-bg-food.jpg">
        <div class="container">
            <div class="footer-text" style="padding: 30px;">
                <div class="row">
                    <div class="col-lg-3 mb-3">
                        <div class="footer-logo">
                            <div class="logos  mb-3" >
                            <!-- style="margin-bottom: 20px;" -->
                                <a href="<?php echo HOME; ?>"> 
                                    <img src="<?php echo BASE_URL_LINK ;?>images/logo.jpg">
                                </a>
                            </div>
                            <ul style="list-style-type: none;display: flex;margin-top:30px;margin-bottom:30px;">
                                <li><i class="ti-facebook"></i> <a href="< ?php echo FACEBOOK.$businessDetails['facebook_business']; ?>">Facebook</a></li>
                                <li><i class="ti-instagram"></i> <a href="< ?php echo INSTAGRAM.$businessDetails['instagram_business']; ?>">Instagram</a></li>
                                <li><i class="ti-twitter-alt"></i> <a href="< ?php echo TWITTER.$businessDetails['twitter_business']; ?>">Twitter</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 mb-3">
                        <div class="footer-widget">
                            <h4>About Us</h4>
                            <p>Integer cursus scelerisque ipsum id efficitur. Donec a dui fringilla, 
                                gravida lorem ac, semper magna. Aenean rhoncus ac lectus a interdum. 
                                Vivamus semper posuere dui.
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-3 mb-3">
                        <div class="footer-widget">
                            <h4>Opening Hours</h4>
                            <ul class="social">
                                <li>
                                    <span class="text-color">Monday :</span>9:Am - 10PM
                                </li>
                                <li>
                                    <span class="text-color">Tue-Wed :</span>9:Am - 10PM
                                </li>
                                <li>
                                    <span class="text-color">Thu-Fri :</span> 9:Am - 10PM
                                </li>
                                <li>
                                    <span class="text-color">Sat-Sat :</span> 5:PM - 10PM
                                </li>
                                <li>
                                    <span class="text-color">Sunday: </span> Close
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="footer-widget" >
                        <!-- style="float:left; margin-right:70px;" -->
                            <h4>Contact Us</h4>
                            <ul class="contact-option">
                                <li><i class="fa fa-map-marker"></i>  KG 54 ST, RW</li>
                                <li><i class="fa fa-phone"></i> (+250) 78563454</li>
                                <li><i class="fa fa-envelope"></i> handmade@rwanda.com</li>
                                <!-- <a href = "mailto:abc@example.com?subject = Feedback&body = Message">
                                Send Feedback
                                </a> -->
                                <li><i class="fa fa-clock-o"></i> Mon - Sat, 08 AM - 06 PM</li>
                            </ul>
                           
                        </div>
                    </div>
                   
                </div>
            </div>
        </div>
        <div class="copyright-text" style="background-color: #010101d6;">
        <p><p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
        Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | <i class="ti-heart" aria-hidden="true"></i> by <a href="<?php echo (isset($_SESSION['key']))? HOME:F_INDEX; ?>" >Restaurant Live Dinner</a>
        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p></p>
        </div>


    </footer>
    <!-- end footer -->
     
</div>

</div>

<div class="overlay"></div>

<!-- Javascript files-->
<!-- <script src="<?php echo BASE_URL_LINK ;?>dist/js/jquery.min.js"></script> -->
<script src="<?php echo BASE_URL_LINK ;?>dist/js/jquery-3.3.1.min.js"></script>
<script src="<?php echo BASE_URL_LINK ;?>dist/js/popper.min.js"></script>
<script src="<?php echo BASE_URL_LINK ;?>dist/js/bootstrap.bundle.min.js"></script>
<!-- <script src="<?php echo BASE_URL_LINK ;?>dist/js/bootstrap.min.js"></script> -->
<!-- <script src="<?php echo BASE_URL_LINK ;?>dist/js/jquery-3.0.0.min.js"></script> -->
<script src="<?php echo BASE_URL_LINK ;?>dist/js/jquery-ui.min.js"></script>
<script src="<?php echo BASE_URL_LINK ;?>dist/js/owl.carousel.min.js"></script>
<script src="<?php echo BASE_URL_LINK ;?>dist/js/jquery.magnific-popup.min.js"></script>
<script src="<?php echo BASE_URL_LINK ;?>dist/js/jquery.dataTables.min.js"></script>
<script src="<?php echo BASE_URL_LINK ;?>dist/js/bootstrap4.min.js"></script>
<script src="<?php echo BASE_URL_LINK ;?>dist/js/pushMenu.js"></script>
<script src="<?php echo BASE_URL_LINK ;?>dist/js/jquery.ui.totop.js"></script>
<!-- sidebar -->

<!-- <script src="js/jquery.mCustomScrollbar.concat.min.js"></script> -->
<script src="<?php echo BASE_URL_LINK ;?>js/main.js"></script>
<script src="<?php echo BASE_URL_LINK ;?>js/custom.js"></script>
<script src="<?php echo BASE_URL_LINK ;?>js/login_please.js"></script>
<script src="<?php echo BASE_URL_LINK ;?>js/settings.js"></script>
<script src="<?php echo BASE_URL_LINK ;?>js/siderbarResponsive.js"></script>
<script src="<?php echo BASE_URL_LINK ;?>js/craft_addcategories.js"></script>
<script src="<?php echo BASE_URL_LINK ;?>js/likes.js"></script>
<script src="<?php echo BASE_URL_LINK ;?>js/handmade_cart.js"></script>
<script src="<?php echo BASE_URL_LINK ;?>js/profileEdit.js"></script>
<script src="<?php echo BASE_URL_LINK ;?>js/manage_admin_db.js"></script>
<script src="<?php echo BASE_URL_LINK ;?>js/checkout.js"></script>
<!-- <script src="https:cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script> 
-->
<script type="text/javascript">
    $(document).ready(function() {

        $(".agent-carousel").owlCarousel({
        items: 4,
        dots: false,
        // autoplay: true,
        margin: 0,
        loop: true,
        smartSpeed: 1200,
        nav: true,
        navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
        responsive: {
            320: {
                items: 1,
            },
            768: {
                items: 2,
            },
            992: {
                items: 3,
            },
            1200: {
                items: 4,
            }
        }
    });

        // $("#sidebar").mCustomScrollbar({
        //     theme: "minimal"
        // });

        // $('#dismiss, .overlay').on('click', function() {
        //     $('#sidebar').removeClass('active');
        //     $('.overlay').removeClass('active');
        // });

        // $('#sidebarCollapse').on('click', function() {
        //     $('#sidebar').addClass('active');
        //     $('.overlay').addClass('active');
        //     $('.collapse.in').toggleClass('in');
        //     $('a[aria-expanded=true]').attr('aria-expanded', 'false');
        // });

    });
</script> 
 <!-- Starting the plugin -->
 <script type="text/javascript">
        $(document).ready(function() {
            $().UItoTop({ easingType: 'easeOutQuart' });

        });
</script>
<script>
  // This example adds a marker to indicate the position of Bondi Beach in Sydney,
  // Australia.
//   function initMap() {
//     var map = new google.maps.Map(document.getElementById('map'), {
//       zoom: 11,
//       center: {lat: 40.645037, lng: -73.880224},
//       });

//   var image = 'images/maps-and-flags.png';
//   var beachMarker = new google.maps.Marker({
//       position: {lat: 40.645037, lng: -73.880224},
//       map: map,
//       icon: image
//     });
//   }
</script>
<!-- google map js -->
<!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA8eaHt9Dh5H57Zh0xVTqxVdBFCvFMqFjQ&callback=initMap"></script> -->
<!-- end google map js --> 
<script>
      // Example starter JavaScript for disabling form submissions if there are invalid fields
      (function() {
        'use strict';
        window.addEventListener('load', function() {
          // Fetch all the forms we want to apply custom Bootstrap validation styles to
          var forms = document.getElementsByClassName('needs-validation');

          // Loop over them and prevent submission
          var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
              if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
              }
              form.classList.add('was-validated');
            }, false);
          });
        }, false);
      })();
    </script>
</body>

</html>