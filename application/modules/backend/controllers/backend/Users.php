<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends Backend
{
    private $table = "users";

    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('datatables'));
        $this->load->model('backend/Users_model','model');
    }

    function _rules()
    {
        $this->form_validation->set_rules('first_name','First Name','trim|xss_clean|required|max_length[20]');
        $this->form_validation->set_rules('last_name','Last Name','trim|xss_clean|required|max_length[20]');
        $this->form_validation->set_rules('phone','Phone','trim|xss_clean|required|numeric|max_length[15]');
        $this->form_validation->set_rules('group','Group','trim|xss_clean|required');
        $this->form_validation->set_rules('aktif','Aktif','trim|xss_clean|required');
        $this->form_validation->set_error_delimiters('<small class="form-text"><b class="text-danger">','</b></small>');
    }

    function index()
    {
        $this->temp_backend->set_title('User');
        $this->temp_backend->view('backend/users/index');
    }

    function json()
    {
    header('Content-Type: application/json');
    echo $this->model->json();
    }

    function detail($id)
    {
        if ($row = $this->model->get_where_join('users_groups',["users_groups.id_users"=>$id])) {
            $data = [
                        "sub_title"     => "detail",
                        "id_users"    => $row->id_users,
                        "first_name"    => $row->first_name,
                        "last_name"     => $row->last_name,
                        "email"         => $row->email,
                        "phone"         => $row->phone,
                        "username"      => $row->username,
                        "active"        => $row->active,
                        "name"          => $row->name,
                        "id_groups"     => $row->id_groups
                    ];
            $this->temp_backend->set_title('User');
            $this->temp_backend->view('backend/users/detail',$data);
        }else {
          $this->_error404();
        }
    }


    function tambah($aksi=null)
    {
        if ($aksi!=null) {
            if ($this->input->is_ajax_request()) {
                $json = array('success'=>false, 'alert'=>array());
                $this->form_validation->set_rules('email','Email','trim|xss_clean|required|valid_email|is_unique[users.email]',[
                    'is_unique'=>" {field} sudah ada"
                ]);
                $this->form_validation->set_rules('username','Username','trim|xss_clean|required|alpha_numeric|max_length[50]|is_unique[users.username]',[
                                    'is_unique'=>" {field} sudah ada",
                                    'alpha_numeric'=> "Hanya berupa angka & huruf (Tanpa Spasi)"
                                ]);
                $this->form_validation->set_rules('password','Password','trim|xss_clean|required|min_length[5]');
                $this->_rules();
                if ($this->form_validation->run()) {
                    $this->load->helper(array('enc'));
                    $pwd = $this->input->post('password',TRUE);
                    $key = date('YmdHis');
                    $password = pass_encrypt($pwd,$key);
                    $insert_users = [
                                        "first_name" => $this->input->post('first_name',TRUE),
                                        "last_name"  => $this->input->post('last_name',TRUE),
                                        "email"      => $this->input->post('email',TRUE),
                                        "phone"      => $this->input->post('phone',TRUE),
                                        "username"   => $this->input->post('username',TRUE),
                                        "password"   => $password,
                                        "active"     => $this->input->post('aktif',TRUE),
                                        "key"        => $key,
                                        "created_at" => date("Y-m-d H:i:s")
                                    ];

                    $this->model->get_insert("users",$insert_users);
                    $id_users =  $this->db->insert_id();
                    $insert_users_groups = [
                                                'id_users' => $id_users,
                                                'id_groups'=> $this->input->post('group',TRUE)
                                            ];
                    $this->model->get_insert("users_groups",$insert_users_groups);
                    $json['alert'] = "Berhasil Menyimpan!";
                    $json['success'] = true;
                }else {
                    foreach ($_POST as $key => $value) {
                        $json['alert'][$key] = form_error($key);
                    }
                }
                echo json_encode($json);
            }
        }else {
            $this->temp_backend->set_title('User');
            $data = [
                        "button"        => "tambah",
                        "aksi"          => site_url("backend/users/tambah/aksi"),
                        "first_name"    => set_value("first_name"),
                        "last_name"     => set_value("last_name"),
                        "email"         => set_value("email"),
                        "phone"         => set_value("phone"),
                        "username"      => set_value("username"),
                        "password"      => set_value("password"),
                        "aktif"         => set_value("aktif"),
                        "id_groups"     => set_value("id_groups")
                    ];
            $this->temp_backend->view('backend/users/form',$data);
        }
    }

    function edit($id,$aksi=null)
    {
        if ($aksi!=null) {
            if ($this->input->is_ajax_request()) {
                $json = array('success'=>false, 'alert'=>array());
                $this->form_validation->set_rules('email','Email','trim|xss_clean|required|valid_email|callback__cekEmailedit['.$id.']');
                $this->form_validation->set_rules('username','Username','trim|xss_clean|required|alpha_numeric|max_length[50]|callback__cekUseredit['.$id.']',[
                    'alpha_numeric'=> "Hanya berupa angka & huruf (Tanpa Spasi)"
                ]);
                $this->_rules();
                if ($this->form_validation->run()) {

                    $update_users = [
                                        "first_name" => $this->input->post('first_name',TRUE),
                                        "last_name"  => $this->input->post('last_name',TRUE),
                                        "email"      => $this->input->post('email',TRUE),
                                        "phone"      => $this->input->post('phone',TRUE),
                                        "username"   => $this->input->post('username',TRUE),
                                        "active"     => $this->input->post('aktif',TRUE),
                                        "update_at" => date("Y-m-d H:i:s")
                                    ];

                    $this->model->get_update("users",$update_users,["id_users"=>$id]);
                    $update_users_groups = [
                                                'id_groups'=> $this->input->post('group',TRUE)
                                            ];
                    $this->model->get_update("users_groups",$update_users_groups,['id_users' => $id]);
                    $json['alert'] = "Berhasil Mengubah!";
                    $json['success'] = true;
                }else {
                    foreach ($_POST as $key => $value) {
                        $json['alert'][$key] = form_error($key);
                    }
                }
                echo json_encode($json);
            }
        }else {
            if ($row = $this->model->get_where_join('users_groups',["users_groups.id_users"=>$id])) {
                $this->temp_backend->set_title('User');
            $data = [
                        "button"        => "edit",
                        "aksi"          => site_url("backend/users/edit/".$id."/aksi"),
                        "first_name"    => set_value("first_name",$row->first_name),
                        "last_name"     => set_value("last_name",$row->last_name),
                        "email"         => set_value("email",$row->email),
                        "phone"         => set_value("phone",$row->phone),
                        "username"      => set_value("username",$row->username),
                        "password"      => set_value("password"),
                        "aktif"         => set_value("aktif",$row->active),
                        "id_groups"     => set_value("id_groups",$row->id_groups)
                    ];
            $this->temp_backend->view('backend/users/form',$data);
            }else {
                $this->_error404();
            }
        }
    }

    function _cekUseredit($str,$id)
    {
      if ($this->model->get_where($this->table,["id_users!="=>$id,"username"=>$str])) {
          $this->form_validation->set_message('_cekUseredit', '{field} sudah ada');
          return FALSE;
      }else {
          return TRUE;
      }
    }

    function _cekEmailedit($str,$id)
    {
      if ($this->model->get_where($this->table,["id_users!="=>$id,"email"=>$str])) {
          $this->form_validation->set_message('_cekEmailedit', '{field} sudah ada');
          return FALSE;
      }else {
          return TRUE;
      }
    }



    function hapus($id)
    {
        if ($this->input->is_ajax_request()) {
          if (session('id_users'!=$id)) {
            if ($this->model->get_delete($this->table,["id_users"=>$id])) {
                $json['alert_class'] = "alert-success";
                $json['alert'] = '<i class="fa fa-check"></i>  Berhasil Menghapus!';
              }else {
                $json['alert_class'] = "alert-danger";
                $json['alert'] = '<i class="fa fa-close"></i> Gagal Menghapus!';
            }
          }else {
            $json['alert_class'] = "alert-danger";
            $json['alert'] = '<i class="fa fa-close"></i>  Tidak dapat menghapus, karena akun sedang terpakai';
          }

            echo json_encode($json);
          }
    }

    function resetpwd($id,$aksi=null)
    {
        if ($aksi!=null) {
            if ($this->input->is_ajax_request()) {
                $json = array('success'=>false, 'alert'=>array());
                $this->form_validation->set_rules('password','Password','trim|required|min_length[5]');
                $this->form_validation->set_rules('token','token','trim|required');
                $this->form_validation->set_rules('konfirmasi_password','Konfirmasi Password','trim|required|matches[password]');
                $this->form_validation->set_error_delimiters('<small class="form-text"><b class="text-danger">','</b></small>');
                if ($this->form_validation->run()) {
                    $this->load->helper(array('enc'));
                    $token = $this->input->post('token');
                    $pwd = $this->input->post('konfirmasi_password');
                    $password = pass_encrypt($pwd,$token);
                    $update_pwd = [
                                        "password" =>$password
                                    ];

                    $this->model->get_update("users",$update_pwd,["id_users"=>$id]);
                    $json["success"] = true;
                    $json["alert"]   = "Berhasil Mengubah Password";
                }else {
                    foreach ($_POST as $key => $value) {
                        $json['alert'][$key] = form_error($key);
                    }
                }

                echo json_encode($json);
            }
        }else {
            if ($row = $this->model->get_where('users',["id_users"=>$id])) {
                $data = [
                            "action"=> site_url("backend/users/resetpwd/$id/aksi"),
                            "username"=> $row->username,
                            "token"=> $row->key
                        ];
                $this->temp_backend->view('backend/backend/users/form_reset_pwd',$data,false);
            }else {
                $this->_error404();
            }
        }
    }



}//end class
