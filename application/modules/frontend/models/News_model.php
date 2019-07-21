<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News_model extends CI_Model{



  function category()
  {
    return $this->db->select("*")
                    ->from("category")
                    ->where("delete",'0')
                    ->order_by("category","ASC")
                    ->get();
  }


  function news_total_count()
  {
    return  $this->db->query("SELECT
                                trans_news_category.id_news_category,
                                trans_news_category.id_category,
                                trans_news_category.id_news,
                                trans_news_category.delete,
                                news.id_news,
                                category.id_category
                              FROM
                                trans_news_category
                                INNER JOIN news ON trans_news_category.id_news = news.id_news
                                INNER JOIN category ON trans_news_category.id_category = category.id_category
                              WHERE
                                trans_news_category.delete = '0'")
                                ->num_rows();
  }


  function fetch_detail($start,$limit)
  {
    $output = '';
    $query = $this->db->select("trans_news_category.id_news_category,
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
                                category.category")
                      ->from("trans_news_category")
                      ->join("news","trans_news_category.id_news = news.id_news")
                      ->join("category","trans_news_category.id_category = category.id_category")
                      ->where("trans_news_category.delete",'0')
                      ->order_by("id_news_category", "DESC")
                      ->limit($start,$limit)
                      ->get();

    foreach($query->result() as $row)
    {

          if ($row->image!="") {
            $image_post = base_url("temp/img_manager/news/thumbs/$row->image");
          }else {
            $image_post = base_url("temp/default.png");
          }


     $output .= '<div class="post post-md">
                   <div class="post-thumbnail">
                     <a href="'.site_url("news/detail/$row->id_news/$row->slug").'">
                     <div class="image-post" style="background:url('.$image_post.')"></div>
                     </a>
                   </div>
                   <div class="post-block">
                     <h2 class="post-title"><a href="'.site_url("news/detail/$row->id_news/$row->slug").'" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="'.$row->title.'">'.substr($row->title,0,85).'</a></h2>
                     <div class="post-meta">
                     <span><i class="fa fa-clock-o"></i> '.date('d M Y',strtotime($row->created_at)).'</span>
                     <span><i class="fa fa-tags"></i> '.$row->category.'</span>
                     <span><i class="fa fa-user"></i> Admin</a></span>
                     </div>
                     '.substr(strip_tags($row->description),0,100).'<a href="'.site_url("news/detail/$row->id_news/$row->slug").'" class="text-warning">[Read More]</a>
                   </div>
                 </div>';
    }

    return $output;
  }


  function news_detail($id,$slug)
  {
    $query = $this->db->query("SELECT
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
                                trans_news_category.id_news = $id AND
                                news.slug = '$slug'
                                ");
    return $query;
  }







} //end model
