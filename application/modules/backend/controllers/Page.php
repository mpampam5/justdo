<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/* modules/backend/controllers/Page.php */
/* MPAMPAM CRUD GENERATOR */
/* PENGEMBANG : MPAMPAM */
/* EMAIL : MPAMPAM5@GMAIL.COM */
/* FACEBOOK : https://www.facebook.com/mpampam */
/* DIBUAT OLEH MPAMPAM CRUD GENERTOR 2019-05-24 02:03:42 */
/* https://mpampam.com */
/* DI GUNAKAN OLEH USER Muhammad ippank */


class Page extends Backend{

	private $table = "page";

	public function __construct()
  {
    parent::__construct();
    $this->load->library(array("datatables"));
    $this->load->model("Page_model","model");
  }


	function _rules()
	{
		$this->form_validation->set_rules("title","Title","trim|xss_clean|max_length[150]|required");
		$this->form_validation->set_rules("deskripsi","Deskripsi","trim|xss_clean|required");
		$this->form_validation->set_rules("image","Image","trim|xss_clean|max_length[100]");
		$this->form_validation->set_error_delimiters('<p class="form-text text-danger">','</p>');
	}


	function index()
  {
    $this->temp_backend->set_title('Halaman');
    $this->temp_backend->view('content/page/index');
  }


	function json()
  {
    header('Content-Type: application/json');
    echo $this->model->json();
  }


	function detail($id)
  {
    if ($row = $this->model->get_where($this->table,['id_halaman'=>$id])) {
      	$this->temp_backend->set_title('Halaman');
        $data = [
									'title'	=>	$row->title,
									'slug'	=>	$row->slug,
									'deskripsi'	=>	$row->deskripsi,
									'image'	=>	$row->image,
								];
      $this->temp_backend->view('content/page/detail',$data);
    }else {
      $this->_error404();
    }
  }


function add()
{
    $this->temp_backend->set_title('Halaman');
      $data = [
                'button' => 'tambah',
                'action' => site_url('backend/page/add_action'),
								'title'	=>	set_value('title'),
								'deskripsi'	=>	set_value('deskripsi'),
								'image'	=>	set_value('image'),
							];

    $this->temp_backend->view('content/page/form',$data);
}


function add_action()
{
  if ($this->input->is_ajax_request()) {
      $json = array('success'=>false, 'alert'=>array());
      $this->_rules();
      if ($this->form_validation->run()) {
        $insert = [
										'title'	=>	$this->input->post('title',true),
										'slug'	=>	url_title($this->input->post('title'),'dash',true),
										'deskripsi'	=>	$this->input->post('deskripsi',true),
										'image'	=>	$this->input->post('image',true),
										'created_at'	=>	date('Y-m-d h:i:s'),
									];

        if ($this->model->get_insert($this->table,$insert)) {
          $json['alert']   = '<div id="alert" class="alert alert-success">
                                <i class="fa fa-check"></i> Berhasil Menambahkan.
                              <div>';
        }else {
          $json['alert']   = '<div id="alert" class="alert alert-danger">
                                <i class="fa fa-close"></i> Gagal Menambahkan.
                              <div>';
        }

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
  if ($row = $this->model->get_where($this->table,['id_halaman'=>$id])) {
    $this->temp_backend->set_title('Halaman');

      $data = [
                'button' => 'edit',
                'action' => site_url('backend/page/update_action/'.$id),
								'title'	=>	set_value('title',$row->title),
								'deskripsi'	=>	set_value('deskripsi',$row->deskripsi),
								'image'	=>	set_value('image',$row->image),
							];

    $this->temp_backend->view('content/page/form',$data);
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
										'deskripsi'	=>	$this->input->post('deskripsi',true),
										'image'	=>	$this->input->post('image',true),
										'update_at'	=>	date('Y-m-d h:i:s'),
									];

        if ($this->model->get_update($this->table,$update,["id_halaman"=>$id])) {
          $json['alert']   = '<div id="alert" class="alert alert-success">
                                <i class="fa fa-check"></i> Berhasil Mengedit.
                              <div>';
        }else {
          $json['alert']   = '<div id="alert" class="alert alert-danger">
                                <i class="fa fa-close"></i> Gagal Mengedit.
                              <div>';
        }

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
    if ($this->model->get_update($this->table,["delete"=>"1"],["id_halaman"=>$id])) {
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




} //End Class Page
