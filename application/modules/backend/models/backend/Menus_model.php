<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Menus_model extends MY_Model{

  private $table = "menus";

  function get_data()
  {
    return $this->db->query("SELECT * FROM $this->table ORDER BY sort ");
  }


}
