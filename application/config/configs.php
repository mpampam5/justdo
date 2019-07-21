<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// author:mpampam.com
// email:mpampam5@gmail.com
// fb:https://facebook.com/mpampam



$config['author'] = 'mpampam';


//base_url
$config['base_url'] = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
$config['base_url'] .= "://".$_SERVER['HTTP_HOST'];
$config['base_url'] .= preg_replace('@/+$@','',dirname($_SERVER['SCRIPT_NAME']));


//temp backend
$config['sty_back'] = $config['base_url']."/temp/backend/";

$config['sty_login']= $config['base_url']."/temp/login/";
