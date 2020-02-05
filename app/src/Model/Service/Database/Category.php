<?php


namespace ProjetWeb\Model\Service\Database;

use ProjetWeb\Model\Entity\Category as CategoryEntity;
use PDO;

class Category
{

    public function list()
    {
        $bdd = new PDO('mysql:host=localhost;dbname=projet-web;charset=utf8', 'root', 'test');
        $sql = <<<SQL
SELECT * FROM category
SQL;
        $entities = [];
        $results = $bdd->query($sql)->fetchAll();
        foreach($results as $result) {
            $entities[] = CategoryEntity::fromArray($result);
        }

        return $entities;
    }

    public function read(int $id) :?CategoryEntity
    {
        $bdd = new PDO('mysql:host=localhost;dbname=projet-web;charset=utf8', 'root', 'test');
        $sql = <<<SQL
SELECT * FROM category 
WHERE id = $id
SQL;
        return CategoryEntity::fromArray($bdd->query($sql)->fetch());
    }
}