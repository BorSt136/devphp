<?php

namespace devphp\Model\Service\Session;

use devphp\Exception\UnexpectedClassException;
use devphp\Model\Entity\User as UserEntity;

class User
{
    public function create($entity)
    {
        if (!$entity instanceof UserEntity) {
            throw new UnexpectedClassException(UserEntity::class, get_class($entity));
        }

        $_SESSION["user"] = serialize($entity);
    }

    public function destroy()
    {
        $_SESSION = [];
    }

    public function get(): ?UserEntity
    {
        return isset($_SESSION["user"]) ? unserialize($_SESSION["user"]) : null;
    }

    public function isConnected(): bool
    {
        return isset($_SESSION["user"]);
    }
}