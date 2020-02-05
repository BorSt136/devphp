<?php

namespace ProjetWeb\Model\Entity;
//use ProjetWeb\Model\Entity\Category;
class User
{
    /** @var ?int $id */
    private $id;

    /** @var string $login */
    private $login;

    /** @var string $password */
    private $password;

    /** @var string $email */
    private $email;

    /** @var string $nom */
    private $nom;

    /** @var string $prenom */
    private $prenom;

    /**
     * @var Category|null
     */
    private $category;

    /**
     * @param array $args
     * @return User
     */
    public static function fromArray(array $args): User
    {
        $instance = new self();
        /**
         * if($args['id']) {
         *      $instance->setId($args['id]);
         * } else {
         *      $instance->setId(null);
         * }
         *
         * $instance->setId($args['id'] ? $args['id'] : null):
         */
        //var_dump($args);
        $instance->setId($args['id'] ?? null);
        $instance->setLogin($args['login'] ?? '');
        $instance->setPassword($args['password'] ?? '');
        $instance->setEmail($args['email'] ?? '');
        $instance->setNom($args['nom'] ?? '');
        $instance->setPrenom($args['prenom'] ?? '');
        //inutilisable
        $instance->setCategory($args['category'] ?? null);

        return $instance;
    }

    /** @return int */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param ?int $id
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getLogin(): string
    {
        return $this->login;
    }

    /**
     * @param string $login
     */
    public function setLogin(string $login): void
    {
        $this->login = $login;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getNom(): ?string
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     */
    public function setNom(string $nom): void
    {
        $this->nom = $nom;
    }

    /**
     * @return string
     */
    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    /**
     * @param string $prenom
     */
    public function setPrenom(string $prenom): void
    {
        $this->prenom = $prenom;
    }

    /**
     * @param ?Category $category
     */
    public function setCategory(?Category $category): void
    {
        $this->category = $category;
    }

    /**
     * @return Category|null
     */
    public function getCategory(): ?Category
    {
        return $this->category;
    }
}