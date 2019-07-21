<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/* modules/backend/models/Category_model.php */
/* MPAMPAM CRUD GENERATOR */
/* PENGEMBANG : MPAMPAM */
/* EMAIL : MPAMPAM5@GMAIL.COM */
/* FACEBOOK : https://www.facebook.com/mpampam */
/* DIBUAT OLEH MPAMPAM CRUD GENERTOR 2019-05-17 15:33:30 */
/* https://mpampam.com */
/* DI GUNAKAN OLEH USER Muhammad ippank */


class Category_model extends MY_Model{

	private $table = "category";


	function json()
	{
		$this->datatables->select('id_category,category,delete');
		$this->datatables->from($this->table);
    $this->datatables->where('delete','0');
    $this->datatables->add_column('action',
                                  '
                                  <a href="'.site_url("backend/category/update/$1").'" id="update" class="btn btn-link p-a-5 text-warning" data-toggle="tooltip" data-placement="bottom" title="Edit"><i class="fa fa-pencil"></i></a>
                                  <a href="'.site_url("backend/category/delete/$1").'" id="hapus" class="btn btn-link p-a-5 text-danger" data-toggle="tooltip" data-placement="bottom" title="Hapus"><i class="fa fa-trash"></i></a>',
                                  'id_category');
    return $this->datatables->generate();
	}


	// <a href="'.site_url("backend/category/detail/$1").'" id="detail" class="btn btn-link p-a-5 text-info" data-toggle="tooltip" data-placement="bottom" title="Detail"><i class="fa fa-file"></i></a>




} /*End Class Category_model*/
