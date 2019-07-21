<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Mpampam_crud extends Backend{

function __construct()
    {
        parent::__construct();
        $this->load->model('Mpampam_model','model');
        $this->load->helper("mpampam_crud/m_crud");
    }

function index()
    {
        $data['tables']= $this->db->list_tables();
        $this->temp_backend->set_title('Mpampam Crud Generator');
        $this->temp_backend->view('mpampam_crud/index',$data);
    }

function field_json($table)
{
    if ($this->input->is_ajax_request()) {
        $json = array('success'=>false, 'alert'=>"", 'content'=>"");
        if ($table=='0') {
            $json["success"] = true;
                $json["content"] = "Silahkan Pilih Table Di Samping.";
        }else {
            if ($this->db->table_exists($table)) {
                $json["success"] = true;
                $json["content"] = $this->model->get_field($table);
            }else {
                $json["alert"] = "Table tidak valid";
            }
        }

        echo json_encode($json);
    }
}

function _rules()
{
    $this->form_validation->set_rules("table","Table","trim|xss_clean|required");
    $this->form_validation->set_rules("title","Title","trim|xss_clean|required");
    $this->form_validation->set_rules("controller","Controller","trim|xss_clean|required|callback__cek_controller");
    $this->form_validation->set_rules("model","Model","trim|xss_clean|required|callback__cek_model");
    $this->form_validation->set_rules("datatabletype","DataTable type","trim|xss_clean|required",[
      "required" => "Silahkan Memilih type Datatable"
    ]);
}


function action()
{
    if ($this->input->is_ajax_request()) {
        $json = array('success'=>false, 'alert'=>array());
        //rules
        $this->_rules();
        $this->form_validation->set_error_delimiters('<small class="form-text"><b class="text-danger">','</b></small>');


        if ($this->form_validation->run()) {
            $this->load->helper("file");
            $path =  APPPATH."modules/backend/";

            $table_name = $this->input->post("table");
            $title_name = $this->input->post("title");
            $controller_name = $this->input->post("controller");
            $model_name = $this->input->post("model");
            $primary_key = $this->input->post('primary_key');


            $controller_file_name = ucfirst($controller_name).".php";
            $model_file_name = ucfirst($model_name).".php";
            $index_file_name = "index.php";
            $form_file_name = "form.php";
            $detail_file_name = "detail.php";

            $field_all = field($table_name);
            $field_pk = field_pk($table_name);


            //create forlder view
            if (!file_exists(($path.'views/content/'.strtolower($controller_name)))) {
                mkdir($path.'views/content/'.strtolower($controller_name), 0777, TRUE);
            }

            // file include core
            include APPPATH."modules/mpampam_crud/core/controller.php";
            include APPPATH."modules/mpampam_crud/core/model.php";
            include APPPATH."modules/mpampam_crud/core/form.php";
            include APPPATH."modules/mpampam_crud/core/view.php";
            include APPPATH."modules/mpampam_crud/core/detail.php";

            //create file controller
            if (create_file("$path/controllers/",$created_file_controller,$controller_file_name)==true) {
                $json["notif"][] = "<span class='text-success'><i class='fa fa-check'></i> Berhasil Membuat Controllers : modules/backend/controllers/$controller_file_name</span>";
            }else {
                $json["notif"][] = "<span class='text-danger'><i class='fa fa-close'></i> Gagal Membuat Controllers.</span>";
            }

            //create file controller
            if (create_file("$path/models/",$created_file_model,$model_file_name)==true) {
                $json["notif"][] = "<span class='text-success'><i class='fa fa-check'></i> Berhasil Membuat Models : modules/backend/models/$model_file_name</span>";
            }else {
                $json["notif"][] = "<span class='text-danger'><i class='fa fa-close'></i> Gagal Membuat Models.</span>";
            }

            //create file view index
            if (create_file("$path/views/content/".strtolower($controller_name),$created_file_view,$index_file_name)==true) {
                $json["notif"][] = "<span class='text-success'><i class='fa fa-check'></i> Berhasil Membuat view index : modules/backend/views/content/".strtolower($controller_name)."/".$index_file_name."</span>";
            }else {
                $json["notif"][] = "<span class='text-danger'><i class='fa fa-close'></i> Gagal Membuat view index.</span>";
            }

            //create file view form
            if (create_file("$path/views/content/".strtolower($controller_name),$created_file_form,$form_file_name)==true) {
                $json["notif"][] = "<span class='text-success'><i class='fa fa-check'></i> Berhasil Membuat view form : modules/backend/views/content/".strtolower($controller_name)."/".$form_file_name."</span>";
            }else {
                $json["notif"][] = "<span class='text-danger'><i class='fa fa-close'></i> Gagal Membuat view form.</span>";
            }

            //create file view detail
            if (create_file("$path/views/content/".strtolower($controller_name),$created_file_detail,$detail_file_name)==true) {
                $json["notif"][] = "<span class='text-success'><i class='fa fa-check'></i> Berhasil Membuat view detail : modules/backend/views/content/".strtolower($controller_name)."/".$detail_file_name."</span>";
            }else {
                $json["notif"][] = "<span class='text-danger'><i class='fa fa-close'></i> Gagal Membuat view Detail.</span>";
            }


            $json["alert"] = "Sukses";
            $json["success"] = true;

        } else {
            foreach ($_POST as $key => $value)
            {
                $json['alert'][$key] = form_error($key);
            }
        }

        echo json_encode($json);
    }
}

function _cek_controller($str)
{
    $path =  APPPATH."modules/backend/controllers/";
    if (file_exists($path."backend/".ucfirst($str).".php")){
        $this->form_validation->set_message('_cek_controller', "Nama {field}  <i class='text-info'>".ucfirst($str)."</i> tidak dapat digunakan.");
        return FALSE;
    }else {
        return TRUE;
    }
}

function _cek_model($str)
{
    $path =  APPPATH."modules/backend/models/";
    if (file_exists($path."backend/".ucfirst($str).".php")) {
        $this->form_validation->set_message('_cek_model', "Nama {field} <i class='text-info'>".ucfirst($str)."</i> tidak dapat digunakan");
        return FALSE;
    }else {
        return TRUE;
    }
}



}
