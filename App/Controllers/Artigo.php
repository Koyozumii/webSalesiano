<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controllers;

use \App\Core\Controller;
use \App\Models\Classes\Artigos;

class Artigo extends Controller{
    
    public function index($pagina = 1) {
        $dao = $this->model('DaoArtigos');
        
         //conta o total de itens 
        $total = $dao->Total(); 

        //seta a quantidade de itens por página, neste caso, 2 itens 
        $registros = 2; 

        //calcula o número de páginas arredondando o resultado para cima 
        $numPaginas = ceil($total/$registros); 

        //variavel para calcular o início da visualização com base na página atual 
        $inicio = ($registros*$pagina)-$registros;
        
        
        $artigo = $dao->BuscarPorCOD(1);
        $artigos = $dao->BuscarTodosPaginacao($inicio, $registros);
        
        $this->view->artigo = $artigo;
        $this->view->artigos = $artigos;
        $this->view->numPaginas = $numPaginas;
        $this->render('index');
    }
    
    public function artigo($id)
    {
        $dao = $this->model('DaoArtigos');
        
        $artigo = $dao->BuscarPorCOD($id);
        
        $this->view->artigo = $artigo;
        $this->render('artigo');
    }
    
    public function create() {
        $artigo = new Artigos();
        $dao = $this->model('DaoArtigos');
        
        if($_POST){
            $artigo->setTitulo($_POST['titulo']);
            $artigo->setTexto($_POST['texto']);
            $artigo->setAtivo('s');
            $artigo->setCadastro(date('Y-m-d H:m:s'));
            
            $dao->Inserir($artigo);
            $this->index(1);
            $this->render('index');
            exit();
        }
        
        $this->view->action = '/artigo/create';
        $this->view->artigo = $artigo;
        $this->view->label = 'Cadastrar';
        $this->view->class_btn = 'btn btn-success';
        $this->render('form');
    }
    
    public function update($id) {
        $artigo = new Artigos();
        
        $dao = $this->model('DaoArtigos');
        $artigo = $dao->BuscarPorCOD($id);
        
        if($_POST){
            $artigo->setTitulo($_POST['titulo']);
            $artigo->setTexto($_POST['texto']);
            $artigo->setAtivo('s');
            $artigo->setId($id);
            
            $dao->Editar($artigo);
            $this->index(1);
            $this->render('index');
        }
        
        $this->view->action = '/artigo/update/'.$id;
        $this->view->artigo = $artigo;
        $this->view->label = 'Editar';
        $this->view->class_btn = 'btn btn-warning';
        $this->render('form');
        
        
    }

    public function search()
    {
        $dao = $this->model('DaoArtigos');
        $titulo = $_POST['titulo'];
        $artigo = $dao->BuscarPorNome($titulo);

        $this->view->action = '/artigo/search';
        $this->view->artigo = $artigo;
        $this->view->numPaginas = 1;
        $this->render('procuraform');
    }

    public function delete($id) {
        $dao = $this->model('DaoArtigos');
        $artigo = $dao->BuscarPorCOD($id);
        if($_POST){
            $dao->Deletar($id);
            $this->index(1);
        }

        $this->view->action = '/artigo/delete/'.$id;
        $this->view->artigo = $artigo;
        $this->view->label = 'Excluir';
        $this->view->class_btn = 'btn btn-danger';
        $this->render('form');
        
        
    }
}
