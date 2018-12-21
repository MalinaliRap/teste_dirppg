<?php
/**
 * Created by PhpStorm.
 * User: Daniel
 * Date: 31/10/2017
 * Time: 11:11
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//Retorna a senha criptografada
function criptografar($senha) {
    $senha = crypt($senha, '$2a$05$5b3IlU2Y2gIqNct5CTf3oA$');
    return $senha;
}