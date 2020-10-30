<?php

namespace App\Controllers;

use \App\Core\Controller;
use \App\Models\Classes\Devs;

class Dev extends Controller{

    public function index($pagina = 1)
    {
        $dao = $this->model('DaoDev');

        //conta o total de itens
        $total = $dao->Total();

        //seta a quantidade de itens por página, neste caso, 2 itens
        $registros = 2;

        //calcula o número de páginas arredondando o resultado para cima
        $numPaginas = ceil($total / $registros);

        //variavel para calcular o início da visualização com base na página atual
        $inicio = ($registros * $pagina ) - $registros;


        $dev = $dao->BuscarPorCOD(1);
        $devs = $dao->BuscarTodosPaginacao($inicio, $registros);

        $this->view->dev = $dev;
        $this->view->devs = $devs;
        $this->view->numPaginas = $numPaginas;
        $this->render('index');
    }

    public function dev($id)
    {
        $dao = $this->model('DaoDev');

        $dev = $dao->BuscarPorCOD($id);

        $this->view->dev = $dev;
        $this->render('dev');
    }

    public function create() {
        $dev = new Devs();
        $dao = $this->model('DaoDev');

        if($_POST){
            $dev->setNome($_POST['nome']);
            $dev->setNascimento(date('Y-m-d',strtotime($_POST['nascimento'])));
            $dev->setNivel($_POST['nivel']);
            $dev->setCadastro(date('Y-m-d H:m:s'));

            $dao->Inserir($dev);
            $this->index(1);
            $this->render('index');
            exit();
        }

        $this->view->action = '/dev/create';
        $this->view->dev = $dev;
        $this->view->label = 'Cadastrar';
        $this->view->class_btn = 'btn btn-success';
        $this->render('form');
    }

    public function update($id)
    {
        $dev = new Devs();

        $dao = $this->model('DaoDev');
        $dev = $dao->BuscarPorCOD($id);

        if($_POST){
            $dev->setNome($_POST['nome']);
            $dev->setNascimento(date('Y-m-d',strtotime($_POST['nascimento'])));
            $dev->setNivel($_POST['nivel']);
            $dev->setCadastro(date('Y-m-d H:m:s'));
            $dev->setId($id);

            $dao->Editar($dev);
            $this->index(1);
            $this->render('index');
            exit();
        }

        $this->view->action = '/dev/update/'.$id;
        $this->view->dev = $dev;
        $this->view->label = 'Editar';
        $this->view->class_btn = 'btn btn-warning';
        $this->render('form');
    }

    public function search()
    {
        $dao = $this->model('DaoDev');
        $nome = $_POST['nome'];
        $dev = $dao->BuscarPorNome($nome);

        $this->view->action = '/dev/search';
        $this->view->dev = $dev;
        $this->view->numPaginas = 1;
        $this->render('procuraform');
    }

    public function delete($id) {
        $dao = $this->model('DaoDev');
        $dev = $dao->BuscarPorCOD($id);
        if($_POST){
            $dao->Deletar($id);
            $this->index(1);
        }

        $this->view->action = '/dev/delete/'.$id;
        $this->view->dev = $dev;
        $this->view->label = 'Excluir';
        $this->view->class_btn = 'btn btn-danger';
        $this->render('form');


    }
}