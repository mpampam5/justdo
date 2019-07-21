<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/* modules/backend/models/Page_model.php */
/* MPAMPAM CRUD GENERATOR */
/* PENGEMBANG : MPAMPAM */
/* EMAIL : MPAMPAM5@GMAIL.COM */
/* FACEBOOK : https://www.facebook.com/mpampam */
/* DIBUAT OLEH MPAMPAM CRUD GENERTOR 2019-05-24 02:03:42 */
/* https://mpampam.com */
/* DI GUNAKAN OLEH USER Muhammad ippank */


class Page_model extends MY_Model{

	private $table = "page";


	function json()
	{
		$this->datatables->select('id_halaman,title,slug,deskripsi,image,created_at,update_at,delete');
		$this->datatables->from($this->table);
		$this->datatables->where("delete",'0');
    $this->datatables->add_column('action',
                                  '<a href="'.site_url("backend/page/detail/$1").'" id="detail" class="btn btn-link p-a-5 text-info" data-toggle="tooltip" data-placement="bottom" title="Detail"><i class="fa fa-file"></i></a>
                                  <a href="'.site_url("backend/page/update/$1").'" id="update" class="btn btn-link p-a-5 text-warning" data-toggle="tooltip" data-placement="bottom" title="Edit"><i class="fa fa-pencil"></i></a>
                                  <a href="'.site_url("backend/page/delete/$1").'" id="hapus" class="btn btn-link p-a-5 text-danger" data-toggle="tooltip" data-placement="bottom" title="Hapus"><i class="fa fa-trash"></i></a>',
                                  'id_halaman');
    return $this->datatables->generate();
	}




} /*End Class Page_model*/
