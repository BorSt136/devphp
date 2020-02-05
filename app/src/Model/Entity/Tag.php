<?php
/**
 * Created by PhpStorm.
 * User: stef
 * Date: 20.06.19
 * Time: 19:07
 */

namespace devphp\Model\Entity;


class Tag
{
    private $id;
    private $name;
    private $description;


    public static function fromArray($args) : ?Tag
    {
        $instance = new self();
        $instance->setId($args['tag_id'] ?? null);
        $instance->setName($args['tag_name'] ?? '');
        $instance->setDescription($args['tag_description'] ?? '');
        return $instance;
    }
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }



}