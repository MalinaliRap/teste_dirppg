<?php

/**
 * Created by PhpStorm.
 * User: Gabriel Coplas Becher
 * Date: 12/09/2018
 * Time: 20:06
 */
class SenhaC extends CI_Controller
{

    public function __construct(){
        parent::__construct();
        $this->load->library('encrypt');//biblioteca usada para criptorafar e descriptografar a senha
        //$this->load->library('email');//biblioteca usada para email
    }

    public function recuperar_senha_view(){
        $this->load->view('recuperar_senha_view');
    }

    /*Envia token por email para o usuário*/
    private function enviar_token_por_email($email, $token){

        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.utfpr.edu.br',
            'smtp_port' => 465,
            'smtp_user' => 'sistemasdirppg-pg@utfpr.edu.br',
            'smtp_pass' => 'utfpr@2018',
            'mailtype'  => 'html',
            'charset'   => 'utf-8'
        );
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");

        $this->email->from('sistemasdirppg-pg@utfpr.edu.br', 'REPFARMA');
        $this->email->reply_to('no-reply@utfpr.edu.br', 'REPFARMA');
        $this->email->to($email);
        $this->email->subject('Código de recuperação');

        $this->email->message("Olá prezado(a), <br><br>

            <img src='https://repfarma.com/wp-content/uploads/2017/04/repfarma-logo-bbdb82167217819a89e4c4bce8d4e46688173deaaca9b8e9a641ce92dab38590.png'>
            <br><br>
                       
            Seu token de recuperação é : <b>$token </b> <br><br>");

        return $this->email->send();//return true or false
    }

    /*Envia a senha por email para o usuário*/
    private function enviar_senha_por_email($email, $senha){

        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.utfpr.edu.br',
            'smtp_port' => 465,
            'smtp_user' => 'sistemasdirppg-pg@utfpr.edu.br',
            'smtp_pass' => 'utfpr@2018',
            'mailtype'  => 'html',
            'charset'   => 'utf-8'
        );
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");

        $this->email->from('sistemasdirppg-pg@utfpr.edu.br', 'REPFARMA');
        $this->email->reply_to('no-reply@utfpr.edu.br', 'REPFARMA');
        $this->email->to($email);
        $this->email->subject('Nova senha');

        $this->email->message("Olá prezado(a), <br><br>

            <img src='https://repfarma.com/wp-content/uploads/2017/04/repfarma-logo-bbdb82167217819a89e4c4bce8d4e46688173deaaca9b8e9a641ce92dab38590.png'>
            <br><br>
                      
            Sua nova senha é: <b>$senha</b><br><br>");

        return $this->email->send();//return true or false
    }


    public function envia_token(){

        // recebe os dados via post e guarda em $data
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body);

        //verifica campos vazios
        if (!array_key_exists('email', $data) ||
            $data->email == '' ||
            $data->email == null ||
            strlen(trim($data->email)) == 0){
            $message = array("status"=>"error","message"=>"Insira seu email");
            echo json_encode ($message);
            return;
        }

        // tira espaços vazios
        $email = trim($data->email);

        //carrega model
        $this->load->model('SenhaM');

        //pega a senha criptografada e guarda em $senha_criptografada
        $senha_criptografada = $this->SenhaM->get_senha_staff($email);

        //gera token aleatóriamente
        $token = $this->getStringRandom(10,true,true,false);

