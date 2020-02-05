<?php

namespace devphp\Model\Service\Session;

use devphp\Exception\UnexpectedClassException;
use devphp\Model\Entity\Article as ArticleEntity;
use devphp\Model\Service\Crud;

class Article implements Crud
{
    public function create($entity)
    {
        if (!$entity instanceof ArticleEntity) {
            throw new UnexpectedClassException(ArticleEntity::class, get_class($entity));
        }

        $entity->setId(count($_SESSION["liste_article"]) + 1);
        $_SESSION["liste_article"][$entity->getId()] = serialize($entity);
    }

    public function read(int $id): ArticleEntity
    {
        return unserialize($_SESSION["liste_article"][$id]);
    }

    public function update($entity)
    {
        if (!$entity instanceof ArticleEntity) {
            throw new UnexpectedClassException(ArticleEntity::class, get_class($entity));
        }

        $_SESSION["liste_article"][$entity->getId()] = serialize($entity);
    }

    public function delete(int $id)
    {
        unset($_SESSION["liste_article"][$id]);
    }

    /**
     * @return ArticleEntity[]
     */
    public function list(): array {
        $list = [];
        $unserializedList = isset($_SESSION["liste_article"]) ? $_SESSION["liste_article"] : [];
        foreach ($unserializedList as $serializedArticle) {
            $list[] = unserialize($serializedArticle);
        }

        return $list;
    }
}