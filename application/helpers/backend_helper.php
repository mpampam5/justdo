<?php defined('BASEPATH') OR exit('No direct script access allowed');

function session($str)
{
  $ci=get_instance();
  return $ci->session->userdata($str);
}

function user_login($field)
{
  $ci=get_instance();
  $query = $ci->db->get_where("users",['id_users'=>$ci->session->userdata('id_users')]);
  if ($query->num_rows()>0) {
      return $query->row()->$field;
  }else{
      return "Error data";
  }
}

function setting($field){
  $ci=get_instance();
  $row = $ci->db->get_where("setting",["id"=>999])->row();
  return $row->$field;
}

function cmb_menu($id="")
{
  $ci =get_instance();
  $query = $ci->db->query("SELECT * FROM  menus WHERE is_parent=0 ORDER BY sort ASC");
  $str = "";
  $str.='<select class="form-control" id="is_parent" name="is_parent">';
  if ($id=="") {
    $str.='<option value="0">Ya</option>';
  }else {
    $str .="<option value='0'";
    $str .= $id==0?" selected='selected'":'';
    $str .=">Ya</option>";
  }
  foreach ($query->result() as $row) {
      $str.= '<option value="'.$row->id.'"';
      $str.= $id==$row->id?"selected='selected'":'';
      $str.= '>'.ucfirst($row->name).'</option>';
  }
  $str.='</select>';
  return $str;
}

function cmb_menu_public($id="")
{
  $ci =get_instance();
  $query = $ci->db->query("SELECT * FROM  menu_public WHERE is_parent=0 ORDER BY sort ASC");
  $str = "";
  $str.='<select class="form-control" id="is_parent" name="is_parent">';
  if ($id=="") {
    $str.='<option value="0">Ya</option>';
  }else {
    $str .="<option value='0'";
    $str .= $id==0?" selected='selected'":'';
    $str .=">Ya</option>";
  }
  foreach ($query->result() as $row) {
      $str.= '<option value="'.$row->id.'"';
      $str.= $id==$row->id?"selected='selected'":'';
      $str.= '>'.ucfirst($row->name).'</option>';
  }
  $str.='</select>';
  return $str;
}

function cmb_dimanis($id,$name,$table,$id_field,$field,$pk)
{
  $ci =get_instance();

  $query = $ci->db->get($table);
  $str ="";
  $str.= '<select class="form-control" id="'.$id.'" name="'.$name.'">';
  if ($pk==null) {
    $str.='<option value="" style="color:#bebebe">--pilih--</option>';
  }

  foreach ($query->result() as $row) {
      $str.='<option value="'.$row->$id_field.'"';
      $str.= $pk==$row->$id_field?"selected='selected'":'';;
      $str.= '>'.$row->$field.'</option>';
  }

  $str.= "</select>";

  return $str;
}

function cmb_query($id,$name,$query,$id_field,$field,$pk)
{
  $ci =get_instance();

  $query = $ci->db->query("$query");
  $str ="";
  $str.= '<select class="form-control" id="'.$id.'" name="'.$name.'">';
  if ($pk==null) {
    $str.='<option value="" style="color:#bebebe">--pilih--</option>';
  }

  foreach ($query->result() as $row) {
      $str.='<option value="'.$row->$id_field.'"';
      $str.= $pk==$row->$id_field?"selected='selected'":'';;
      $str.= '>'.strtolower($row->$field).'</option>';
  }

  $str.= "</select>";

  return $str;
}
