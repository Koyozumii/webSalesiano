<?php

namespace App\Models\Classes;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


class Artigos {
    private $Id = null;
    private $titulo = null;
    private $texto = null; 
    private $ativo = null;
    private $cadastro = null;
    
    function getId() {
        return $this->Id;
    }

    function getTitulo() {
        return $this->titulo;
    }

    function getTexto() {
        return $this->texto;
    }

    function getAtivo() {
        return $this->ativo;
    }

    function getCadastro() {
        return $this->cadastro;
    }

    function setId($Id) {
        $this->Id = $Id;
    }

    function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    function setTexto($texto) {
        $this->texto = $texto;
    }

    function setAtivo($ativo) {
        $this->ativo = $ativo;
    }

    function setCadastro($cadastro) {
        $this->cadastro = $cadastro;
    }



}
