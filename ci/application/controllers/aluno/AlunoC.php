<?php
/**
 * Created by PhpStorm.
 * User: Gabriel Coplas Becher
 * Date: 17/11/2018
 * Time: 22:03
 */

class AlunoC extends CI_Controller
{

	public function __construct(){
		parent::__construct();
	}

	/*carrega a view do iframe com form de alunos*/
	public function index()
	{

		$this->load->view('aluno/aluno_view');

	}

	/*pega todos os alunos do banco*/
	public function get_aluno(){

		$this->load->model('aluno/AlunoM');

		$alunos = $this->AlunoM->get_aluno();

		echo json_encode($alunos);
		return;

	}


}
