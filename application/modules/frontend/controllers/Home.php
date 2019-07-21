<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Front{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Home_model','model');
  }

  function index()
  {
    $this->template->set_title(''.setting('title'));
    //meta seo
    $this->meta_tags->set_meta_tag('description', setting('title').' '.setting('alamat').'.Telepon '.setting('telepon'));
    // *$this->meta_tags->unset_meta_tag('author');
    // * $this->meta_tags->add_robots_rule('NOINDEX');
    // * $this->meta_tags->add_keyword('php');
    //end meta seo
    $data = [
              'news' => $this->model->news()->result(),
              'headline_news' => $this->model->headline_news()
            ];
    $this->template->view('home/index',$data);
  }

}
