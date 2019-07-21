<?php defined('BASEPATH') OR exit('No direct script access allowed');

function create_file($path,$string,$file_name)
{
  if ( ! write_file($path."/".$file_name, $string))
  {
          return false;
  }
  else
  {
          return true;
  }
}



function field_pk($table)
{
  $ci = &get_instance();
  $fields = $ci->db->field_data($table);
  foreach ($fields as $field)
  {
    if ($field->primary_key==1) {
        $data = $field->name;
    }
  }
  return $data;
}

function field($table)
{
  $ci = &get_instance();
  return $ci->db->field_data($table);
}
