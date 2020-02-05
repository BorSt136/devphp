<?php

namespace devphp\Model\Service\Database;


use devphp\Model\Entity\User as UserEntity;
use devphp\Model\Service\Database\Category as CategoryService;
use devphp\Model\Service\Crud;
use PDO;

class User implements Crud
{

    /** @param UserEntity $entity */
    public function create($entity)
    {
        $bdd = new PDO('mysql:host=localhost;dbname=Awesomesitename;charset=utf8', 'root', 'test');
        $login = $entity->getLogin();
        $password = $entity->getPassword();
        $sql = <<<SQL
INSERT INTO user (login, password)
VALUES ('$login', '$password')
SQL;
        $bdd->query($sql);
    }

    public function read(int $id): UserEntity
    {
        //TO DO: Check if ID exists or is deactivated/deleted

        $bdd = new PDO('mysql:host=localhost;dbname=Awesomesitename;charset=utf8', 'root', 'test');
        $sql = <<<SQL
SELECT * FROM user
WHERE id = $id
SQL;
        $result = $bdd->query($sql)->fetch(PDO::FETCH_ASSOC);

        $catservice = new CategoryService();
        //modif pour recevoir un tableau ici
        if($result["category_id"] !== NULL) $result["category"] = $catservice->read($result["category_id"]);;


        //$userentity->setCategory(Null);
//        echo "<pre>";
//        var_dump($result);
//        echo "</pre>";

        $userentity = UserEntity::fromArray($result);
//        echo "<pre>";
//        var_dump($userentity);
//        echo "</pre>";

        return $userentity;
    }

    /** @param UserEntity $entity */
    public function update($entity)
    {
        $bdd = new PDO('mysql:host=localhost;dbname=Awesomesitename;charset=utf8', 'root', 'test');
        $password = $entity->getPassword();
        $email = $entity->getEmail();
        $nom = $entity->getNom();
        $prenom = $entity->getPrenom();
        $id = $entity->getId();
        $categoryId = $entity->getCategory()->getId();

        $sql = <<<SQL
UPDATE user SET 
password = '$password', 
email = '$email',
nom = '$nom',
prenom = '$prenom',
category_id = $categoryId 
WHERE id = $id;
SQL;
        $bdd->query($sql);
    }

    public function delete(int $id): bool
    {
        $bdd = new PDO('mysql:host=localhost;dbname=Awesomesitename;charset=utf8', 'root', 'test');
        $sql = <<<SQL
DELETE FROM user
WHERE id = $id
SQL;
        return $bdd->query($sql) !== false;
    }

    /**
     * @return UserEntity[]
     */
    public function list(): array {
        $bdd = new PDO('mysql:host=localhost;dbname=Awesomesitename;charset=utf8', 'root', 'test');
        $sql = <<<SQL
SELECT * FROM user
SQL;
        $entities = [];
        $results = $bdd->query($sql)->fetchAll();
        foreach($results as $result) {
            if($result['category_id'] !== null) {
                $categoryId = $result['category_id'];
                $categoryService = new CategoryService();
                $result['category'] = $categoryService->read($categoryId);
            }
            $entities[] = UserEntity::fromArray($result);
        }

        return $entities;
    }

    /**
     * @param string $login
     * @param string $password
     * @return UserEntity
     */
    public function getByLoginAndPassword(string $login, string $password): UserEntity
    {

        $bdd = new PDO('mysql:host=localhost;dbname=Awesomesitename;charset=utf8', 'root', 'test');
        $sql = <<<SQL
SELECT * FROM user
WHERE login = "$login" AND password = "$password"
SQL;
        $result = $bdd->query($sql)->fetch(PDO::FETCH_ASSOC);


        if($result['category_id'] !== null) {
            $categoryId = $result['category_id'];
        }
        else {
            $categoryId = 2;
        }
        $categoryService = new CategoryService();
        $result['category'] = $categoryService->read($categoryId);
        echo "<pre>";
        var_dump($result);
        echo "</pre>";
        return UserEntity::fromArray($result !== false ? $result : []);
    }
}