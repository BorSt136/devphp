<?php

namespace ProjetWeb\Model\Service\Database;

use ProjetWeb\Model\Service\Database\User as UserService;
use ProjetWeb\Model\Service\Database\Tag as TagService;

use ProjetWeb\Model\Service\Crud;
use ProjetWeb\Model\Entity\Article as ArticleEntity;
use PDO;

class Article implements Crud
{
    /** @param ArticleEntity $entity */
    public function create($entity)
    {
        $bdd = new PDO('mysql:host=localhost;dbname=projet-web;charset=utf8', 'root', 'test');
        $content = $entity->getContent();
        $title = $entity->getTitle();
        $userId = $entity->getAuthor() !== null ? $entity->getAuthor()->getId() : 'null';

        $sql = <<<SQL
INSERT INTO article (title, content, user_id)
VALUES ('$title', '$content', $userId)
SQL;
        $bdd->query($sql);
    }

    public function read(int $id): ArticleEntity
    {
        $bdd = new PDO('mysql:host=localhost;dbname=projet-web;charset=utf8', 'root', 'test');
        $sql = <<<SQL
SELECT * FROM article 
WHERE id = $id
SQL;
        $result = $bdd->query($sql)->fetch();
//        echo "<pre>";
//        var_dump($result);
//        echo "</pre>";
        if($result['user_id'] !== null) {
            $userId = $result['user_id'];
            $userService = new UserService();
            $result['author'] = $userService->read($userId);
        }
        if($result['tag_fi'] !== null) {
            $tagid = $result['tag_fi'];
            $TagService = new TagService();
            $result['tag_fi'] = $TagService->read($tagid);
        }
        return ArticleEntity::fromArray($result);
    }

    /** @param ArticleEntity $entity */
    public function update($entity)
    {
        $bdd = new PDO('mysql:host=localhost;dbname=projet-web;charset=utf8', 'root', 'test');
        $content = $entity->getContent();
        $title = $entity->getTitle();
        $userId = $entity->getAuthor() !== null ? $entity->getAuthor()->getId() : 'null';
        $id = $entity->getId();
        $tagid = $entity->getTag();

        $sql = <<<SQL
UPDATE article SET 
title = '$title', 
content = '$content',
user_id = $userId,
tag_fi = $tagid
WHERE id = $id;
SQL;
        $bdd->query($sql);
    }

    public function delete(int $id): bool
    {
        $bdd = new PDO('mysql:host=localhost;dbname=projet-web;charset=utf8', 'root', 'test');
        $sql = <<<SQL
DELETE FROM article
WHERE id = $id
SQL;
        return $bdd->query($sql) !== false;
    }

    /**
     * @return ArticleEntity[]
    */
    public function list(): array {
        $bdd = new PDO('mysql:host=localhost;dbname=projet-web;charset=utf8', 'root', 'test');
        $sql = <<<SQL
SELECT * FROM article
SQL;
        $entities = [];
        $results = $bdd->query($sql)->fetchAll();
        foreach($results as $result) {
            if($result['user_id'] !== null) {
                $userId = $result['user_id'];
                $userService = new UserService();
                $result['author'] = $userService->read($userId);
            }
            if($result['tag_fi'] !== null) {
                $tagid = $result['tag_fi'];
                $TagService = new TagService();
                $result['tag_fi'] = $TagService->read($tagid);
            }
            $entities[] = ArticleEntity::fromArray($result);

        }

        return $entities;
    }
}