<?php
/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 01/10/18
 * Time: 19:19
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//helper colocada em autoload.php
//para carregar ela tirar o _helper do nome do arquivo

function path_upload_dir() {
    $PATH_UPLOAD_DIR = "../upload/";
    if(!is_dir($PATH_UPLOAD_DIR)) {
        //var_dump("Diretório upload criado no mesmo diretório que ci");
        return null;
    }
    return $PATH_UPLOAD_DIR;
}

/*
 Cada aluno tem uma pasta. Caso ela não exista, ela é criada*/
function get_upload_folder_por_aluno($cod_aluno){
    $pasta_aluno = path_upload_dir()."aluno_".$cod_aluno."/";

    if ($pasta_aluno == null){
        return null;
    }

    if(is_dir($pasta_aluno)) {
       return $pasta_aluno;//pasta ja existe
    }else{//cria pasta, pois ela nao existe ainda
        mkdir($pasta_aluno, 0775);//0770: Tudo para o proprietario e grupo, leitura e execucao para os outros
    }

    if (is_dir($pasta_aluno)){
        return $pasta_aluno;
    }else{
        return array("status"=>"error","message"=>"Erro ao salvar arquivo, permissão negada.");
    }
}

//gera id unico com 32 caracteres para nomear o arquivo e prevenir acesso direto aos arquivos pela url
function get_unique_file_name(){
    $id_unico = md5(uniqid(rand(), true)).md5(uniqid(rand(), true));
    $id_unico = str_replace ('.', 'a', $id_unico );//remove pontos do id
    $id_unico = substr ($id_unico, 0, 32);//deixa o id com 32 caracteres
    $id_unico = strtoupper($id_unico);
    return $id_unico;
}

//----------------validate pdf files-------------------------------------------------------------------
function is_arquivo_sem_erro($arquivos){

    foreach($arquivos as $cod_tipo_documento => $file){
        if ($file['error'] != 0){//Value: 0; There is no error, the file uploaded with success.
            return array("status"=>"error","message"=>"File error: porfavor insira outro arquivo que não esteja corrompido");
        }
    }
    return true;
}

function is_extensao_arquivo_valido($arquivos){
    foreach($arquivos as $cod_tipo_documento => $file){
        if (strcmp($file['type'], 'image/png') != 0){
            return array("status"=>"error","message"=>"O arquivo precisa ser uma imagem");
        }
    }
    return true;
}

function is_mime_type_arquivo_valido($arquivos){
    foreach($arquivos as $cod_tipo_documento => $file){
        if (strcmp(mime_content_type($file['tmp_name']), 'image/png') != 0){
            return array("status"=>"error","message"=>"É necessário um formato de imagem válido");
        }
    }
    return true;
}