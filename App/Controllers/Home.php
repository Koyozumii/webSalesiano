<?php

namespace App\Controllers;

use \App\Core\Controller;


class Home extends Controller{
    
    public function index() {

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

    
    
}
