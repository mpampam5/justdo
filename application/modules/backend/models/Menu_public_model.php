<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Menu_public_model extends MY_Model{

  private $table = "menu_public";

  function get_data()
  {
    return $this->db->query("SELECT * FROM $this->table ORDER BY sort ");
  }


}
