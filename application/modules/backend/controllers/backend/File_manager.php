<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class File_manager extends Backend{

  // var $path = "./temp/img_manager/";
  public function __construct()
  {
    parent::__construct();
    $this->load->helper('file');
  }

  function index($str)
  {
    $this->temp_backend->set_title('Group');
    $data['str'] = $str;
    $data['filess'] = get_filenames("./temp/img_manager/$str/thumbs/");
    $this->temp_backend->view('backend/backend/file_manager/index',$data,false);
  }

  function json($str)
  {
    $files = get_filenames("./temp/img_manager/$str/thumbs/");
    if (count($files)!=0) {
      foreach ($files as $row) {
        if (pathinfo($row, PATHINFO_EXTENSION)=="jpg" || pathinfo($row, PATHINFO_EXTENSION)=="png" || pathinfo($row, PATHINFO_EXTENSION)=="PNG" || pathinfo($row, PATHINFO_EXTENSION)=="JPG") {
          $img[] = [
                    '<p><a data-fancybox="gallery" class="text-info" href="'.base_url().'/temp/img_manager/'.$str.'/'.$row.'"> '.$row.'</a>
                                  </p><a href="'.base_url().'backend/file_manager/remove_img/'.$str.'/'.$row.'" class="text-danger" id="remove_image" style="font-size:11px"><i class="fa fa-close"></i>Hapus</a>',
                    $this->formatSizeUnits(filesize("./temp/img_manager/$str/$row")),
                    '<a title="'.$row.'" class="btn btn-sm btn-info text-white" id="pilih-img"><i class="fa fa-check-square"></i> pilih</a>'
                   ];
        }

      }
    }else {
      $img[]=[null,null,null,null];
    }


    // $data['recordsFiltered'] = count($files);
    // $data['recordsTotal'] = count($files);
    $data['data'] = $img;


    echo json_encode($data);
  }


  function formatSizeUnits($bytes)
    {
        if ($bytes >= 1073741824)
        {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        }
        elseif ($bytes >= 1048576)
        {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        }
        elseif ($bytes >= 1024)
        {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        }
        elseif ($bytes > 1)
        {
            $bytes = $bytes . ' bytes';
        }
        elseif ($bytes == 1)
        {
            $bytes = $bytes . ' byte';
        }
        else
        {
            $bytes = '0 bytes';
        }
        return $bytes;
      }


      function remove_img($str,$img)
      {
        if ($this->input->is_ajax_request()) {
            if (!file_exists("./temp/img_manager/$str/thumbs/$img")) {
              $json['alert_info'] = '<div class="text-alert text-danger">
                                      <i class="fa fa-close"></i> Gagal Menghapus
                                    </div>';
            }else {
              unlink("./temp/img_manager/$str/thumbs/$img");
              if (!file_exists("./temp/img_manager/$str/$img")) {
                unlink("./temp/img_manager/$str/$img");
              }
              $json['alert_info'] = '<div class="text-alert text-success">
                                      <i class="fa fa-check"></i> Berhasil Menghapus
                                    </div>';
            }
            $json['success'] = true;

            echo json_encode($json);
        }
      }


      function do_upload($str)
      {
        if ($this->input->is_ajax_request()) {

            $image = date('dmYhis')."_".substr(url_title($_FILES['file']['name'],'dash',true),0,15)."_".$str.".".pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);

            $config['upload_path'] = "./temp/img_manager/$str";
            $config['allowed_types'] = 'png|jpg';
            $config['overwrite'] = true;
            $config['max_size']  = '1024';
            $config['file_name']  = "$image";


            $this->load->library('upload', $config);

            if ( ! $this->upload->do_upload('file')){
                $msg = '<div  class="text-alert text-danger">
                          <i class="fa fa-check"></i> File tidak valid, pastikan extensi file PNG,JPG & ukuran max 1mb.
                        <div>';

            } else{
               $upload_data = $this->upload->data();
               $config2['image_library'] = 'gd2';
               $config2['source_image'] = "./temp/img_manager/$str/".$upload_data['file_name'];
               $config2['new_image'] = "./temp/img_manager/$str/thumbs";
               $config2['create_thumb'] = false;
               $config2['maintain_ratio'] = TRUE;
               $config2['width']         = 200;
               $config2['height']       = 200;
               $this->load->library('image_lib', $config2);
               if (!$this->image_lib->resize()) {

               $msg = '<div  class="text-alert text-danger">
                         <i class="fa fa-close"></i> File tidak valid, pastikan extensi file PNG,JPG & ukuran max 1mb.
                       <div>';
               }else {
                 $msg = '<div  class="text-alert text-success">
                           <i class="fa fa-check"></i> Gambar Berhasil Di Upload.
                         <div>';
               }



            }
            echo json_encode(array('msg'=>$msg));
        }
      }










}
