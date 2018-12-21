<?php

/**
 * Created by PhpStorm.
 * User: Gabriel Coplas Becher
 * Date: 12/09/2018
 * Time: 18:30
 */
class LoginC extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->library('encrypt');//biblioteca usada para criptorafar e descriptografar a senha
    }

    public function index()
    {
        $this->load->view('login_view');
    }

//cria a sessão para um usuário se o login estiver correto
    public function login_aluno()
    {

        $this->load->model('LoginM');

        //dados recebidos via post
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body);

        if (!array_key_exists('email', $data) ||
            $data->email == '' ||
            $data->email == null ||
            strlen(trim($data->email)) == 0 ||
            !array_key_exists('senha', $data) ||
            $data->senha == '' ||
            $data->senha == null ||
            strlen(trim($data->senha)) == 0

        ) {
            $message = array("status" => "info", "message" => "Preencha todos os campos para realizar o login");
            echo json_encode($message);
            return;
        } else {

            //trim remove todos os não digitos dele (remove ponto, traços, etc)
            $email = trim($data->email);
            $senha = trim($data->senha);


            //chama a função que vai fazer a select no bd
            $response = $this->LoginM->login_aluno($email, $senha);

            //se tiver o usuário no banco de dados vai criar a sessão
            if ($response["status"] === "success") {
                $cod_aluno = $response["cod_aluno"];
                //create session
                $data = array(
                    'logged_in' => true,
                    'cod_aluno' => $cod_aluno
                );
                $this->session->set_userdata($data);
                $message = array("status" => "success");
                //senão retorna mensagem de erro
            } else {
                $message = array("status" => "error", "message" => "Email ou senha não está correta");
            }
            echo json_encode($message);
        }
    }

    public function logout(){
        $this->session->sess_destroy();
        $message = array("status"=>"success", "message" => "logout realizado com sucesso");
        echo json_encode ($message);
    }

}