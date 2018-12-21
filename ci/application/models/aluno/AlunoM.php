<?php
/**
 * Created by PhpStorm.
 * User: Layana
 * Date: 18/11/2018
 * Time: 17:59
 */

class AlunoM extends CI_Model
{

	/*get alunos do banco*/
	public function get_aluno(){

		//verifica se a transação no banco aconteceu inteira, senão cancela a transação
		$this->db->trans_start();

		$sql = "SELECT al.id as id_aluno, al.nome, al.valor, ute.valor as valor_utensilio 
				FROM aluno as pro 
				INNER JOIN utensilio as ute ON pro.FK_Utensilio_id = ute.id
				WHERE pro.status = 1";

		$query = $this->db->query($sql);

		$alunos = $query->result();

		$this->db->trans_complete();

		if($this->db->trans_status() === FALSE){
			return array("status"=>"error","message"=>"Erro ao carregar alunos.");
		}else{
			return $alunos;
		}

	}
}
