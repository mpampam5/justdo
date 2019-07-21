<?php defined('BASEPATH') OR exit('No direct script access allowed');

function listMenu()
{
  $ci = &get_instance();

  $str = "<ul id='menu-list'>";
  $menu = $ci->db->query("SELECT * FROM menus WHERE is_parent=0 ORDER BY sort ASC");
  foreach ($menu->result() as $menus) {
    $str.= '<li>'.ucfirst($menus->name);
   
            if (_cekParent($menus->id)==true) {
              $str.='<span class="menu-action">';
                          $str.='<label class="custom-control custom-checkbox custom-checkbox-primary">
                            Akses
                              <input type="checkbox" class="custom-control-input akses"  value="'.$menus->id.'" name="akses[]">
                              <span class="custom-control-indicator"></span>
                            </label>';

                $str.='</span>';
            }else {
              $str.="<ul id='sub-menu-list'>";
              $sub_menu = $ci->db->query("SELECT * FROM menus WHERE is_parent=$menus->id ORDER BY sort ASC");
              foreach ($sub_menu->result() as $sub_menus) {
                  $str.='<li>'.$sub_menus->name;
                  $str.='<span class="menu-action">
                            <label class="custom-control custom-checkbox custom-checkbox-primary">
                              Akses
                                <input type="checkbox" class="custom-control-input" value="'.$sub_menus->id.'" name="akses[]">
                                <span class="custom-control-indicator"></span>
                              </label>

                            </span>';
                  $str.="</li>";
              }
              $str.="</ul>";
            }

    $str.= '</li>';
  }
  $str.="</ul>";

  return $str;
}

function listMenuedit($id_groups)
{
  $ci = &get_instance();

  $str = "<ul id='menu-list'>";
  $menu = $ci->db->query("SELECT * FROM menus WHERE is_parent=0 ORDER BY sort ASC");
  foreach ($menu->result() as $menus) {
    $str.= '<li>'.ucfirst($menus->name);
   
            if (_cekParent($menus->id)==true) {
              $str.='<span class="menu-action">';
                          $str.='<label class="custom-control custom-checkbox custom-checkbox-primary">
                            Akses
                              <input type="checkbox" class="custom-control-input" '.(_cekmenu($id_groups,$menus->id)==true?"checked":"").' value="'.$menus->id.'" name="akses[]">
                              <span class="custom-control-indicator"></span>
                            </label>';

                $str.='</span>';
            }else {
              $str.="<ul id='sub-menu-list'>";
              $sub_menu = $ci->db->query("SELECT * FROM menus WHERE is_parent=$menus->id ORDER BY sort ASC");
              foreach ($sub_menu->result() as $sub_menus) {
                  $str.='<li>'.$sub_menus->name;
                  $str.='<span class="menu-action">
                            <label class="custom-control custom-checkbox custom-checkbox-primary">
                              Akses
                                <input type="checkbox" class="custom-control-input" '.(_cekmenu($id_groups,$sub_menus->id)==true?"checked":"").' value="'.$sub_menus->id.'" name="akses[]">
                                <span class="custom-control-indicator"></span>
                              </label>

                            </span>';
                  $str.="</li>";
              }
              $str.="</ul>";
            }

    $str.= '</li>';
  }
  $str.="</ul>";

  return $str;
}

function listMenudetail($id_groups)
{
  $ci = &get_instance();

  $str = "<ul id='menu-list'>";
  $menu = $ci->db->query("SELECT * FROM menus WHERE is_parent=0 ORDER BY sort ASC");
  foreach ($menu->result() as $menus) {
    $str.= '<li>'.ucfirst($menus->name);
   
            if (_cekParent($menus->id)==true) {
              $str.='<span class="menu-action">';
                          $str.='<label class="custom-control custom-checkbox custom-checkbox-primary">
                            Akses
                              <input type="checkbox" disabled class="custom-control-input" '.(_cekmenu($id_groups,$menus->id)==true?"checked":"").' value="'.$menus->id.'" name="akses[]">
                              <span class="custom-control-indicator"></span>
                            </label>';

                $str.='</span>';
            }else {
              $str.="<ul id='sub-menu-list'>";
              $sub_menu = $ci->db->query("SELECT * FROM menus WHERE is_parent=$menus->id ORDER BY sort ASC");
              foreach ($sub_menu->result() as $sub_menus) {
                  $str.='<li>'.$sub_menus->name;
                  $str.='<span class="menu-action">
                            <label class="custom-control custom-checkbox custom-checkbox-primary">
                              Akses
                                <input type="checkbox" disabled class="custom-control-input" '.(_cekmenu($id_groups,$sub_menus->id)==true?"checked":"").' value="'.$sub_menus->id.'" name="akses[]">
                                <span class="custom-control-indicator"></span>
                              </label>

                            </span>';
                  $str.="</li>";
              }
              $str.="</ul>";
            }

    $str.= '</li>';
  }
  $str.="</ul>";

  return $str;
}


function _cekParent($id_menu)
{
  $ci = &get_instance();

  $menu = $ci->db->query("SELECT * FROM menus WHERE is_parent != 0 AND is_parent=$id_menu ORDER BY sort ASC");
  if ($menu->num_rows()>0) {
      return false;
  }else {
     return true;
  }
}

function _cekMenu($id_groups,$id_menus)
{
  $ci = &get_instance();

  $query = $ci->db->get_where("groups_menus",  
                                [
                                  "id_groups" => $id_groups,
                                  "id_menus"  =>$id_menus
                                ]
                            );
  if ($query->num_rows()>0) {
    return true;
  }else {
    return false;
  }
}


