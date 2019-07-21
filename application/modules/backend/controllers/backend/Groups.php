<?php defined('BASEPATH') OR exit('No direct script access allowed');
/* modules/backend/controllers/Groupss.php */
/* MPAMPAM CRUD GENERATOR */
/* PENGEMBANG : MPAMPAM */
/* EMAIL : MPAMPAM5@GMAIL.COM */
/* FACEBOOK : https://www.facebook.com/mpampam */
/* DIBUAT OLEH MPAMPAM CRUD GENERTOR 2019-05-14 03:51:43 */
/* https://mpampam.com */

class Groups extends Backend{

  private $table = "groups";

  public function __construct()
  {
    parent::__construct();
    $this->load->library(array('datatables'));
    $this->load->model('backend/Groups_model','model');
  }

  function _rules()
  {
     $this->form_validation->set_rules("description","Deskripsi","trim|xss_clean");
     $this->form_validation->set_rules("field","Menu Akses","trim|xss_clean|required");
     $this->form_validation->set_error_delimiters('<small class="form-text"><b class="text-danger">','</b></small>');
   }

  function index()
  {
    $this->temp_backend->set_title('Group');
    $this->temp_backend->view('backend/groups/index');
  }


  function json()
  {
    header('Content-Type: application/json');
    echo $this->model->json();
  }


  function detail($id)
  {
    if ($row = $this->model->get_where($this->table,["id_groups"=>$id])) {
        $this->load->helper(array('menugroup'));
        $data = [
                  "sub_title"   => "detail",
                  "id_groups"   => $id,
                  "name"        => $row->name,
                  "description" => $row->description
                ];
        $this->temp_backend->set_title('Group');
        $this->temp_backend->view('backend/groups/detail',$data);
    }else {
      $this->_error404();
    }
  }


  function tambah($aksi=null)
  {
    if ($aksi!=null) {
      if ($this->input->is_ajax_request()) {
        $json = array('success'=>false, 'alert'=>array());
        // rules
        $this->form_validation->set_rules("group","Group","trim|required|xss_clean|callback__cekGroup");
        $this->_rules();
        // end rules
        if ($this->form_validation->run()) {
          $insert_group = [
                            "name" => $this->input->post('group',true),
                            "description"=> $this->input->post('description',true)
                          ];
          $this->model->get_insert($this->table,$insert_group);
          $id_group =  $this->db->insert_id();
          $akses = $this->input->post("akses");
            foreach ($akses as $key)
            {
              $data = [
                        'id_groups'  => $id_group,
                        'id_menus' => $key
                      ];
              $this->model->get_insert('groups_menus',$data);
            }

          $json['alert'] = "Berhasil Menyimpan!";
          $json['success'] = true;
        }else {
          foreach ($_POST as $key => $value)
            {
              $json['alert'][$key] = form_error($key);
            }
        }
        echo json_encode($json);
      }
    }else {
      $this->load->helper(array('menugroup'));
      $this->temp_backend->set_title('Group');
      $data = [
                "button"      => "tambah",
                "aksi"        => site_url('backend/groups/tambah/aksi'),
                "groups"      => set_value('groups'),
                "description" => set_value('description')
              ];
      $this->temp_backend->view('backend/groups/form',$data);
    }
  }

  function edit($id,$aksi=null)
  {
    if ($aksi!=null) {
      if ($this->input->is_ajax_request()) {
        $json = array('success'=>false, 'alert'=>array());
        // rules
        $this->form_validation->set_rules("group","Group","trim|required|xss_clean|callback__cekGroupedit[".$id."]");
        $this->_rules();
        // end rules
        if ($this->form_validation->run()) {
          $update_group = [
                            "name" => $this->input->post('group',true),
                            "description"=> $this->input->post('description',true)
                          ];
          $this->model->get_update($this->table,
                                    $update_group,
                                    ['id_groups' => $id]
                                  );

          $id_group =  $id;
          $this->model->get_delete("groups_menus",
                                    ["id_groups"=>$id]
                                  );
          $akses = $this->input->post("akses");
            foreach ($akses as $key)
            {
              $data = [
                        'id_groups'  => $id_group,
                        'id_menus' => $key
                      ];
              $this->model->get_insert('groups_menus',$data);
            }

          $json['alert'] = "Berhasil Mengedit!";
          $json['success'] = true;
        }else {
          foreach ($_POST as $key => $value)
            {
              $json['alert'][$key] = form_error($key);
            }
        }
        echo json_encode($json);
      }
    }else {

      if ( $row = $this->model->get_where($this->table,['id_groups'=>$id])) {
          $this->load->helper(array('menugroup'));
          $this->temp_backend->set_title('Group');
          $data = [
                    "button"      => "edit",
                    "aksi"        => site_url('backend/groups/edit/'.$id.'/aksi'),
                    "id_groups"   => set_value('id_groups',$id),
                    "groups"      => set_value('groups',$row->name),
                    "description" => set_value('description',$row->description)
                  ];
          $this->temp_backend->view('backend/groups/form',$data);
      }else {
        $this->_error404();
      }

    }
  }

  function hapus($id)
  {
    if ($this->input->is_ajax_request()) {
      if ($this->model->get_delete($this->table,["id_groups"=>$id])) {
        $json['alert_class'] = "alert-success";
        $json['alert'] = '<i class="fa fa-check"></i>  Berhasil Menghapus!';
      }else {
        $json['alert_class'] = "alert-danger";
        $json['alert'] = '<i class="fa fa-close"></i> Gagal Menghapus, ada user yang menggunakan group ini!';
      }
      echo json_encode($json);
    }

  }

  function _cekGroup($str)
  {
    if ($this->model->get_where($this->table,["name"=>$str])) {
        $this->form_validation->set_message('_cekGroup', '{field} sudah ada');
        return FALSE;
    }else {
        return TRUE;
    }
  }

  function _cekGroupedit($str,$id)
  {
    if ($this->model->get_where($this->table,["id_groups!="=>$id,"name"=>$str])) {
        $this->form_validation->set_message('_cekGroupedit', '{field} sudah ada');
        return FALSE;
    }else {
        return TRUE;
    }
  }



} // end controller
