<?php defined('BASEPATH') OR exit('No direct script access allowed');



function getMenu()
{
    $ci=&get_instance();
    $id_groups = $ci->session->userdata("id_groups");
    $menu = $ci->db->select('id,name,url,sort,icon,is_active')
                    ->from("menus")
                    ->where("is_active",1)
                    ->where("is_parent",0)
                    ->order_by("sort","asc")
                    ->get();
    $str = "<ul>";
    foreach ($menu->result() as $menus) {
        $sub_menu = $ci->db->select('id,name,url,sort,is_active')
                    ->from("menus")
                    ->where("is_active",1)
                    ->where("is_parent",$menus->id)
                    ->order_by("sort","asc")
                    ->get();
        if ($sub_menu->num_rows() > 0) {
            if (_cekMenuDrop($menus->id)) {
            $str.='<li class="has-sub">';
            $str.='<a href="#"><i class="'.$menus->icon.'"></i> '.ucfirst($menus->name).'</a>';
            $str.='<ul>';
            foreach ($sub_menu->result() as $sub_menus) {
                if (_cekMenugroup($sub_menus->id)) {
                    $str.='<li><a href="'.site_url("backend/$sub_menus->url").'"><i class="fa fa-circle"></i> '.ucfirst($sub_menus->name).'</a></li>';
                }
            }
            $str.='</ul>';
            $str.='</li>';
        }
        }else {
            if (_cekMenugroup($menus->id)) {
                $str.='<li><a href="'.site_url("backend/$menus->url").'"><i class="'.$menus->icon.'"></i> '.ucfirst($menus->name).'</a></li>';
            }
        }


    }
    // $str.='<li><a href="'.site_url("adm-logout").'" id="sign-out"><i class="fa fa-sign-out"></i> Keluar</a></li>';

    $str.= "</ul>";

    return $str;
}

function _cekMenugroup($id_menu)
{
    $ci=&get_instance();

    $id_groups = $ci->session->userdata("id_groups");
    $cek_menu = $ci->db->select(' groups_menus.id,
                                            groups_menus.id_groups AS id_groups,
                                            groups_menus.id_menus AS id_menus,
                                            menus.id AS id,
                                            menus.is_active')
                                    ->from("groups_menus")
                                    ->join("menus","groups_menus.id_menus = menus.id")
                                    ->where("groups_menus.id_groups",$id_groups)
                                    ->where("menus.is_active",1)
                                    ->where("groups_menus.id_menus",$id_menu)
                                    ->get();
    if ($cek_menu->num_rows() == 1) {
        return true;
    } else {
        return false;
    }

}

function _cekMenuDrop($id_menu)
{
    $ci=&get_instance();

    $id_groups = $ci->session->userdata("id_groups");
    $cek_menu = $ci->db->select(' groups_menus.id,
                                groups_menus.id_groups AS id_groups,
                                groups_menus.id_menus AS id_menus,
                                menus.id AS id,
                                menus.is_active')
                                    ->from("groups_menus")
                                    ->join("menus","groups_menus.id_menus = menus.id")
                                    ->where("groups_menus.id_groups",$id_groups)
                                    ->where("menus.is_active",1)
                                    ->where("menus.is_parent",$id_menu)
                                    ->get();
    if ($cek_menu->num_rows() > 0) {
        return true;
    } else {
        return false;
    }
}
