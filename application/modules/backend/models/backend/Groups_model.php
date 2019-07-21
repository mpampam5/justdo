<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Groups_model extends MY_Model{

  var $table = 'groups';


  function json()
  {
    $this->datatables->select('id_groups,name');
    $this->datatables->from($this->table);
    $this->datatables->add_column('action',
                                  '<a href="'.site_url("backend/$this->table/detail/$1").'" class="btn btn-link p-a-5 text-info" data-toggle="tooltip" data-placement="bottom" title="Detail"><i class="fa fa-file"></i></a>
                                  <a href="'.site_url("backend/$this->table/edit/$1").'" class="btn btn-link p-a-5 text-warning" data-toggle="tooltip" data-placement="bottom" title="Edit"><i class="fa fa-pencil"></i></a>
                                  <a href="'.site_url("backend/$this->table/hapus/$1").'" id="hapus" class="btn btn-link p-a-5 text-danger" data-toggle="tooltip" data-placement="bottom" title="Hapus"><i class="fa fa-trash"></i></a>'
                                  ,'id_groups');
    return $this->datatables->generate();
  }



}