        //se existir o usuário com o email inserido entra no laço
        if ($senha_criptografada != null){

            //salva token no banco
            $this->SenhaM->salvar_token($token,$email);
            if ($this->enviar_token_por_email($email, $token)){
                $message = array("status"=>"success","message"=>"Informações enviadas por email");
                echo json_encode ($message);
                return;
            }else{
                $message = array("status"=>"error","message"=>"Erro ao enviar email");
                echo json_encode ($message);
                return;
            }

        }else{
            $message = array("status"=>"error","message"=>"Email não registrado");
            echo json_encode ($message);
            return;
        }

    }

    public function recuperar_senha(){
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body);

        if (!array_key_exists('token', $data) ||
            $data->token == '' ||
            $data->token == null ||
            strlen(trim($data->token)) == 0){
            $message = array("status"=>"error","message"=>"Entre com o código de recuperação");
            echo json_encode ($message);
            return;
        }

        $email = trim($data->email);
        $token = trim($data->token);

        $this->load->model('SenhaM');

        //verifica o ultimo token
        $token_bd = $this->SenhaM->get_token($email);

        if($token_bd === false){
            $message = array("status"=>"error","message"=>"Try submit first");
            echo json_encode ($message);
            return;
        }

        if ($token_bd === $token){

            $nova_senha = $this->getStringRandom(8,true,true,true);

                $this->SenhaM->update_senha_staff($email,$nova_senha);

            if ($this->enviar_senha_por_email($email, $nova_senha)){
                $message = array("status"=>"success","message"=>"Nova senha enviada por email");
                echo json_encode ($message);
                return;
            }else{
                $message = array("status"=>"error","message"=>"Erro ao enviar email");
                echo json_encode ($message);
                return;
            }

        }else{
            $message = array("status"=>"error","message"=>"Tente enviar novamente");
            echo json_encode ($message);
            return;
        }

    }

    public function gerarNovaSenha(){
        $nova_senha = $this->getStringRandom(8,true,true,true);
        echo json_encode($nova_senha);
        return;

    }

    private function getStringRandom ($tamanho = 8, $maiusculas = true, $numeros = true, $simbolos = true)
    {
        $lmin = 'abcdefghijklmnopqrstuvwxyz';
        $lmai = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $num = '1234567890';
        $simb = '!@#$%*-';
        $retorno = '';
        $caracteres = '';
        $caracteres .= $lmin;
        if ($maiusculas) $caracteres .= $lmai;
        if ($numeros) $caracteres .= $num;
        if ($simbolos) $caracteres .= $simb;
        $len = strlen($caracteres);
        for ($n = 1; $n <= $tamanho; $n++) {
            $rand = mt_rand(1, $len);
            $retorno .= $caracteres[$rand-1];
        }
        return $retorno;
    }

    public function alterar_senha(){
        if (!is_logged_in()){
            $message = array("status"=>"error","message"=>"Acesso Negado");
            echo json_encode ($message);
            return;
        }

        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body);

        if (!array_key_exists('senha_atual', $data) ||
            !array_key_exists('nova_senha', $data) ||
            !array_key_exists('confirmacao_senha', $data) ||
            $data->senha_atual == '' ||
            $data->senha_atual == null ||
            $data->nova_senha == '' ||
            $data->nova_senha == null ||
            $data->confirmacao_senha == '' ||
            $data->confirmacao_senha == null){
            $message = array("status"=>"error","message"=>"Dados obrigatórios não preenchidos");
            echo json_encode ($message);
            return;
        }else if (strlen($data->nova_senha) < 8){
            $message = array("status"=>"error","message"=>"Nova senha precisa conter pelo menos 8 caracteres");
            echo json_encode ($message);
            return;
        }else if ($data->nova_senha !== $data->confirmacao_senha){
            $message = array("status"=>"error","message"=>"Confirmar senha está incorreto, tente novamente");
            echo json_encode ($message);
            return;
        }

        $this->load->model('SenhaM');
        $nova_senha =  $data->nova_senha;
        $senha_atual = $data->senha_atual;

        if ($this->session->has_userdata('cod_admin')){//alterar a senha do secretario
            $cod_secretario =  $this->session->userdata('cod_admin');
            $message = $this->SenhaM->alterar_senha_secretario($cod_secretario, $senha_atual, $nova_senha);
            echo json_encode ($message);
            return;
        }else if ($this->session->has_userdata('cod_aluno')) {//alterar a senha do aluno
            $cod_aluno = $this->session->userdata('cod_aluno');
            $message = $this->SenhaM->alterar_senha_aluno($cod_aluno, $senha_atual, $nova_senha);
            echo json_encode($message);
            return;
        }else{
            $message = array("status"=>"error","message"=>"Erro ao alterar a senha, nenhum usuário encontrado");
            echo json_encode ($message);
            return;
        }

    }


}