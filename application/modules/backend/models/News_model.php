<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/* modules/backend/models/News_model.php */
/* MPAMPAM CRUD GENERATOR */
/* PENGEMBANG : MPAMPAM */
/* EMAIL : MPAMPAM5@GMAIL.COM */
/* FACEBOOK : https://www.facebook.com/mpampam */
/* DIBUAT OLEH MPAMPAM CRUD GENERTOR 2019-05-17 15:29:24 */
/* https://mpampam.com */
/* DI GUNAKAN OLEH USER Muhammad ippank */


class News_model extends MY_Model{

	private $table = "news";


	function json()
	{
		$this->datatables->select('trans_news_category.id_news_category,
                              trans_news_category.id_category AS id_category_trans,
                              trans_news_category.id_news AS id_news_trans,
															trans_news_category.headline AS headline,
															trans_news_category.delete,
                              category.id_category,
                              category.category AS category,
                              news.id_news AS id_news,
                            	news.title AS title,
                              news.slug AS slug,
                              DATE_FORMAT(news.created_at,"%d/%m/%Y %h:%i") AS created_at');
		$this->datatables->from("trans_news_category");
    $this->datatables->join('category','trans_news_category.id_category=category.id_category');
    $this->datatables->join('news','trans_news_category.id_news=news.id_news');
		$this->datatables->where('trans_news_category.delete','0');
    $this->datatables->add_column('action',
                                  '<a href="'.site_url("backend/news/headline/$1").'" id="$1" class="headline btn btn-link p-a-5 text-warning" data-toggle="tooltip" data-placement="bottom" title="Tetapkan Headline"><i class="fa fa-star"></i></a>
                                  <a href="'.site_url("backend/news/update/$1").'" id="update" class="btn btn-link p-a-5 text-info" data-toggle="tooltip" data-placement="bottom" title="Edit"><i class="fa fa-pencil"></i></a>
                                  <a href="'.site_url("backend/news/delete/$1").'" id="hapus" class="btn btn-link p-a-5 text-danger" data-toggle="tooltip" data-placement="bottom" title="Hapus"><i class="fa fa-trash"></i></a>',
                                  'id_news_category');
    return $this->datatables->generate();
	}


	function news_where($where)
	{
		return $this->db->select("trans_news_category.id_news_category,
                              trans_news_category.id_category AS id_category_trans,
                              trans_news_category.id_news AS id_news_trans,
                              category.id_category,
                              category.category AS category,
                              news.id_news AS id_news,
                            	news.title AS title,
                              news.slug AS slug,
															news.description AS description,
															news.image AS image")
										->from("trans_news_category")
										->join('category','trans_news_category.id_category=category.id_category')
										->join('news','trans_news_category.id_news=news.id_news')
										->where($where)
										->where('trans_news_category.delete','0')
										->get()
										->row();
	}




} /*End Class News_model*/
