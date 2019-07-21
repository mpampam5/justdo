<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home_model extends CI_Model{

  function news()
  {
    $query = $this->db->query("SELECT
                              	trans_news_category.id_news_category,
                              	trans_news_category.id_category,
                              	trans_news_category.id_news,
                                trans_news_category.headline,
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
                              	INNER JOIN news ON trans_news_category.id_news = news.id_news
                              	INNER JOIN category ON trans_news_category.id_category = category.id_category
                              WHERE
                              	trans_news_category.delete = '0'
                                AND
                                trans_news_category.headline != 1
                              ORDER BY
                                trans_news_category.id_news_category DESC
                              LIMIT 4");
    return $query;
  }

  function headline_news()
  {
    $query = $this->db->query("SELECT
                              	trans_news_category.id_news_category,
                              	trans_news_category.id_category,
                              	trans_news_category.id_news,
                                trans_news_category.headline,
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
                              	INNER JOIN news ON trans_news_category.id_news = news.id_news
                              	INNER JOIN category ON trans_news_category.id_category = category.id_category
                              WHERE
                              	trans_news_category.delete = '0'
                                AND
                                trans_news_category.headline = 1
                              ORDER BY
                                trans_news_category.id_news_category DESC");
    return $query;
  }

}
