<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/* modules/backend/controllers/Media_foto.php */
/* MPAMPAM CRUD GENERATOR */
/* PENGEMBANG : MPAMPAM */
/* EMAIL : MPAMPAM5@GMAIL.COM */
/* FACEBOOK : https://www.facebook.com/mpampam */
/* DIBUAT OLEH MPAMPAM CRUD GENERTOR 2019-07-11 14:52:28 */
/* https://mpampam.com */
/* DI GUNAKAN OLEH USER  */


class Media_foto extends Backend{

	private $table = "media_foto";

	public function __construct()
  {
    parent::__construct();
    $this->load->library(array("datatables"));
    $this->load->model("Media_foto_model","model");
  }


	function _rules()
	{
		$this->form_validation->set_rules("image_name","Title","trim|xss_clean|max_length[255]|required");
		$this->form_validation->set_rules("image","Gambar","trim|xss_clean|max_length[255]|required");
		$this->form_validation->set_rules("description","Deskripsi","trim|xss_clean");
		$this->form_validation->set_error_delimiters('<p class="form-text text-danger">','</p>');
	}


	function index()
  {
    $this->temp_backend->set_title('Foto');
    $this->temp_backend->view('content/media_foto/index');
  }


	function json()
  {
    header('Content-Type: application/json');
    echo $this->model->json();
  }


	function detail($id)
  {
    if ($row = $this->model->get_where($this->table,['id'=>$id])) {
      	$this->temp_backend->set_title('Foto');
        $data = [
									'image_name'	=>	$row->image_name,
									'image'	=>	$row->image,
									'description'	=>	$row->description,
								];
      $this->temp_backend->view('content/media_foto/detail',$data);
    }else {
      $this->_error404();
    }
  }


function add()
{
    $this->temp_backend->set_title('Foto');
      $data = [
                'button' => 'tambah',
                'action' => site_url('backend/media_foto/add_action'),
								'image_name'	=>	set_value('image_name'),
								'image'	=>	set_value('image'),
								'description'	=>	set_value('description'),
							];

    $this->temp_backend->view('content/media_foto/form',$data);
}


function add_action()
{
  if ($this->input->is_ajax_request()) {
      $json = array('success'=>false, 'alert'=>array());
      $this->_rules();
      if ($this->form_validation->run()) {
        $insert = [
										'image_name'	=>	$this->input->post('image_name',true),
										'image'	=>	$this->input->post('image',true),
										'description'	=>	$this->input->post('description',true),
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
  if ($row = $this->model->get_where($this->table,['id'=>$id])) {
    $this->temp_backend->set_title('Foto');

      $data = [
                'button' => 'edit',
                'action' => site_url('backend/media_foto/update_action/'.$id),
								'image_name'	=>	set_value('image_name',$row->image_name),
								'image'	=>	set_value('image',$row->image),
								'description'	=>	set_value('description',$row->description),
							];

    $this->temp_backend->view('content/media_foto/form',$data);
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
										'image_name'	=>	$this->input->post('image_name',true),
										'image'	=>	$this->input->post('image',true),
										'description'	=>	$this->input->post('description',true),
										'created_at'	=>	$this->input->post('created_at',true),
										'update_at'	=>	date('Y-m-d h:i:s'),
									];

        if ($this->model->get_update($this->table,$update,["id"=>$id])) {
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
    if ($this->model->get_delete($this->table,["id"=>$id])) {
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




} //End Class Media_foto
