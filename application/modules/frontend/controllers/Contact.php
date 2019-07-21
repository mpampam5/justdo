<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends Front{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  function index()
  {
    $this->template->set_title("Contact | ".setting('title'));
    $this->meta_tags->set_meta_tag('description', setting('title').' '.setting('alamat').'.Telepon '.setting('telepon'));
    $this->template->view("contact/index");
  }

}
