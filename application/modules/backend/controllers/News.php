<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/* modules/backend/controllers/News.php */
/* MPAMPAM CRUD GENERATOR */
/* PENGEMBANG : MPAMPAM */
/* EMAIL : MPAMPAM5@GMAIL.COM */
/* FACEBOOK : https://www.facebook.com/mpampam */
/* DIBUAT OLEH MPAMPAM CRUD GENERTOR 2019-05-17 15:29:24 */
/* https://mpampam.com */
/* DI GUNAKAN OLEH USER Muhammad ippank */


class News extends Backend{

	private $table = "news";

	public function __construct()
  {
    parent::__construct();
    $this->load->library(array("datatables"));
    $this->load->model("News_model","model");
  }


	function _rules()
	{
		$this->form_validation->set_rules("title","Title","trim|xss_clean|max_length[200]|required");
		$this->form_validation->set_rules("id_category","Kategori","trim|xss_clean|required|numeric");
		$this->form_validation->set_rules("image","Gambar","trim|xss_clean");
		$this->form_validation->set_rules("description","Description","trim|xss_clean|required");
		$this->form_validation->set_error_delimiters('<smal class="form-text text-danger text-muted">','</small>');
	}


	function index()
  {
    $this->temp_backend->set_title('Post');
    $this->temp_backend->view('content/news/index');
  }


	function json()
  {
    header('Content-Type: application/json');
    echo $this->model->json();
  }


	function detail($id)
  {
    if ($row = $this->model->get_where($this->table,['id_news'=>$id])) {
      	$this->temp_backend->set_title('Post');
        $data = [
									'title'	=>	$row->title,
									'slug'	=>	$row->slug,
									'description'	=>	$row->description,
									'image'	=>	$row->image,
									'created_at'	=>	$row->created_at,
									'update_at'	=>	$row->update_at,
								];
      $this->temp_backend->view('content/news/detail',$data);
    }else {
      $this->_error404();
    }
  }


function add()
{
    $this->temp_backend->set_title('Post');
      $data = [
                'button' => 'tambah',
                'action' => site_url('backend/news/add_action'),
								'title'	=>	set_value('title'),
								'slug'	=>	set_value('slug'),
								'id_category'=>set_value('id_category'),
								'description'	=>	set_value('description'),
								'image'	=>	set_value('image'),
								'created_at'	=>	set_value('created_at'),
								'update_at'	=>	set_value('update_at'),
							];

    $this->temp_backend->view('content/news/form',$data);
}


function add_action()
{
  if ($this->input->is_ajax_request() == true) {
		$this->load->helper('file');
      $json = array('success'=>false, 'alert'=>array());
			$this->form_validation->set_rules("image","","callback_file_check");
      $this->_rules();
      if ($this->form_validation->run()) {



						$insert = [
												'title'	=>	$this->input->post('title',true),
												'slug'	=>	url_title($this->input->post('title'),'dash',true),
												'description'	=>	$this->input->post('description'),
												'image'	=>	$this->input->post('image',true),
												'created_at'	=>	date('Y-m-d h:i:s'),
											];

		     $this->model->get_insert($this->table,$insert);
				 $news_id = $this->db->insert_id();
				 $insert_trans = [
					 									"id_category" => $this->input->post("id_category"),
														"id_news"	=> $news_id
				 									];
				 $this->model->get_insert("trans_news_category",$insert_trans);

		     $json['alert']   = '<div id="alert" class="alert alert-success">
		                             <i class="fa fa-check"></i> Berhasil Menambahkan.
		                          <div>';

        $json['success'] = true;

      }else {
        foreach ($_POST as $key => $value)
          {
            $json['alert'][$key] = form_error($key);
          }
      }

      echo json_encode($json);
  }
}


function update($id)
{
  if ($row = $this->model->news_where(['id_news_category'=>$id])) {
    $this->temp_backend->set_title('Post');

      $data = [
                'button' => 'edit',
                'action' => site_url('backend/news/update_action/'.$row->id_news),
								'title'	=>	set_value('title',$row->title),
								'slug'	=>	set_value('slug',$row->slug),
								'id_category'=>set_value('id_category',$row->id_category),
								'description'	=>	set_value('description',$row->description),
								'image'	=>	set_value('image',$row->image),
							];

    $this->temp_backend->view('content/news/form',$data);
  }else {
    $this->_error404();
  }
}


function update_action($id)
{
  if ($this->input->is_ajax_request()) {
      $json = array('success'=>false, 'alert'=>array());
      $this->_rules();
      if ($this->form_validation->run()) {


        $update = [
										'title'	=>	$this->input->post('title',true),
										'slug'	=>	url_title($this->input->post('title'),'dash',true),
										'description'	=>	$this->input->post('description'),
										'image'	=>	$this->input->post('image',true),
										'update_at'	=>	date('Y-m-d h:i:s'),
									];

      $this->model->get_update($this->table,$update,["id_news"=>$id]);
			$update_trans = [
												 "id_category" => $this->input->post("id_category"),
											 ];
			$this->model->get_update("trans_news_category",$update_trans,["id_news"=>$id]);
      $json['alert']   = '<div id="alert" class="alert alert-success">
                            <i class="fa fa-check"></i> Berhasil Mengedit.
                          <div>';

        $json['success'] = true;
      }else {
        foreach ($_POST as $key => $value)
          {
            $json['alert'][$key] = form_error($key);
          }
      }

      echo json_encode($json);
  }
}


function delete($id)
{
  if ($this->input->is_ajax_request()) {
    if ($this->model->get_update("trans_news_category",['delete'=>'1'],["id_news_category"=>$id])) {
      $json['alert']   = '<div id="alert" class="alert alert-success">
                            <i class="fa fa-check"></i> Berhasil Menghapus.
                          <div>';
    }else {
      $json['alert']   = '<div id="alert" class="alert alert-danger">
                            <i class="fa fa-close"></i> Gagal Menghapus.
                          <div>';
    }
    echo json_encode($json);
  }
}


function headline($id)
{
	if ($this->input->is_ajax_request()) {
		if ($this->input->post('headline')=='1') {
			$headline = '0';
		}else{
			$headline = '1';
		}
		if ($this->model->get_update("trans_news_category",['headline'=>$this->input->post('headline')],["id_news_category"=>$id])) {
			$json['success'] = true;
		}else{
			$json['success'] = false;
		}
		$json['headline'] = $headline;

		echo json_encode($json);
	}
}







} //End Class News
