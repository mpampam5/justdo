<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/* modules/backend/models/Media_foto_model.php */
/* MPAMPAM CRUD GENERATOR */
/* PENGEMBANG : MPAMPAM */
/* EMAIL : MPAMPAM5@GMAIL.COM */
/* FACEBOOK : https://www.facebook.com/mpampam */
/* DIBUAT OLEH MPAMPAM CRUD GENERTOR 2019-07-11 14:52:28 */
/* https://mpampam.com */
/* DI GUNAKAN OLEH USER  */


class Media_foto_model extends MY_Model{
    
	private $table = "media_foto";


	function json()
	{
		$this->datatables->select('id,image_name,image,description,created_at,update_at');
		$this->datatables->from($this->table);
    $this->datatables->add_column('action',
                                  '<a href="'.site_url("backend/media_foto/detail/$1").'" id="detail" class="btn btn-link p-a-5 text-info" data-toggle="tooltip" data-placement="bottom" title="Detail"><i class="fa fa-file"></i></a>
                                  <a href="'.site_url("backend/media_foto/update/$1").'" id="update" class="btn btn-link p-a-5 text-warning" data-toggle="tooltip" data-placement="bottom" title="Edit"><i class="fa fa-pencil"></i></a>
                                  <a href="'.site_url("backend/media_foto/delete/$1").'" id="hapus" class="btn btn-link p-a-5 text-danger" data-toggle="tooltip" data-placement="bottom" title="Hapus"><i class="fa fa-trash"></i></a>',
                                  'id');
    return $this->datatables->generate();
	}




} /*End Class Media_foto_model*/