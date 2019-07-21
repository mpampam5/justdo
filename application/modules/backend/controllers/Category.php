<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/* modules/backend/controllers/Category.php */
/* MPAMPAM CRUD GENERATOR */
/* PENGEMBANG : MPAMPAM */
/* EMAIL : MPAMPAM5@GMAIL.COM */
/* FACEBOOK : https://www.facebook.com/mpampam */
/* DIBUAT OLEH MPAMPAM CRUD GENERTOR 2019-05-17 15:33:30 */
/* https://mpampam.com */
/* DI GUNAKAN OLEH USER Muhammad ippank */


class Category extends Backend{

	private $table = "category";

	public function __construct()
  {
    parent::__construct();
    $this->load->library(array("datatables"));
    $this->load->model("Category_model","model");
  }


	function _rules()
	{
		$this->form_validation->set_rules("category","Kategori","trim|xss_clean|max_length[100]|required");
		$this->form_validation->set_error_delimiters('<smal class="form-text text-danger text-muted">','</small>');
	}


	function index()
  {
    $this->temp_backend->set_title('Kategori');
    $this->temp_backend->view('content/category/index');
  }


	function json()
  {
    header('Content-Type: application/json');
    echo $this->model->json();
  }


	function detail($id)
  {
    if ($row = $this->model->get_where($this->table,['id_category'=>$id])) {
      	$this->temp_backend->set_title('Kategori');
        $data = [
									'category'	=>	$row->category,
								];
      $this->temp_backend->view('content/category/detail',$data);
    }else {
      $this->_error404();
    }
  }


function add()
{
    $this->temp_backend->set_title('Kategori');
      $data = [
                'button' => 'tambah',
                'action' => site_url('backend/category/add_action'),
								'category'	=>	set_value('category'),
							];

    $this->temp_backend->view('content/category/form',$data);
}


function add_action()
{
  if ($this->input->is_ajax_request()) {
      $json = array('success'=>false, 'alert'=>array());
      $this->_rules();
      if ($this->form_validation->run()) {
        if ($row = $this->model->get_where($this->table, ['category' => ucwords($this->input->post('category',true))])) {
            $this->model->get_update($this->table,['delete'=>'0'],["id_category"=>$row->id_category]);
            $json['alert']   = '<div id="alert" class="alert alert-success">
                                  <i class="fa fa-check"></i> Berhasil Menambahkan.
                                <div>';
        }else {
          $insert = [
  										'category'	=>	ucwords($this->input->post('category',true)),
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
  if ($row = $this->model->get_where($this->table,['id_category'=>$id])) {
    $this->temp_backend->set_title('Kategori');

      $data = [
                'button' => 'edit',
                'action' => site_url('backend/category/update_action/'.$id),
								'category'	=>	set_value('category',$row->category),
							];

    $this->temp_backend->view('content/category/form',$data);
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
										'category'	=>	ucwords($this->input->post('category',true)),
										'update_at'	=>	date('Y-m-d h:i:s'),
									];

        if ($this->model->get_update($this->table,$update,["id_category"=>$id])) {
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
    if ($this->model->get_update($this->table,['delete'=>'1'],["id_category"=>$id])) {
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




} //End Class Category
