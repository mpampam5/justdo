<?php
$str ="<?php if (!defined('BASEPATH')) exit('No direct script access allowed');";
$str .="\n/* modules/backend/models/".$model_file_name." */
/* MPAMPAM CRUD GENERATOR */
/* PENGEMBANG : MPAMPAM */
/* EMAIL : MPAMPAM5@GMAIL.COM */
/* FACEBOOK : https://www.facebook.com/mpampam */
/* DIBUAT OLEH MPAMPAM CRUD GENERTOR ".date('Y-m-d H:i:s')." */
/* https://mpampam.com */
/* DI GUNAKAN OLEH USER ".$this->session->userdata('name')." */
";

    //class and __construct
$str .="\n\nclass ".ucfirst($model_name)." extends MY_Model{
    \n\tprivate \$table = \"$table_name\";
";

$fields = array();
foreach ($field_all as $field) {
  $fields[] = $field->name;
}
$column = implode(',',$fields);

//json
$str.="\n\n\tfunction json()\n\t{";
$str.="\n\t\t\$this->datatables->select('".$column."');";
$str.="\n\t\t\$this->datatables->from(\$this->table);
    \$this->datatables->add_column('action',
                                  '<a href=\"'.site_url(\"backend/".strtolower($controller_name)."/detail/$1\").'\" id=\"detail\" class=\"btn btn-link p-a-5 text-info\" data-toggle=\"tooltip\" data-placement=\"bottom\" title=\"Detail\"><i class=\"fa fa-file\"></i></a>
                                  <a href=\"'.site_url(\"backend/".strtolower($controller_name)."/update/$1\").'\" id=\"update\" class=\"btn btn-link p-a-5 text-warning\" data-toggle=\"tooltip\" data-placement=\"bottom\" title=\"Edit\"><i class=\"fa fa-pencil\"></i></a>
                                  <a href=\"'.site_url(\"backend/".strtolower($controller_name)."/delete/$1\").'\" id=\"hapus\" class=\"btn btn-link p-a-5 text-danger\" data-toggle=\"tooltip\" data-placement=\"bottom\" title=\"Hapus\"><i class=\"fa fa-trash\"></i></a>',
                                  '".$field_pk."');
    return \$this->datatables->generate();
\t}";

$str .="\n\n\n\n\n} /*End Class ".ucfirst($model_name)."*/";


$created_file_model = $str;
