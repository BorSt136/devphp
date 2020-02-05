<?php


namespace ProjetWeb\Model\Entity;


class Category
{
    /** @var int $id */
    private $id;
    /** @var string $name */
    private $name;

    public static function fromArray($args) : ?Category
    {
        $instance = new self();
        $instance->setId($args['id'] ?? null);
        $instance->setName($args['name'] ?? '');

        return $instance;
    }

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }
}