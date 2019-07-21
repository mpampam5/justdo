<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pengaturan extends Backend{

    private $table = "setting";
    private $id = 999;

    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('datatables'));
        $this->load->model('backend/pengaturan_model','model');
    }

    function index()
    {
        $this->temp_backend->set_title("Pengaturan");
        $this->temp_backend->view("backend/Pengaturan/index");
    }


    function umum()
    {
      if ( $row = $this->model->get_where($this->table,['id'=>999])) {
          $data=[
              "title"  => $row->title,
              "domain" => $row->domain,
              "telepon"=> $row->telepon,
              "alamat" => $row->alamat
          ];
          $this->temp_backend->view("backend/backend/pengaturan/umum_view",$data,false);
      }else {
          echo "error load content";
      }

    }



    function umum_form($aksi=null)
    {
        if ($aksi!=null) {
            $json = array('success'=>false, 'alert'=>array());

            $this->form_validation->set_rules("title","Title","trim|required|xss_clean|max_length[50]");
            $this->form_validation->set_rules("domain","Domain","trim|required|xss_clean|max_length[150]");
            $this->form_validation->set_rules("telepon","Telepon","trim|required|xss_clean|numeric|max_length[15]",[
                "numeric"=>"{field} tidak valid."
            ]);
            $this->form_validation->set_rules("alamat","alamat","trim|xss_clean");
            $this->form_validation->set_error_delimiters('<small class="form-text"><b class="text-danger">','</b></small>');

            if ($this->form_validation->run()) {
                $update = [
                            "title"  => $this->input->post("title",true),
                            "domain" => $this->input->post("domain",true),
                            "telepon"=> $this->input->post("telepon",true),
                            "alamat" => $this->input->post("alamat",true)
                            ];
                $this->model->get_update($this->table,$update,["id"=>999]);

                $json["success"] = true;
                $json["alert"] = "Berhasil Mengubah";
            } else {
                foreach ($_POST as $key => $value) {
                    $json['alert'][$key] = form_error($key);
                }
            }
            echo json_encode($json);
        }else {
            if ( $row = $this->model->get_where($this->table,['id'=>999])) {
                $data=[
                    "button" => "update",
                    "action" => site_url("backend/pengaturan/umum_form/aksi"),
                    "title"  => $row->title,
                    "domain" => $row->domain,
                    "telepon"=> $row->telepon,
                    "alamat" => $row->alamat
                ];
            $this->temp_backend->view("backend/backend/pengaturan/umum",$data,false);
            }else {
                $this->_error404();
            }

        }
    }



    function logo()
    {
      if ( $row = $this->model->get_where($this->table,['id'=>999])) {
          $data=[
              "logo"  => $row->logo
          ];
          $this->temp_backend->view("backend/backend/pengaturan/logo",$data,false);
      }else {
          echo "error load content";
      }
    }

    function logo_action($val)
    {
      if ($this->input->is_ajax_request()) {

        $logo = date('dmyhis')."_logo.png";

          $config['upload_path'] = './temp/backend/logo';
          $config['allowed_types'] = 'png';
          $config['overwrite'] = true;
          $config['max_size']  = '1024';
          $config['max_width']  = '400';
          $config['max_height']  = '400';
          $config['file_name']  = "$logo";


          $this->load->library('upload', $config);

          if ( ! $this->upload->do_upload('file')){
              $status = "error";
              $msg = "File logo tidak valid, pastikan extensi file PNG, ukuran logo max 400x400px & max 1mb.";
          }
          else{

              if (file_exists("./temp/backend/logo/$val")) {
                  unlink("./temp/backend/logo/$val");
              }

              $dataupload = $this->upload->data();
              $update = [
                          "logo" => $logo
                          ];
              $this->model->get_update($this->table,$update,["id"=>999]);
              $status = "success";
              $msg = "Logo berhasil diupload";
          }
          echo json_encode(array('status'=>$status,'msg'=>$msg));
      }
    }



}
