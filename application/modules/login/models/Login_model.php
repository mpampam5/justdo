<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model{

    function get_login($username)
    {
        return $this->db->select('  users_groups.id_users_groups,
                                    users_groups.id_users AS id_user,
                                    users_groups.id_groups AS id_group,
                                    users.id_users AS id_users,
                                    users.first_name,
                                    users.last_name,
                                    users.email,
                                    users.username,
                                    users.password,
                                    users.key,
                                    users.active,
                                    groups.id_groups AS id_groups')
                        ->from("users_groups")
                        ->join("users","users_groups.id_users=users.id_users","left")
                        ->join("groups","users_groups.id_groups=groups.id_groups","left")
                        ->where(["username"=>"$username","active"=>"y"])
                        ->limit(1)
                        ->get();
    }

    function update_time($id_users)
    {
        return $this->db->where("id_users",$id_users)
                        ->update("users",["last_login"=>date("Y-m-d H:i:s")]);
    }

}