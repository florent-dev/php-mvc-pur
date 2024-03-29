<?php

namespace mvc\Model\Manager;

require_once('PDOManager.php');

use Model\Entity\SecteursStructures;
use mvc\Model\Entities\Entity;
use \PDOStatement;

class SecteursStructuresManager extends PDOManager
{
    public function findById(int $id): ?Entity
    {
        $stmt = $this->executePrepare('SELECT * FROM secteurs_structures WHERE ID=:id', ['id' => $id]);
        $datas = $stmt->fetch();

        if (!$datas) return null;

        return $this->buildStructure($datas);
    }

    public function findByIdSecteur(int $idSecteur): ?Entity
    {
        $stmt = $this->executePrepare('SELECT * FROM secteurs_structures WHERE ID_SECTEUR=:idSecteur', ['idSecteur' => $idSecteur]);
        $datas = $stmt->fetch();

        if (!$datas) return null;

        return $this->buildStructure($datas);
    }

    public function findByIdStructure(int $idStructure): ?Entity
    {
        $stmt = $this->executePrepare('SELECT * FROM secteurs_structures WHERE ID_STRUCTURE=:idStructure', ['idStructure' => $idStructure]);
        $datas = $stmt->fetch();

        if (!$datas) return null;

        return $this->buildStructure($datas);
    }

    public function getIdSecteursByIdStructure(int $idStructure): ?array
    {
        $stmt = $this->executePrepare('SELECT ID_SECTEUR FROM secteurs_structures WHERE ID_STRUCTURE=:idStructure', ['idStructure' => $idStructure]);
        $datas = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        if (!$datas) return null;

        $secteurIds = [];
        foreach ($datas as $data) {
            $secteurIds[] = $data['ID_SECTEUR'];
        }

        return $secteurIds;
    }

    public function find(): PDOStatement
    {
        $stmt = $this->executePrepare('SELECT * FROM secteurs_structures', []);
        return $stmt;
    }

    public function findAll(int $pdoFetchMode): array
    {
        $stmt = $this->find();
        $secteursStructures = $stmt->fetchAll($pdoFetchMode);
        $secteursStructuresEntities = [];
        foreach ($secteursStructures as $secteursStructure) {
            $secteursStructuresEntities[] = new SecteursStructures($secteursStructure['ID'], $secteursStructure['ID_SECTEUR'], $secteursStructure['ID_STRUCTURE']);
        }
        return $secteursStructuresEntities;
    }

    public function insert(Entity $e): PDOStatement
    {
        $req = 'INSERT INTO secteurs_structures(ID, ID_SECTEUR, ID_STRUCTURE) VALUES (:id, :id_secteur, :id_structure)';
        $params = ['id' => $e->getId(), 'id_secteur' => $e->getIdSecteur(), 'id_structure' => $e->getIdStructure()];
        $res = $this->executePrepare($req, $params);

        return $res;
    }

    public function delete(Entity $e): PDOStatement
    {
        $req = 'DELETE FROM secteurs_structures WHERE id=:id';
        $params = array('id' => $e->getId());
        $res = $this->executePrepare($req, $params);

        return $res;
    }

    public function deleteByIdStructure(int $id): PDOStatement
    {
        $req = 'DELETE FROM secteurs_structures WHERE ID_STRUCTURE=:id_structure';
        $params = array('id_structure' => $id);
        $res = $this->executePrepare($req, $params);

        return $res;
    }

    public function deleteByIdSecteur(int $id): PDOStatement
    {
        $req = 'DELETE FROM secteurs_structures WHERE ID_SECTEUR=:id_secteur';
        $params = array('id_secteur' => $id);
        $res = $this->executePrepare($req, $params);

        return $res;
    }
}