<?php
$str ="<?php if (!defined('BASEPATH')) exit('No direct script access allowed');";
$str .="\n/* modules/backend/controllers/".$controller_file_name." */
/* MPAMPAM CRUD GENERATOR */
/* PENGEMBANG : MPAMPAM */
/* EMAIL : MPAMPAM5@GMAIL.COM */
/* FACEBOOK : https://www.facebook.com/mpampam */
/* DIBUAT OLEH MPAMPAM CRUD GENERTOR ".date('Y-m-d H:i:s')." */
/* https://mpampam.com */
/* DI GUNAKAN OLEH USER ".$this->session->userdata('name')." */
    ";


//class and __construct
$str .="\n\nclass ".ucfirst($controller_name)." extends Backend{
    \n\tprivate \$table = \"$table_name\";
    \n\tpublic function __construct()
  {
    parent::__construct();
    \$this->load->library(array(\"datatables\"));
    \$this->load->model(\"".ucfirst($model_name)."\",\"model\");
  }";

// function rules
$str.="\n\n\n\tfunction _rules()
\t{";

foreach ($field_all as $field_rule) {
  if ($field_rule->primary_key!=1) {

    if (isset($_POST['primary_key'])) {
      $required = in_array($field_rule->name,$primary_key)?"|required":"";
    }else {
      $required = "";
    }
    $role = $field_rule->type == "varchar"?"|max_length[".$field_rule->max_length."]":"";
    $str.="\n\t\t\$this->form_validation->set_rules(\"".$field_rule->name."\",\"".ucwords(str_replace("_"," ",$field_rule->name))."\",\"trim|xss_clean".$role."".$required."\");";
  }
}

$str.="\n\t\t\$this->form_validation->set_error_delimiters('<p class=\"form-text text-danger\">','</p>');
\t}";


//function index
$str.="\n\n\n\tfunction index()
  {
    \$this->temp_backend->set_title('".$title_name."');
    \$this->temp_backend->view('content/".strtolower($controller_name)."/index');
  }";

  //function json Datatable
  $str.="\n\n\n\tfunction json()
  {
    header('Content-Type: application/json');
    echo \$this->model->json();
  }";


  //detail
  $str.="\n\n\n\tfunction detail(\$id)
  {
    if (\$row = \$this->model->get_where(\$this->table,['".$field_pk."'=>\$id])) {
      \t\$this->temp_backend->set_title('".$title_name."');
        \$data = [";
                  foreach ($field_all as $field) {
                    if ($field->primary_key!=1) {
  $str.="\n\t\t\t\t\t\t\t\t\t'$field->name'\t=>\t\$row->$field->name,";
                    }
                  }
  $str.= "\n\t\t\t\t\t\t\t\t];
      \$this->temp_backend->view('content/".strtolower($controller_name)."/detail',\$data);
    }else {
      \$this->_error404();
    }
  }";


//add
$str.="\n\n\nfunction add()
{
    \$this->temp_backend->set_title('".$title_name."');
      \$data = [
                'button' => 'tambah',
                'action' => site_url('backend/".strtolower($controller_name)."/add_action'),";

                foreach ($field_all as $field) {
                  if ($field->primary_key!=1) {
$str.="\n\t\t\t\t\t\t\t\t'$field->name'\t=>\tset_value('$field->name'),";
                  }
                }

$str.="\n\t\t\t\t\t\t\t];

    \$this->temp_backend->view('content/".strtolower($controller_name)."/form',\$data);
}";




//add action
$str.="\n\n\nfunction add_action()
{
  if (\$this->input->is_ajax_request()) {
      \$json = array('success'=>false, 'alert'=>array());
      \$this->_rules();
      if (\$this->form_validation->run()) {
        \$insert = [";
        foreach ($field_all as $field) {
          if ($field->primary_key!=1) {
$str.="\n\t\t\t\t\t\t\t\t\t\t'$field->name'\t=>\t\$this->input->post('$field->name',true),";
          }
        }
$str.="\n\t\t\t\t\t\t\t\t\t];

        if (\$this->model->get_insert(\$this->table,\$insert)) {
          \$json['alert']   = '<div id=\"alert\" class=\"alert alert-success\">
                                <i class=\"fa fa-check\"></i> Berhasil Menambahkan.
                              <div>';
        }else {
          \$json['alert']   = '<div id=\"alert\" class=\"alert alert-danger\">
                                <i class=\"fa fa-close\"></i> Gagal Menambahkan.
                              <div>';
        }

        \$json['success'] = true;
      }else {
        foreach (\$_POST as \$key => \$value)
          {
            \$json['alert'][\$key] = form_error(\$key);
          }
      }

      echo json_encode(\$json);
  }
}";



//update
$str.="\n\n\nfunction update(\$id)
{
  if (\$row = \$this->model->get_where(\$this->table,['".$field_pk."'=>\$id])) {
    \$this->temp_backend->set_title('".$title_name."');

      \$data = [
                'button' => 'edit',
                'action' => site_url('backend/".strtolower($controller_name)."/update_action/'.\$id),";
                foreach ($field_all as $field) {
                  if ($field->primary_key!=1) {
$str.="\n\t\t\t\t\t\t\t\t'$field->name'\t=>\tset_value('$field->name',\$row->$field->name),";
                  }
                }
$str.="\n\t\t\t\t\t\t\t];

    \$this->temp_backend->view('content/".strtolower($controller_name)."/form',\$data);
  }else {
    \$this->_error404();
  }
}";



//update action
$str.="\n\n\nfunction update_action(\$id)
{
  if (\$this->input->is_ajax_request()) {
      \$json = array('success'=>false, 'alert'=>array());
      \$this->_rules();
      if (\$this->form_validation->run()) {
        \$update = [";
          foreach ($field_all as $field) {
            if ($field->primary_key!=1) {
  $str.="\n\t\t\t\t\t\t\t\t\t\t'$field->name'\t=>\t\$this->input->post('$field->name',true),";
            }
          }
  $str.="\n\t\t\t\t\t\t\t\t\t];

        if (\$this->model->get_update(\$this->table,\$update,[\"".$field_pk."\"=>\$id])) {
          \$json['alert']   = '<div id=\"alert\" class=\"alert alert-success\">
                                <i class=\"fa fa-check\"></i> Berhasil Mengedit.
                              <div>';
        }else {
          \$json['alert']   = '<div id=\"alert\" class=\"alert alert-danger\">
                                <i class=\"fa fa-close\"></i> Gagal Mengedit.
                              <div>';
        }

        \$json['success'] = true;
      }else {
        foreach (\$_POST as \$key => \$value)
          {
            \$json['alert'][\$key] = form_error(\$key);
          }
      }

      echo json_encode(\$json);
  }
}";


//delete
$str.="\n\n\nfunction delete(\$id)
{
  if (\$this->input->is_ajax_request()) {
    if (\$this->model->get_delete(\$this->table,[\"".$field_pk."\"=>\$id])) {
      \$json['alert']   = '<div id=\"alert\" class=\"alert alert-success\">
                            <i class=\"fa fa-check\"></i> Berhasil Menghapus.
                          <div>';
    }else {
      \$json['alert']   = '<div id=\"alert\" class=\"alert alert-danger\">
                            <i class=\"fa fa-close\"></i> Gagal Menghapus.
                          <div>';
    }
    echo json_encode(\$json);
  }
}";


$str .="\n\n\n\n\n} //End Class ".ucfirst($controller_name);



$created_file_controller = $str;
