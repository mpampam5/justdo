<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menus extends Backend{

  private $table = "menus";

  public function __construct()
  {
    parent::__construct();
    $this->load->model('backend/Menus_model','model');
  }

  function _rules()
  {
     $this->form_validation->set_rules("name","Nama Menu","trim|required|xss_clean");
     $this->form_validation->set_rules("url","Url","trim|required|xss_clean");
     $this->form_validation->set_rules("is_parent","Parent","trim|required|xss_clean");
     $this->form_validation->set_rules("is_active","Aktif","trim|required|xss_clean");
     $this->form_validation->set_rules("icon","Icon","trim|required|xss_clean");
     $this->form_validation->set_rules("description","Deskripsi","trim|xss_clean");
     $this->form_validation->set_error_delimiters('<small class="form-text"><b class="text-danger">','</b></small>');
 }

  function index()
  {
    //mpampam
    $data['query'] = $this->model->get_data();
    $this->temp_backend->set_title('menu');
    $this->temp_backend->view('backend/menu/index',$data);
  }

  function save()
 {
   $data = json_decode($_POST['data']);
   $readbleArray = $this->parseJsonArray($data);

     $i=0;
     foreach($readbleArray as $row){
       $i++;
       $this->db->query("update menus set is_parent = '".$row['parentID']."', sort = '".$i."' where id = '".$row['id']."' ");
     }
   }



   function parseJsonArray($jsonArray, $parentID = 0)
   {
     $return = array();
     foreach ($jsonArray as $subArray) {
         $returnSubSubArray = array();
         if (isset($subArray->children)) {
         $returnSubSubArray = $this->parseJsonArray($subArray->children, $subArray->id);
       }

       $return[] = array('id' => $subArray->id, 'parentID' => $parentID);
       $return = array_merge($return, $returnSubSubArray);
     }
       return $return;
 }




function tambah($status="")
{
  if ($status=="aksi") {
    if ($this->input->is_ajax_request()) {
      $json = array('success'=>false, 'alert'=>array());
        $this->_rules();
          if ($this->form_validation->run()) {
            $insert = array('name' => $this->input->post('name',true),
                            'url' => $this->input->post('url',true),
                            'icon' => $this->input->post('icon',true),
                            'description' => $this->input->post('name',true),
                            'is_active' => $this->input->post('is_active',true),
                            'is_parent' => $this->input->post('is_parent',true)
                            );
            $this->model->get_insert($this->table,$insert);
            $json['alert'] = "Berhasi Menyimpan!";
            $json['success'] = true;
          }else {
            foreach ($_POST as $key => $value) {
                $json['alert'][$key] = form_error($key);
               }
          }
        echo json_encode($json);
      }
  }else {
    $this->temp_backend->set_title('Menu');
    $data = array('button' => "tambah",
                  'action'   => site_url("backend/menus/tambah/aksi"),
                  'name' => set_value("name"),
                  'url' => set_value("url"),
                  'icon'=> set_value("icon"),
                  'description' => set_value('description'),
                  'is_parent' => set_value('is_parent'),
                  'is_active'=> set_value('is_active')
                  );
    $this->temp_backend->view('backend/menu/form',$data);
  }
}


function edit($id,$status="")
{
  if ($status=="aksi") {
    if ($this->input->is_ajax_request()) {
      $json = array('success'=>false, 'alert'=>array());
        $this->_rules();
          if ($this->form_validation->run()) {
            $update = array('name' => $this->input->post('name',true),
                            'url' => $this->input->post('url',true),
                            'icon' => $this->input->post('icon',true),
                            'description' => $this->input->post('name',true),
                            'is_active' => $this->input->post('is_active',true),
                            'is_parent' => $this->input->post('is_parent',true)
                            );
            $this->model->get_update($this->table,$update,['id'=>$id]);
            $json['alert'] = "Berhasi Mengubah!";
            $json['success'] = true;
          }else {
            foreach ($_POST as $key => $value) {
                $json['alert'][$key] = form_error($key);
               }
          }
        echo json_encode($json);
      }
  }else {
    if ($row = $this->model->get_where($this->table,['id'=>$id])) {
      $this->temp_backend->set_title('Menu');
      $data = array('button' => "edit",
                    'action' => site_url("backend/menus/edit/$id/aksi"),
                    'name' => set_value("name",$row->name),
                    'url' => set_value("url",$row->url),
                    'icon'=> set_value("icon",$row->icon),
                    'description' => set_value('description',$row->description),
                    'is_parent' => set_value('is_parent',$row->is_parent),
                    'is_active'=> set_value('is_active',$row->is_active)
                    );
      $this->temp_backend->view('backend/menu/form',$data);
    }else {
      $this->_error404();
    }

  }
}

function hapus($id)
{
  if ($this->input->is_ajax_request()) {
      if ($this->model->get_delete($this->table,['id'=>$id])) {
          $this->model->get_update($this->table,['is_parent'=>"0"],['is_parent'=>$id]);
        $json['alert_class'] = "alert-success";
        $json['alert'] = '<i class="fa fa-check"></i>  Berhasil Menghapus!';
      }else {
        $json['alert_class'] = "alert-danger";
        $json['alert'] = '<i class="fa fa-close"></i> Gagal Menghapus!';
      }
      echo json_encode($json);
  }
}

function icon()
{
  $this->temp_backend->view('backend/backend/menu/icons',[],false);
}




}
