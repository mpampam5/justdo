<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends MY_Model 
{
    private $table = "users"; 

    function json()
    {
        $this->datatables->select(' users_groups.id_users_groups,
                                    users_groups.id_users AS id_user,
                                    users_groups.id_groups,
                                    users.id_users AS id_users,
                                    users.first_name,
                                    users.last_name,
                                    users.email,
                                    users.username,
                                    DATE_FORMAT(users.last_login,"%d/%m/%Y %h:%i") as last_login,
                                    users.active,
                                    groups.id_groups,
                                    groups.name'
                                );
        $this->datatables->from("users_groups");
        $this->datatables->join("users","users_groups.id_users=users.id_users","left");
        $this->datatables->join("groups","users_groups.id_groups=groups.id_groups","left");
        $this->datatables->add_column('action',
                                    '<a href="'.site_url("backend/$this->table/detail/$1").'" class="btn btn-link p-a-5 text-info" data-toggle="tooltip" data-placement="bottom" title="Detail"><i class="fa fa-file"></i></a>
                                    <a href="'.site_url("backend/$this->table/edit/$1").'" class="btn btn-link p-a-5 text-warning" data-toggle="tooltip" data-placement="bottom" title="Edit"><i class="fa fa-pencil"></i></a>
                                    <a href="'.site_url("backend/$this->table/hapus/$1").'" id="hapus" class="btn btn-link p-a-5 text-danger" data-toggle="tooltip" data-placement="bottom" title="Hapus"><i class="fa fa-trash"></i></a>'
                                    ,'id_users');
        return $this->datatables->generate();
    }


    function get_where_join($table,$where)
    {
        return $this->db->select('  users_groups.id_users_groups,
                                    users_groups.id_users AS id_user,
                                    users_groups.id_groups,
                                    users.id_users AS id_users,
                                    users.first_name,
                                    users.last_name,
                                    users.email,
                                    users.phone,
                                    users.username,
                                    users.active,
                                    groups.id_groups,
                                    groups.name')
                        ->from($table)
                        ->join("users","users_groups.id_users=users.id_users","left")
                        ->join("groups","users_groups.id_groups=groups.id_groups","left")
                        ->where($where)
                        ->get()
                        ->row();
    }
}
