<?php
/**
 * Created by PhpStorm.
 * User: Daniel
 * Date: 20/04/2017
 * Time: 12:06
 */

class SenhaM extends CI_Model {

    public function get_senha_staff($email){
        $this->db->select('senha');
        $this->db->from('staff');
        $this->db->where('email', $email);
        $query = $this->db->get();
        $dados_avaliador = $query->result();

        if (!empty($dados_avaliador)){
            return ($dados_avaliador[0]->senha);//retorna a senha do avaliador
        }else{
            return false;
        }
    }

    public function alterar_senha_staff($cod_staff, $senha_atual, $nova_senha){
        $this->db->select('senha');
        $this->db->from('staff');
        $this->db->where('id', $cod_staff);
        $query = $this->db->get();
        $dados_staff= $query->result();

        if (!empty($dados_staff)){
            $senha =  $dados_staff[0]->senha;
            if ($senha === criptografar($senha_atual)){//senha atual confere
                $nova_senha_criptografada = criptografar($nova_senha);

                $this->db->set('senha', $nova_senha_criptografada);
                $this->db->where('id', $cod_staff);//condicao do update
                $this->db->update('staff');

                $error = $this->db->error();
                if ($error['message'] != ''){
                    return array("status"=>"error","message"=>"Erro ao atualizar senha.");
                }else{
                    return array("status"=>"success", "message"=>"Senha alterada com sucesso");
                }
            }else{
                return array("status"=>"error","message"=>"Senha atual incorreta");
            }
        }else{
            return array("status"=>"error","message"=>"Erro ao alterar senha, aluno não encontrado");
        }
    }

    public function salvar_token($token,$email){
        $sql = "INSERT INTO recuperar_senha(token,email) VALUES (?,?);  
        ";
        $this->db->query($sql, array($token,$email));

        $error = $this->db->error();
        if ($error['message'] != ''){
            return array("status"=>"error","message"=>"Erro ao salvar token");
        }

        return array("status"=>"success");

    }

    public function get_token($email){
        $sql = "SELECT token 
                FROM recuperar_senha 
                WHERE email = ? 
                ORDER BY id
                DESC LIMIT 1";
        $query = $this->db->query($sql, array($email));
        $token = $query->result();

        if (!empty($token)){
            return ($token[0]->token);//retorna a senha de administrador
        }else{
            return false;
        }
    }

    public function update_senha_staff($email,$senha){
        $senha = criptografar($senha);
        $sql = "UPDATE staff 
                SET
                senha = ?
                WHERE
                email = ?      
        ";
        $this->db->query($sql, array($senha,$email));

        $error = $this->db->error();
        if ($error['message'] != ''){
            return array("status"=>"error","message"=>"Erro ao atualizar senha");
        }

        return array("status"=>"success");

    }

}