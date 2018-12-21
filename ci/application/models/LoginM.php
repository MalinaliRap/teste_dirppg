<?php
/**
 * Created by PhpStorm.
 * User: Daniel
 * Date: 20/04/2017
 * Time: 12:06
 */

class LoginM extends CI_Model {


    public function login_aluno ($email, $senha){


        $sql = "SELECT s.id,
                       s.senha,
                       s.email
                  FROM aluno a
                 WHERE a.email like ? AND status != ?";
        $query = $this->db->query($sql, array($email, ATIVO));

        if($query->num_rows() > 0){//Se existir algum resultado entra no laço
            $row = $query->row();
            $cod_aluno = $row->id;
            $senha_criptografada = $row->senha;
            //echo criptografar($senha);
            if ($senha_criptografada == criptografar($senha)){

                    return array("status"=>"success", "tipo_admin"=>"admin", "cod_aluno"=>$cod_aluno);

            }
        }
        return array("status"=>"error","message"=>"Email ou senha incorreto");
    }

}