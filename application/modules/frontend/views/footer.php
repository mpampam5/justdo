

  <!-- /main -->

  <!-- footer -->
  <footer id="footer">
    <div class="container">
      <div class="row wow fadeIn">
        <div class="col-sm-12 col-md-3">
          <div class="row">

            <img src="<?=base_url()?>temp/logo-footer.png" style="width:220px;height:100px" alt="">

          </div>

        </div>

        <div class="col-sm-12 col-md-3">
          <h4 class="footer-title">Contact</h4>
          <div class="row">
            <div class="col">
              <ul>
                <li><a><i class="fa fa-globe"></i> <?=setting("domain")?></a></li>
                <li><a><i class="fa fa-phone"></i> <?=setting("telepon")?></a></li>
                <li><a><i class="fa fa-map"></i> <?=setting("alamat")?></a></li>
                <!-- <li><a href="#">Steam</a></li> -->
              </ul>
            </div>
          </div>
        </div>


        <div class="col-sm-12 col-md-2">
          <h4 class="footer-title">Page</h4>
          <div class="row">
            <div class="col">
              <ul>
                <li><a href="">My Project</a></li>
                <li><a href="">My Project</a></li>
                <li><a href="">My Project</a></li>
                <li><a href="">My Project</a></li>
                <li><a href="">My Project</a></li>
                <!-- <li><a href="#">Steam</a></li> -->
              </ul>
            </div>
          </div>
        </div>

      </div>
      <div class="footer-bottom">
        <div class="footer-social">
          <a href="https://facebook.com/yakuthemes" target="_blank" data-toggle="tooltip" title="facebook"><i class="fa fa-facebook"></i></a>
          <a href="https://twitter.com/yakuthemes" target="_blank" data-toggle="tooltip" title="twitter"><i class="fa fa-twitter"></i></a>
          <a href="https://steamcommunity.com/id/yakuzi" target="_blank" data-toggle="tooltip" title="steam"><i class="fa fa-steam"></i></a>
          <a href="https://www.twitch.tv/" target="_blank" data-toggle="tooltip" title="twitch"><i class="fa fa-twitch"></i></a>
          <a href="https://www.youtube.com/user/1YAKUZI" target="_blank" data-toggle="tooltip" title="youtube"><i class="fa fa-youtube"></i></a>
        </div>
        <p>Copyright &copy; <?=date("Y")?> <a href="<?=setting("domain")?>" target="_blank"><?=setting("title")?></a>. All rights reserved.</p>
      </div>
    </div>
  </footer>
  <!-- /footer -->


  <!-- plugins js -->
  <script src="<?=base_url()?>temp/front/plugins/fancybox/dist/jquery.fancybox.min.js"></script>
  <script src="<?=base_url()?>temp/front/plugins/lightbox/lightbox.js"></script>
  <script src="<?=base_url()?>temp/front/plugins/owl-carousel/js/owl.carousel.min.js"></script>
  <script src="<?=base_url()?>temp/front/plugins/wow/dist/wow.js"></script>
  <script>

    wow = new WOW(
      {
        animateClass: 'animated',
        offset:       100,
        callback:     function(box) {
          console.log("WOW: animating <" + box.tagName.toLowerCase() + ">")
        }
      }
    );
    wow.init();

    (function($) {
      "use strict";

      // Full Width Carousel
      $('.owl-slide').owlCarousel({
        nav: true,
        loop: true,
        autoplay: true,
        items: 1
      });

      $('.owl-carousel').owlCarousel({
        margin: 15,
        loop: true,
        dots: false,
        autoplay: true,
        responsive: {
          0: {
            items: 1
          },
          700: {
            items: 2
          },
          800: {
            items: 3
          },
          1000: {
            items: 4
          },
          1200: {
            items: 6
          }
        }
      });


      // lightbox
      $('[data-lightbox]').lightbox();
    })(jQuery);
  </script>

  <!-- theme js -->
  <script src="<?=base_url()?>temp/front/js/theme.js"></script>
</body>
</html>
