<?php defined('BASEPATH') OR exit('No direct script access allowed');

function setting($field)
{
  $ci = get_instance();
  $news = $ci->db->get_where("setting",["id"=>999])->row();
  return $news->$field;
}

//WIDGET


function widget_video($title,$limit)
{
  $ci=&get_instance();
  $query = $ci->db->select('id,judul,slug,url,created_at')
                  ->from('media_video')
                  ->order_by('id','DESC')
                  ->limit($limit)
                  ->get();
  if ($query->num_rows() > 0) {
      $str='<div class="widget widget-video">
              <h5 class="widget-title">'.$title.'</h5>';
        foreach ($query->result() as $news) {
          $image = substr($news->url,-11);
                $str.='
                            <div class="widget-img">
                              <a href="'.site_url("video/$news->id/$news->slug").'"><img src="https://i1.ytimg.com/vi/'.$image.'/mqdefault.jpg" alt=""></a>
                              <a class="video-play-icon" href="blog-post-video.html">
                              <i class="fa fa-play"></i>
                            </div>
                            <h4><a href="'.site_url("video/$news->id/$news->slug").'" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="'.$news->judul.'">'.substr($news->judul,0,70).'...</a></h4>
                            <span><i class="fa fa-clock-o"></i> '.date('d/m/Y',strtotime($news->created_at)).'</span>';
        }

      $str.='</div>';

    return $str;
  }
}



function get_menu()
{
  $ci=&get_instance();
  $menu = $ci->db->select('id,name,url,sort,type,is_active')
                  ->from("menu_public")
                  ->where("is_active",1)
                  ->where("is_parent",0)
                  ->order_by("sort","asc")
                  ->get();
  $str ="<ul>";
  foreach ($menu->result() as $menus) {
    $sub_menu = $ci->db->select('id,name,url,sort,type,is_active')
                ->from("menu_public")
                ->where("is_active",1)
                ->where("is_parent",$menus->id)
                ->order_by("sort","asc")
                ->get();
      if ($sub_menu->num_rows() > 0) {
        $str.='<li class="has-dropdown">';
        $str.='<a href="#">'.$menus->name.'</a>';
        $str.='<ul>';
              foreach ($sub_menu->result() as $sub_menus) {
                $str.='<li><a href="'.$sub_menus->url.'" target="'.$sub_menus->type.'">'.$sub_menus->name.'</a></li>';
              }
        $str.='</ul>';
        $str.='</li>';
      }else {
        $str.='<li><a href="'.$menus->url.'" target="'.$menus->type.'">'.$menus->name.'</a></li>';
      }
  }

  $str.='</ul>';

  return $str;
}


function other_article($id)
{
  $ci=&get_instance();
  $query = $ci->db->query("SELECT
                              trans_news_category.id_news_category,
                              trans_news_category.id_category,
                              trans_news_category.id_news,
                              trans_news_category.delete,
                              news.id_news,
                              news.title,
                              news.slug,
                              news.description,
                              news.image,
                              news.created_at,
                              category.id_category,
                              category.category
                            FROM
                              trans_news_category
                            INNER JOIN
                              news ON trans_news_category.id_news = news.id_news
                            INNER JOIN
                              category ON trans_news_category.id_category = category.id_category
                            WHERE
                              trans_news_category.delete = '0' AND
                              trans_news_category.id_news != $id
                            ORDER BY
                              news.title ASC
                            LIMIT 4");

  $str = "";
  foreach ($query->result() as $news) {

    if ($news->image!="") {
      $image_post = base_url("temp/img_manager/news/thumbs/$news->image");
    }else {
      $image_post = base_url("temp/default.png");
    }

  $str.='<div class="col-12 col-sm-6 col-md-3">
            <div class="card card-widget">
              <div class="card-img">
                <a href="'.site_url("news/detail/$news->id_news/$news->slug").'">
                  <div class="other-article-img" style="background:url('.$image_post.')"></div>
                </a>
              </div>
              <div class="card-block">
                <h4 class="card-title"><a href="'.site_url("news/detail/$news->id_news/$news->slug").'">'.substr($news->title,0,50).'...</a></h4>
                <div class="card-meta"><span><i class="fa fa-clock-o"></i> '.date('d M Y',strtotime($news->created_at)).'</span></div>
                <p>'.substr(strip_tags($news->description),0,100).'...</p>
              </div>
            </div>
          </div>';
  }

  return $str;
}
