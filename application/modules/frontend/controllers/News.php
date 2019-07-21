<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class news extends Front{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('News_model','model');
  }

  function index()
  {
    $this->template->set_title('Article | '.setting('title'));
    //meta seo
    $this->meta_tags->set_meta_tag('description', setting('title').' '.setting('alamat'));
    // *$this->meta_tags->unset_meta_tag('author');
    // * $this->meta_tags->add_robots_rule('NOINDEX');
    // * $this->meta_tags->add_keyword('php');
    //end meta seo
    $data = [
              'cat' => $this->model->category()->result()
            ];
    $this->template->view('news/index',$data);
  }


  function json_pagination(){
    $this->load->library("pagination");
    $config = array();
    $config["base_url"] = "#";
    $config["total_rows"] = $this->model->news_total_count();
    $config["per_page"] =6;
    $config["uri_segment"] = 3;
    $config["use_page_numbers"] = TRUE;
    $config["full_tag_open"] = '<ul class="pagination">';
    $config["full_tag_close"] = '</ul>';
    $config["first_tag_open"] = '<li class="page-item">';
    $config["first_tag_close"] = '</li>';
    $config["last_tag_open"] = '<li class="page-item">';
    $config["last_tag_close"] = '</li>';
    $config['next_link'] = 'next';
    $config["next_tag_open"] = '<li class="page-item">';
    $config["next_tag_close"] = '</li>';
    $config["prev_link"] = "prev";
    $config["prev_tag_open"] = "<li class='page-item'>";
    $config["prev_tag_close"] = "</li>";
    $config["cur_tag_open"] = '<li class="page-item active"><a href="#">';
    $config["cur_tag_close"] = "</a></li>";
    $config["num_tag_open"] = "<li class='page-item'>";
    $config["num_tag_close"] = "</li>";
    $config["num_links"] = 1;
    $this->pagination->initialize($config);
    $page = $this->uri->segment(3);
    $start = ($page - 1) * $config["per_page"];

    $output = array(
                     'pagination_link'  => $this->pagination->create_links(),
                     'data'   => $this->model->fetch_detail($config["per_page"], $start)
                    );

    echo json_encode($output);
  }



  function detail($id,$slug)
  {

    if ($row = $this->model->news_detail($id,$slug)->row()) {
      $this->template->set_title('Article | '.$row->title);
      $this->meta_tags->set_meta_tag('description', setting('title').' '.setting('alamat'));
      // *$this->meta_tags->unset_meta_tag('author');
      // * $this->meta_tags->add_robots_rule('NOINDEX');
      // * $this->meta_tags->add_keyword('php');
      //end meta seo
      $data = [
                'news' => $row
              ];
      $this->template->view('news/detail',$data);
    }else {
      $this->_error404();
    }
  }


















}//end class
