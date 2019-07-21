<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pengaturan_model extends MY_Model{

    function get_profile_umum($table,$where)
    {
        if ($row=$this->db->get_where($table,$where)->row()) {
            $output = '<table class="table  table-borderless">
            <tr>
                <th width="200">Title</th>
                <td>: '.$row->title.'</td>
            </tr>

            <tr>
                <th>Domain</th>
                <td class="text-info">: '.$row->domain.'</td>
            </tr>

            <tr>
                <th>Telepon</th>
                <td>: '.$row->telepon.'</td>
            </tr>

            <tr>
                <th>Alamat</th>
                <td>: '.$row->alamat.'</td>
            </tr>
        </table>
        <hr>';

        $output.='<a href="'.site_url("backend/pengaturan/umum_form").'" id="editumum" class="m-t-10 badge badge-warning "><i class="fa fa-pencil-square-o"></i> Edit</a>';
        } else {
            $output = '<h5 class="text-center text-danger"> data load db error.</h5>';
        }
        
        return $output;
    }


}