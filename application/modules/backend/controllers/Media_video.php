<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/* modules/backend/controllers/Media_video.php */
/* MPAMPAM CRUD GENERATOR */
/* PENGEMBANG : MPAMPAM */
/* EMAIL : MPAMPAM5@GMAIL.COM */
/* FACEBOOK : https://www.facebook.com/mpampam */
/* DIBUAT OLEH MPAMPAM CRUD GENERTOR 2019-06-21 03:27:32 */
/* https://mpampam.com */
/* DI GUNAKAN OLEH USER Muhammad ippank */
    

class Media_video extends Backend{
    
	private $table = "media_video";
    
	public function __construct()
  {
    parent::__construct();
    $this->load->library(array("datatables"));
    $this->load->model("Media_video_model","model");
  }


	function _rules()
	{
		$this->form_validation->set_rules("judul","Judul","trim|xss_clean|required");
		$this->form_validation->set_rules("slug","Slug","trim|xss_clean|max_length[200]");
		$this->form_validation->set_rules("keterangan","Keterangan","trim|xss_clean");
		$this->form_validation->set_error_delimiters('<p class="form-text text-danger">','</p>');
	}


	function index()
  {
    $this->temp_backend->set_title('Video');
    $this->temp_backend->view('content/media_video/index');
  }


	function json()
  {
    header('Content-Type: application/json');
    echo $this->model->json();
  }


	function detail($id)
  {
    if ($row = $this->model->get_where($this->table,['id'=>$id])) {
      	$this->temp_backend->set_title('Video');
        $data = [
									'judul'	=>	$row->judul,
									'slug'	=>	$row->slug,
									'url'	=>	$row->url,
									'keterangan'	=>	$row->keterangan,
									'created_at'	=>	$row->created_at,
									'update_at'	=>	$row->update_at,
								];
      $this->temp_backend->view('content/media_video/detail',$data);
    }else {
      $this->_error404();
    }
  }


function add()
{
    $this->temp_backend->set_title('Video');
      $data = [
                'button' => 'tambah',
                'action' => site_url('backend/media_video/add_action'),
								'judul'	=>	set_value('judul'),
								'url'	=>	set_value('url'),
								'keterangan'	=>	set_value('keterangan'),
							];

    $this->temp_backend->view('content/media_video/form',$data);
}


function add_action()
{
  if ($this->input->is_ajax_request()) {
      $json = array('success'=>false, 'alert'=>array());
      $this->_rules();
      if ($this->form_validation->run()) {
        $insert = [
										'judul'	=>	$this->input->post('judul',true),
										'slug'	=>	url_title($this->input->post('judul'),'dash',true),
										'url'	=>	$this->input->post('url',true),
										'keterangan'	=>	$this->input->post('keterangan',true),
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
    $this->temp_backend->set_title('Video');

      $data = [
                'button' => 'edit',
                'action' => site_url('backend/media_video/update_action/'.$id),
								'judul'	=>	set_value('judul',$row->judul),
								'url'	=>	set_value('url',$row->url),
								'keterangan'	=>	set_value('keterangan',$row->keterangan),
							];

    $this->temp_backend->view('content/media_video/form',$data);
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
										'judul'	=>	$this->input->post('judul',true),
										'slug'	=>	url_title($this->input->post('judul'),'dash',true),
										'url'	=>	$this->input->post('url',true),
										'keterangan'	=>	$this->input->post('keterangan',true),
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




} //End Class Media_video