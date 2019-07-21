<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Resetpwd extends Backend
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('backend/Resetpwd_model','model');
    }

    function index()
    {
        if ($this->input->is_ajax_request()) {
            $this->load->view("backend/backend/resetpwd/index");
        }
    }

    function action()
    {
        if ($this->input->is_ajax_request()) {
            $json = array('success'=>false, 'alert'=>array());
            $this->form_validation->set_rules('password_lama','Password Lama','trim|required|callback__cekpwdlama');
            $this->form_validation->set_rules('password','Password','trim|required|min_length[5]');
            $this->form_validation->set_rules('konfirmasi_password','Konfirmasi Password','trim|required|matches[password]');
            $this->form_validation->set_error_delimiters('<small class="form-text"><b class="text-danger">','</b></small>');
            if ($this->form_validation->run()) {
                if ($row = $this->model->get_where('users',["id_users"=>session('id_users')])) {
                $this->load->helper(array('enc'));
                $token = $row->key;
                $pwd = $this->input->post('konfirmasi_password');
                $password = pass_encrypt($pwd,$token);
                $update_pwd = [
                                    "password" =>$password
                                ];

                $this->model->get_update("users",$update_pwd,["id_users"=>session('id_users')]);
                $json["success"] = true;
                $json["alert"]   = "Berhasil Mengubah Password";
                }else {
                    $json["success"] = true;
                $json["alert"]   = "Gagal";
                }

            }else {
                foreach ($_POST as $key => $value) {
                    $json['alert'][$key] = form_error($key);
                }
            }

            echo json_encode($json);
        }
    }

    function _cekpwdlama($str)
    {
        if ($row = $this->model->get_where('users',["id_users"=>session('id_users')])) {
            $this->load->helper(array('enc'));
            if (pass_decrypt($str,$row->key,$row->password)) {
                return TRUE;
            } else {
                $this->form_validation->set_message('_cekpwdlama', '{field} tidak valid');
                return FALSE;
            }
        }else {
            return TRUE;
        }
    }


}
