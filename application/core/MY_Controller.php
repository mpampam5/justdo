<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller{

  public function __construct()
  {
    parent::__construct();

  }


}


/**
 * BACKEND
 */
class Backend extends CI_Controller
{

  function __construct()
  {
    parent::__construct();

    if ($this->session->userdata('logged-in')!=true OR $this->session->userdata('logged-in')==null) {
      redirect('adm-panel','refresh');
    }else {
      $this->load->library(array('temp_backend','form_validation'));
      $this->load->helper(array('backend','menuheader'));
    }
  }

  function _error404()
  {
    $this->temp_backend->set_title('Error 404. Page Not Found');
    $this->temp_backend->view('backend/error/error404');
  }

  function _error403()
  {
    $this->temp_backend->set_title('Error 403. Page Not Permission');
    $this->temp_backend->view('backend/error/error403');
  }



} //end Class Backend



/**
 * FRONTEND CLASS
 */
class Front extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->config('frontend_config');
    $this->load->helper(array('frontend/front'));
    $this->load->library(array('frontend/template','frontend/meta_tags'));
  }


  function _error404()
  {
    $this->template->set_title('Error 404. Page Not Found');
    $this->template->view('frontend/error/error404');
  }

}
