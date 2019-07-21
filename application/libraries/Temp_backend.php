<?php if(!defined('BASEPATH')) exit('No direct script access allowed');


class Temp_backend{

  private $CI;

  private $temp_title = null ;


  function __construct()
  {
    $this->CI =& get_instance();
  }

  public function set_title($title)
  {
    $this->temp_title = $title;
  }


  public function  view($view_name, $params = array(),$default=true)
  {
    $uri = $this->CI->uri->segment(2);
    if ($this->_cekList($uri)!=true) {
        $this->CI->session->set_flashdata("uri",site_url("backend/$uri"));
        $header_params['temp_title']='Error 403. Page Not Permission';
        $this->CI->load->view('backend/header',$header_params);
        $this->CI->load->view('backend/error/error403');
        $this->CI->load->view('backend/footer');
    } else {
        if ($default) {
            $header_params['temp_title'] = $this->temp_title;
            $this->CI->load->view('backend/header',$header_params);
            // $this->CI->load->view(config_item("cpanel").'sidebar',$header_params);
            $this->CI->load->view($view_name,$params);
            $this->CI->load->view('backend/footer');
        }else {
          $this->CI->load->view($view_name,$params);
        }
    }


  }

  function _cekList($uri)
    {
        $id_groups = $this->CI->session->userdata("id_groups");
        $cek_menu = $this->CI->db->select(' groups_menus.id,
                                            groups_menus.id_groups AS id_groups,
                                            groups_menus.id_menus AS id_menus,
                                            groups.id_groups AS id_group,
                                            menus.id AS id,
                                            menus.url,
                                            menus.is_active')
                                    ->from("groups_menus")
                                    ->join("groups","groups_menus.id_groups = groups.id_groups")
                                    ->join("menus","groups_menus.id_menus = menus.id")
                                    ->where("groups.id_groups",$id_groups)
                                    ->like("menus.url","$uri")
                                    ->get();
        if ($cek_menu->num_rows() > 0) {
            return true;
        } else {
            return false;
        }

    }




}
