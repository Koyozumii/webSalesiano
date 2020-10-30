<?php

namespace App\Models\Dao;

use App\Models\Classes\Artigos;

class DaoArtigos{

    protected $db;
    
    public function __construct(\PDO $db) {
        $this->db = $db;
    }

    public function Inserir(Artigos $obj) {
        try {
            $sql = "INSERT INTO tbl_artigos (titulo, texto, ativo, cadastro) 
                                      VALUES (:titulo, :texto, :ativo, :cadastro)";

            $p_sql = $this->db->prepare($sql);

            $this->populaValues($p_sql, $obj);
            $p_sql->bindValue(":cadastro", $obj->getCadastro());

            $p_sql->execute();
            return $this->db->lastInsertId();
        } catch (\Exception $e) {
            print "error-Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde. ".$e->getMessage();
        }
    }

    public function Editar(Artigos $obj) {
        try {
            $sql = "UPDATE tbl_artigos SET titulo = :titulo, texto = :texto, ativo = :ativo"
                                 . " WHERE Id = :Id";

            $p_sql = $this->db->prepare($sql);

            $this->populaValues($p_sql, $obj);
            $p_sql->bindValue(":Id", $obj->getId());

            return $p_sql->execute();
        } catch (\Exception $e) {
            print "error-Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde. ".$e->getMessage();
        }
    }

    public function Deletar($cod) {
        try {
            $sql = "DELETE FROM tbl_artigos WHERE Id = :Id";
            $p_sql = $this->db->prepare($sql);
            $p_sql->bindValue(":Id", $cod);

            return $p_sql->execute();
        } catch (\Exception $e) {
            print "error-Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde. ".$e->getMessage();
        }
    }

    public function BuscarPorCOD($cod) {
        try {
            $sql = "SELECT * FROM tbl_artigos WHERE Id = :cod";
            $p_sql = $this->db->prepare($sql);
            $p_sql->bindValue(":cod", $cod);
            $p_sql->execute();
            return $this->populaObj($p_sql->fetch(\PDO::FETCH_ASSOC));
        } catch (\Exception $e) {
            print "error-Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde. ".$e->getMessage();
        }
    }
    
    public function BuscarTodos($ativo) {
        try {
            $sql = "SELECT * FROM tbl_artigos WHERE ativo <> :ativo ORDER BY titulo";
            $p_sql = $this->db->prepare($sql);
            $p_sql->bindValue(":ativo", $ativo);
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
            $sql = "SELECT * FROM tbl_artigos ORDER BY titulo";
            $p_sql = $this->db->prepare($sql);
            $p_sql->execute();
            
            return $p_sql->rowCount();
            
        } catch (\Exception $e) {
            print "error-Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde. ".$e->getMessage();
        }
    }
    
    public function BuscarTodosPaginacao($inicio, $limit) {
        try {
            $sql = "SELECT * FROM tbl_artigos where ativo = 's' ORDER BY titulo LIMIT :inicio, :limit";
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
        try {
            $sql = "SELECT * FROM tbl_artigos ORDER BY Id DESC LIMIT :inicio, :limit";
            $p_sql = $this->db->prepare($sql);
            $p_sql->bindParam(':inicio', $inicio, \PDO::PARAM_INT); 
            $p_sql->bindParam(':limit', $limit, \PDO::PARAM_INT);
            $p_sql->execute();
            $obj = [];       
            while ($row = $p_sql->fetchAll()){
                $obj[] = $this->populaObj($row);
            }
                return $obj;
            
        } catch (\Exception $e) {
            print "error-Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde.".$e->getMessage();
        }
    }

    public function BuscarPorNome($titulo)
    {
        try
        {
            $sql = "SELECT * FROM tbl_artigos WHERE titulo LIKE :titulo";
            $p_sql = $this->db->prepare($sql);
            $p_sql->bindValue(":titulo", "%" . $titulo . "%");
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
        $pojo = new Artigos();
        $pojo->setId($row['Id']);
        $pojo->setTitulo($row['titulo']);
        $pojo->setTexto($row['texto']);
        $pojo->setAtivo($row['ativo']);
        $pojo->setCadastro($row['cadastro']);
        return $pojo;
    }

    private function populaValues($p_sql, $obj) {
        $p_sql->bindValue(":titulo", $obj->getTitulo());
        $p_sql->bindValue(":texto", $obj->getTexto());
        $p_sql->bindValue(":ativo", $obj->getAtivo());
        return $p_sql;
    }

}

