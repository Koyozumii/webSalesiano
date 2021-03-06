<?php

namespace App\Models\Dao;

use App\Models\Classes\Alunos;

class DaoAlunos{
    protected $db;

    public function __construct(\PDO $db) {
        $this->db = $db;
    }

    public function Inserir(Alunos $obj)
    {
        try{
            $sql = "INSERT INTO alunos (projeto_idprojeto,curso_idcurso,nome,ra,senha) 
                                VALUES (:idProjeto, :idCurso, :nome, :ra, :senha)";
            $stmt = $this->db->prepare($sql);
            $this->populaValues($stmt, $obj);
            $stmt->execute();

            return $this->db->lastInsertId();
        }catch(\Exception $e)
        {
            print "error-Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde. ".$e->getMessage();
        }
    }

    public function Editar(Alunos $obj)
    {
        try{
            $sql = "UPDATE aluno SET 
            projeto_idProjeto = :projeto,
            curso_idCurso = :curso,
            nome = :nome,
            ra = :ra.
            senha = :senha
            WHERE idAluno = :id";

            $stmt = $this->db->prepare($sql);
            $this->populaValues($stmt, $obj);
            $stmt->bindValue(":id", $obj->getIDAluno);

            return $stmt->execute();

        }catch(\Exception $e)
        {
            print "error-Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde. ".$e->getMessage();
        }
    }

    public function verificaLogin($ra, $senha)
    {
        try{
            $sql = "SELECT * from aluno WHERE
                    ra = :ra and senha = :senha";

            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(":ra", $ra);
            $stmt->bindValue("senha", $senha);

            return $this->populaObj($stmt->fetch(\PDO::FETCH_ASSOC));

        }catch(\Exception $e)
        {
            print "error-Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde. ".$e->getMessage();
        }
    }

    public function Deletar($idaluno)
    {
        try{
            $sql = "DELETE FROM alunos WHERE idaluno = :idaluno";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(":idaluno", $idaluno);
            return $stmt->execute();

        }catch(\Exception $e)
        {
            print "error-Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde. ".$e->getMessage();
        }
    }


    private function populaObj($row) {
        $pojo = new Alunos();
        $pojo->setIDProjeto($row['idProjeto']);
        $pojo->setIDCurso($row['idCurso']);
        $pojo->setNome($row['nome']);
        $pojo->setRA($row['ra']);
        $pojo->setSenha($row['senha']);
        return $pojo;
    }

    private function populaValues($p_sql, $obj) {
        $p_sql->bindValue(":nome", $obj->getNome());
        $p_sql->bindValue(":idProjeto", $obj->getIDProjeto());
        $p_sql->bindValue(":idCurso", $obj->getAtivo());
        $p_sql->bindValue(":ra", $obj->getRA());
        $p_sql->bindValue(":senha", $obj->getSenha());
        return $p_sql;
    }

}