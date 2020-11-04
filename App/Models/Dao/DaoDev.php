<?php

namespace App\Models\Dao;

use App\Models\Classes\Artigos;
use App\Models\Classes\Devs;

class DaoDev
{
    protected $db;

    public function __construct(\PDO $db)
    {
        $this->db = $db;
    }

    public function Inserir(Devs $obj)
    {
        try
        {
            $sql = "INSERT INTO tbl_dev (nome, nascimento, nivel, cadastro) 
                                      VALUES (:nome, :nascimento, :nivel, :cadastro)";

            $p_sql = $this->db->prepare($sql);

            $this->populaValues($p_sql, $obj);
            $p_sql->bindValue(":cadastro", $obj->getCadastro());

            $p_sql->execute();
            return $this->db->lastInsertId();
        } catch (\Exception $e) {
            print "error-Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde. ".$e->getMessage();
        }
    }

    public function Editar(Devs $obj)
    {
        try
        {
            $sql = "UPDATE tbl_dev SET nome = :nome, nascimento = :nascimento, nivel = :nivel"
                . " WHERE Id = :Id";

            $p_sql = $this->db->prepare($sql);

            $this->populaValues($p_sql, $obj);
            $p_sql->bindValue(":Id", $obj->getId());

            return $p_sql->execute();
        } catch (\Exception $e) {
            print "error-Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde. ".$e->getMessage();
        }
    }

    public function Deletar($cod)
    {
        try
        {
            $sql = "DELETE FROM tbl_dev WHERE Id = :Id";
            $p_sql = $this->db->prepare($sql);
            $p_sql->bindValue(":Id", $cod);

            return $p_sql->execute();
        } catch (\Exception $e) {
            print "error-Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde. ".$e->getMessage();
        }
    }

    public function BuscarPorCOD($cod) {
        try {
            $sql = "SELECT * FROM tbl_dev WHERE Id = :cod";
            $p_sql = $this->db->prepare($sql);
            $p_sql->bindValue(":cod", $cod);
            $p_sql->execute();
            return $this->populaObj($p_sql->fetch(\PDO::FETCH_ASSOC));
        } catch (\Exception $e) {
            print "error-Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde. ".$e->getMessage();
        }
    }

    public function BuscarTodos() {
        try {
            $sql = "SELECT * FROM tbl_dev ORDER BY nome";
            $p_sql = $this->db->prepare($sql);
            $p_sql->execute();
            $obj = [];
            while ($row = $p_sql->fetch(\PDO::FETCH_ASSOC)){
                $obj[] = $this->populaObj($row);
            }
            return $obj;

        } catch (\Exception $e) {
            print "error-Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde. ".$e->getMessage();
        }
    }

    public function Total() {
        try {
            $sql = "SELECT * FROM tbl_dev ORDER BY nome";
            $p_sql = $this->db->prepare($sql);
            $p_sql->execute();

            return $p_sql->rowCount();

        } catch (\Exception $e) {
            print "error-Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde. ".$e->getMessage();
        }
    }

    public function BuscarTodosPaginacao($inicio, $limit)
    {
        try
        {
            $sql = "SELECT * FROM tbl_dev ORDER BY nome LIMIT :inicio, :limit";
            $p_sql = $this->db->prepare($sql);
            $p_sql->bindParam(':inicio', $inicio, \PDO::PARAM_INT);
            $p_sql->bindParam(':limit', $limit, \PDO::PARAM_INT);
            $p_sql->execute();
            $obj = [];
            while ($row = $p_sql->fetch(\PDO::FETCH_ASSOC)){
                $obj[] = $this->populaObj($row);
            }
            return $obj;

        } catch (\Exception $e) {
            print "error-Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde.".$e->getMessage();
        }
    }

    public function BuscarMaisRecentes($inicio, $limit)
    {
        try
        {
            $sql = "SELECT * FROM tbl_dev ORDER BY Id DESC LIMIT :inicio, :limit";
            $p_sql = $this->db->prepare($sql);
            $p_sql->bindParam(':inicio', $inicio, \PDO::PARAM_INT);
            $p_sql->bindParam(':limit', $limit, \PDO::PARAM_INT);
            $p_sql->execute();
            $obj = [];
            while ($row = $p_sql->fetch(\PDO::FETCH_ASSOC)){
                $obj[] = $this->populaObj($row);
            }
            return $obj;

        } catch (\Exception $e) {
            print "error-Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde.".$e->getMessage();
        }
    }

    public function BuscarPorNome($nome)
    {
        try
        {
            $sql = "SELECT * FROM tbl_dev WHERE nome LIKE :nome";
            $p_sql = $this->db->prepare($sql);
            $p_sql->bindValue(":nome", "%" . $nome . "%");
            $p_sql->execute();

            $result = [];
            $all = $p_sql->fetchAll();
            foreach ($all as $row) {
                $result[] = $this->populaObj($row);
            }
            //print_r($result);
            return $result;
        }
        catch (\Exception $e)
        {
            print "error-Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde.".$e->getMessage();
        }
    }

    private function populaObj($row) {
        $pojo = new Devs();
        $pojo->setId($row['Id']);
        $pojo->setNome($row['nome']);
        $pojo->setNascimento($row['nascimento']);
        $pojo->setNivel($row['nivel']);
        return $pojo;
    }

    private function populaValues($p_sql, $obj) {
        $p_sql->bindValue(":nome", $obj->getNome());
        $p_sql->bindValue(":nascimento", $obj->getNascimento());
        $p_sql->bindValue(":nivel", $obj->getNivel());
        return $p_sql;
    }
}
