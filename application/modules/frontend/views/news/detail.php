<section class="hero hero-game" style="background-image: url('<?=base_url()?>temp/front/banner-news.jpg');">
    <div class="overlay"></div>
    <div class="container">
      <div class="hero-block text-center">
        <div class="hero-center">
          <h2 class="hero-title">ARTICLE - DETAIL</h2>
        </div>
      </div>
    </div>
  </section>

<section class="col-lg-10 mx-auto">
    <div class="container">
      <div class="row">
        <div class="col-lg-1 hidden-md-down">
          <!-- widget share -->
          <div class="widget widget-share" data-fixed="widget">
            <div class="widget-block">
              <a class="btn btn-social btn-facebook btn-circle" id="facebook" href="https://www.facebook.com/sharer/sharer.php?u=<?=base_url("news/detail/$news->id_news/$news->slug")?>" data-toggle="tooltip" title="Share on Facebook" data-placement="bottom" role="button"><i class="fa fa-facebook"></i></a>
              <a class="btn btn-social btn-twitter btn-circle" id="twitter" href="https://twitter.com/intent/tweet?url=<?=base_url("news/detail/$news->id_news/$news->slug")?>" data-toggle="tooltip" title="Share on Twitter" data-placement="bottom" role="button"><i class="fa fa-twitter"></i></a>
              <a class="btn btn-social btn-whatsapp btn-circle" id="whatsapp" href="https://wa.me/?text=<?=base_url("news/detail/$news->id_news/$news->slug")?>" data-toggle="tooltip" title="Share on Whatsapp" data-placement="bottom" role="button"><i class="fa fa-whatsapp"></i></a>
            </div>
          </div>
        </div>
        <div class="col-lg-10">
          <!-- post -->
          <div class="post post-single">
            <h2 class="post-title"><?=$news->title?></h2>
            <div class="post-meta">
              <span><i class="fa fa-clock-o"></i> <?=date('d/m/Y',strtotime($news->created_at))?></span>
              <span><i class="fa fa-user"></i> Admin</span>
              <span><a href=""><i class="fa fa-tags"></i> <?=$news->category?></a></span>
              <!-- <span><a href="#comments"><i class="fa fa-comment-o"></i> 98 comments</a></span> -->
            </div>

            <?php if ($news->image!=""): ?>
              <div class="post-thumbnail">
                <a href="<?=base_url("temp/img_manager/news/$news->image")?>" data-fancybox="gallery">
                  <div class="image-post-detail" style='background:url(<?=base_url("temp/img_manager/news/$news->image")?>)'></div>
                </a>
              </div>
            <?php endif; ?>

            <div class="text-justify">
              <?=$news->description?>
            </div>
          </div>
          <div class="post-actions">
            <div class="post-tags">
              <a href="#"><i class="fa fa-tags"></i> <?=$news->category?></a>
            </div>
            <div class="social-share">
              <a class="btn btn-social btn-facebook btn-circle" id="facebook" href="https://www.facebook.com/sharer/sharer.php?u=<?=base_url("news/detail/$news->id_news/$news->slug")?>" data-toggle="tooltip" title="Share on Facebook" data-placement="bottom" role="button"><i class="fa fa-facebook"></i></a>
              <a class="btn btn-social btn-twitter btn-circle" id="twitter" href="https://twitter.com/intent/tweet?url=<?=base_url("news/detail/$news->id_news/$news->slug")?>" data-toggle="tooltip" title="Share on Twitter" data-placement="bottom" role="button"><i class="fa fa-twitter"></i></a>
              <a class="btn btn-social btn-whatsapp btn-circle" id="whatsapp" href="https://wa.me/?text=<?=base_url("news/detail/$news->id_news/$news->slug")?>" data-toggle="tooltip" title="Share on Whatsapp" data-placement="bottom" role="button"><i class="fa fa-whatsapp"></i></a>
            </div>
          </div>


          <div class="post-related">
            <h6 class="subtitle">Other Articles</h6>
            <div class="row">
              <?=other_article($news->id_news)?>
            </div>
          </div>

        </div>
      </div>
    </div>
  </section>
