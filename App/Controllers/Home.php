<?php

namespace App\Controllers;

use \App\Core\Controller;
use \App\Models\Dao\DaoAlunos;


class Home extends Controller
{

    public function index()
    {

        //    $dao = $this->model('DaoArtigos');

        //   $total = $dao->Total();

        //$registros = 2;


        // $numPaginas = ceil($total/$registros);

        // $inicio = ($registros*$pagina  )-$registros;


        //  $artigo = $dao->BuscarPorCOD(1);
        //  $artigos = $dao->BuscarTodosPaginacao($inicio, $registros);

        //   $this->view->artigo = $artigo;
        //  $this->view->artigos = $artigos;
        //  $this->view->numPaginas = $numPaginas ;
        $this->render('index');
    }

    public function logar()
    {
        /** @var DaoAlunos $dao */
        $dao = $this->model('DaoAlunos');

        if ($_POST) {
            $resposta = $dao->verificaLogin($_POST['ra'], $_POST['senha']);
            var_dump($_POST['ra']);
            die();

            if ($resposta != '' and $resposta != 'NULL') {
                session_start();
                $_SESSION['aluno'] = $resposta->getIDAluno();
                $this->render('index');
                exit();
            } else {
                $this->view->message = 'RA ou senha Incorretos';
            }
        }
    }
}
