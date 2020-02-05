<?php

namespace devphp\Model\Entity;

class Article
{
    /** @var $id int|null */
    private $id;
    /** @var string */
    private $content;
    /** @var string */
    private $title;
    /** @var User|null */
    private $author;
    private $tag;

    /**
     * @return mixed
     */

    /**
     * @param array $args
     * @return Article
     */
    public static function fromArray(array $args): Article {
        $instance = new self();
        $instance->setId($args['id'] ?? null);
        $instance->setContent($args['content'] ?? '');
        $instance->setTitle($args['title'] ?? '');
        $instance->setAuthor($args['author'] ?? null);
        $instance->setTag($args['tag_fi'] ?? null);
        return $instance;
    }
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * @param mixed $tag
     */
    public function setTag($tag)
    {
        $this->tag = $tag;
    }
    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return User|null
     */
    public function getAuthor(): ?User
    {
        return $this->author;
    }

    /**
     * @param User|null $author
     */
    public function setAuthor(?User $author): void
    {
        $this->author = $author;
    }
}
