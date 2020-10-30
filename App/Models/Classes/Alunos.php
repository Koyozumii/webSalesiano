<?php

namespace App\Models\Classes;

class Alunos{

    private $idAluno = null;
    private $idProjeto = null;
    private $idCurso = null;
    private $nome = null;
    private $ra = null;
    private $senha = null;

    public function getIDAluno()
    {
        return $this->idAluno;
    }

    public function setIDAluno($idAluno)
    {
        $this->idAluno = $idAluno;
    }

    public function getIDProjeto()
    {
        return $this->idProjeto;
    }

    public function setIDProjeto($idProjeto)
    {
        $this->idProjeto = $idProjeto;
    }

    public function getIDCurso()
    {
        return $this->idCurso;
    }

    public function setIDCurso($idCurso)
    {
        $this->idCurso = $idCurso;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function getRA()
    {
        return $this->ra;
    }

    public function setRA($ra)
    {
        $this->ra = $ra;
    }

    public function getSenha()
    {
        return $this->senha;
    }

    public function setSenha($senha)
    {
        $this->senha = $senha;
    }
}


