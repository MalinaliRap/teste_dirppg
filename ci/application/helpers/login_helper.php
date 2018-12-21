<?php
/**
 * Created by PhpStorm.
 * User: daniel
 * Date: 21/04/17
 * Time: 01:39
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//helper colocada em autoload.php
//para carregar ela tirar o _helper do nome do arquivo
function is_logged_in() {
    $CI =& get_instance();
    $status = $CI->session->userdata('logged_in');
    if (!isset($status)) {
        return false;
    }else {
        return true;
    }
}