<?php defined('BASEPATH') OR exit('No direct script access allowed');

function pass_encrypt($str,$key)
{
    $ecrypt = password_hash($str."".$key,PASSWORD_DEFAULT);
    return $ecrypt;
}

function pass_decrypt($str,$key,$hash)
{
    if (password_verify($str."".$key, $hash)) {
        return true;
    }
    else {
        return false;
    }
}