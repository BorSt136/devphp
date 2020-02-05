<?php


namespace ProjetWeb\Model\Service\Database;

use ProjetWeb\Model\Entity\Tag as TagEntity;
use PDO;
use ProjetWeb\Model\Service\Crud;

//use ProjetWeb\Model\Service\Crud;

class Tag implements Crud
{

    public function list()
    {
        $bdd = new PDO('mysql:host=localhost;dbname=projet-web;charset=utf8', 'root', 'test');
        $sql = <<<SQL
SELECT * FROM tag
SQL;
        $entities = [];
        $results = $bdd->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        foreach($results as $result) {
            $entities[] = TagEntity::fromArray($result);
        }

        return $entities;
    }

    public function read(int $id) :?TagEntity
    {
        $bdd = new PDO('mysql:host=localhost;dbname=projet-web;charset=utf8', 'root', 'test');
        $sql = <<<SQL
SELECT * FROM `tag` 
WHERE `tag_id` = $id
SQL;

        return TagEntity::fromArray($bdd->query($sql)->fetch());
    }
    public function update($entity)
    {

    }
    public function create($entity)
    {
    // TODO: Implement create() method.
    }
    public function delete(int $id)
    {
    // TODO: Implement delete() method.
    }

}