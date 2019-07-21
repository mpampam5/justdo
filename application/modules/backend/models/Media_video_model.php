<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/* modules/backend/models/Media_video_model.php */
/* MPAMPAM CRUD GENERATOR */
/* PENGEMBANG : MPAMPAM */
/* EMAIL : MPAMPAM5@GMAIL.COM */
/* FACEBOOK : https://www.facebook.com/mpampam */
/* DIBUAT OLEH MPAMPAM CRUD GENERTOR 2019-06-21 03:27:32 */
/* https://mpampam.com */
/* DI GUNAKAN OLEH USER Muhammad ippank */


class Media_video_model extends MY_Model{
    
	private $table = "media_video";


	function json()
	{
		$this->datatables->select('id,judul,url');
		$this->datatables->from($this->table);
    $this->datatables->add_column('action',
                                  '<a href="'.site_url("backend/media_video/detail/$1").'" id="detail" class="btn btn-link p-a-5 text-info" data-toggle="tooltip" data-placement="bottom" title="Detail"><i class="fa fa-file"></i></a>
                                  <a href="'.site_url("backend/media_video/update/$1").'" id="update" class="btn btn-link p-a-5 text-warning" data-toggle="tooltip" data-placement="bottom" title="Edit"><i class="fa fa-pencil"></i></a>
                                  <a href="'.site_url("backend/media_video/delete/$1").'" id="hapus" class="btn btn-link p-a-5 text-danger" data-toggle="tooltip" data-placement="bottom" title="Hapus"><i class="fa fa-trash"></i></a>',
                                  'id');
    return $this->datatables->generate();
	}




} /*End Class Media_video_model*/