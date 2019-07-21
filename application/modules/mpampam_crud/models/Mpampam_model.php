<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Mpampam_model extends CI_Model{

    function get_field($table)
    {
        $fields = $this->db->field_data($table);
        $output = '<form id="form-crud-generator" action="'.site_url('mpampam_crud/action').'" >';
        $output .= '<div class="row">

                            <div class="form-group col-sm-6">
                                <label>Nama Table <i class="text-warning">*</i></label>
                                <input type="text" name="table" id="table" class="form-control" readonly value="'.$table.'">
                            </div>

                            <div class="form-group col-sm-6">
                                <label>Title <i class="text-warning">*</i></label>
                                <input type="text" class="form-control" name="title" id="title" placeholder="Title" value="'.ucwords(str_replace("_"," ",$table)).'">
                            </div>

                            <div class="form-group col-sm-6">
                                <label>Controllers <i class="text-warning">*</i></label>
                                <input type="text" class="form-control" name="controller" id="controller" placeholder="Controllers" value="'.ucfirst($table).'">
                            </div>

                            <div class="form-group col-sm-6">
                                <label>Models <i class="text-warning">*</i></label>
                                <input type="text" class="form-control" name="model" id="model" placeholder="Models" value="'.ucfirst($table).'_model">
                            </div>


                             <div class="form-group col-sm-6">
                                <label for="">Datatable</label>
                                <select name="datatabletype" id="datatabletype" class="form-control">
                                    <option value="" style="color:gray">-- pilih --</option>
                                    <option value="client">DataTable Client Side</option>
                                    <option value="server">DataTable Server Side</option>
                                </select>
                            </div>


                          <div class="form-group col-sm-12">
                            <label class="custom-control custom-checkbox custom-checkbox-primary">
                                <input type="checkbox" class="custom-control-input" value="1" name="modal">
                                <span class="custom-control-indicator"></span> Modal Bootstrap
                            </label>&nbsp;&nbsp;

                            <label class="custom-control custom-checkbox custom-checkbox-primary">
                                <input type="checkbox" class="custom-control-input" value="1" name="csv">
                                <span class="custom-control-indicator"></span> Export csv
                            </label>&nbsp;&nbsp;

                            <label class="custom-control custom-checkbox custom-checkbox-primary">
                                <input type="checkbox" class="custom-control-input" value="1" name="word">
                                <span class="custom-control-indicator"></span> Export Word
                            </label>&nbsp;&nbsp;

                            <label class="custom-control custom-checkbox custom-checkbox-primary">
                                <input type="checkbox" class="custom-control-input" value="1" name="excel">
                                <span class="custom-control-indicator"></span> Export Excel
                            </label>

                          </div>



                    </div>
                    ';
        $output .= '<table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Field</th>
                            <th>Type</th>
                            <th>Max Length</th>
                            <th>Primary Key</th>
                            <th>Required</th>
                        </tr>
                    </thead>
                    <tbody>';
        foreach ($fields as $field)
        {


            $output .='<tr>
                                <td>'.$field->name.'</td>
                                <td>'.$field->type.'</td>
                                <td>'.($field->max_length==null?"-":$field->max_length).'</td>';


            if ($field->primary_key==1) {
            $output .='<td class="text-center"><i class="fa fa-check text-success"></i></td>';
          }else {
            $output .='<td class="text-center"><i class="fa fa-close text-danger"></i></td>';
          }
            $output .=          '<td class="text-center" width="100">';
            if ($field->primary_key!=1) {
            $output .=          '<label class="custom-control custom-checkbox custom-checkbox-primary">
                                  <input type="checkbox" class="custom-control-input" value="'.$field->name.'" name="primary_key[]">
                                  <span class="custom-control-indicator"></span>
                                </label>';
                              }
            $output .=         '</td>
                        </tr>';

        }
        $output .='</tbody>
                </table>';

        $output .='<hr>
                    <button type="submit" id="submit" class="btn btn-sm btn-primary"> Crud Generator</button>
                    </form>';

        $output .='<script src="'.config_item('sty_back').'js/mpampam.js"></script>';

        return $output;
    }
}


function create()
{
    # code...
}
