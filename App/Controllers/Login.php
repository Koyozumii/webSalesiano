<?php

use App\Core\Controller;


use App\Models\Dao\DaoAlunos;

class Login extends Controller
{
    public function index()
    {
        $this->render('index');
    }

    public function logar()
    {
        /** @var DaoAlunos $dao */
        $dao = $this->model('DaoAlunos');

        if($_POST)
        {
            $resposta = $dao->verificaLogin($_POST['ra'], $_POST['senha']);
            
            if($resposta != '' and $resposta != 'NULL')
            {
                session_start();
                $_SESSION['aluno'] = $resposta->getIDAluno();
                $this->render('index');
                exit();
            }else {
                $this->view->message = 'RA ou senha Incorretos';
            }
        }
    }
}