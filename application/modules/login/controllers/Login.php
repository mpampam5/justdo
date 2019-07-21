<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller{

  function _rules()
  {
     $this->form_validation->set_rules("username","Username","trim|xss_clean|required");
     $this->form_validation->set_rules("password","Password","trim|xss_clean|required");
     $this->form_validation->set_error_delimiters('<small class="form-text text-danger">','</small>');
   }

  function index()
  {
      if ($this->session->userdata('logged-in')==true) {
        redirect('backend/home','refresh');
      }else {
        $this->load->view('index');
      }
  }

  function action()
  {
    if ($this->input->is_ajax_request()) {
        $this->load->library(array('form_validation'));
        $json = [
          "success"    => false,
          "getaccount" => false,
          "url"        => "",
          "alert"      => array() 
        ];
        
         $this->_rules();
         
      if ($this->form_validation->run()) {
          $json["success"]=true;
          
          $this->load->helper(array('enc'));
          $this->load->model("Login_model","model");

          $username = $this->input->post("username",true);
          $password = $this->input->post("password");
          
          $cek_account = $this->model->get_login($username);
          if($cek_account->num_rows() == 1){
              $row = $cek_account->row();
              if (pass_decrypt($password,$row->key,$row->password)==true) {
                $session = [
                              "id_users" => $row->id_users,
                              "id_groups" => $row->id_groups,
                              // "name" => $row->first_name." ".$row->last_name,
                              "logged-in" => true
                            ];
                $this->session->set_userdata($session);
                $this->model->update_time($row->id_users);
                $json["getaccount"] = true;
                $json["url"]        = site_url("backend/home");
              }else {
                $json["alert"] = "&nbsp;username atau password salah";
              }    
          }else {
            $json["alert"] = "&nbsp;username atau password salah";
          }

          
      }else {
        foreach ($_POST as $key => $value) 
            {
              $json['alert'][$key] = form_error($key);
            }
      }

      echo json_encode($json);

    }
  }


  function logout()
  {
    $this->session->sess_destroy();
    redirect('adm-panel','refresh');
  }








}
