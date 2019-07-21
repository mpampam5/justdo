<section class="hero hero-game" style="background-image: url('<?=base_url()?>temp/front/banner-news.jpg');">
    <div class="overlay"></div>
    <div class="container">
      <div class="hero-block text-center">
        <div class="hero-center">
          <h2 class="hero-title">ARTICLE</h2>
        </div>
      </div>
    </div>
  </section>

<section>
    <div class="container bg-secondary">
      <div class="row">
        <div class="col-lg-8 m-t-20">
          <!-- post -->
          <div id="content-post"></div>


          <div class="pagination-results m-t-30">
            <nav aria-label="Page navigation" id="navigation"></nav>
          </div>

        </div>




        <!-- sidebar -->
        <div class="col-lg-4 m-t-20">
          <div class="sidebar">
            <!-- widget search -->
            <div class="widget widget-search">
              <form>
                <div class="form-group input-icon-right">
                  <i class="fa fa-search"></i>
                  <input type="text" class="form-control" placeholder="search article...">
                </div>
              </form>
            </div>


            <!-- widget tags -->
            <div class="widget widget-tags">
              <h5 class="widget-title">Category</h5>
              <div class="post-tags">
                <?php foreach ($cat as $cats): ?>
                  <a href="#" class="text-warning"><i class="fa fa-tags"></i> <?=$cats->category?></a>
                <?php endforeach; ?>
              </div>
            </div>


            <!-- widget_video -->

            <?=widget_video("Video",1)?>

          </div>
        </div>
      </div>
    </div>
  </section>


  <script type="text/javascript">
  $(document).ready(function(){

  function load_data(page)
    {
      $.ajax({
               url:"<?php echo base_url(); ?>news/page/"+page,
               method:"GET",
               dataType:"json",
               success:function(data)
               {
                $('#navigation ul li a').addClass('page-link');
                $('#content-post').html(data.data);
                $('#navigation').fadeIn(1000).html(data.pagination_link);
               }
           });
    }

    load_data(1);

  $(document).on("click", ".pagination li a", function(event){
    event.preventDefault();
    var page = $(this).data("ci-pagination-page");
    load_data(page);
  });

  });
  </script>
