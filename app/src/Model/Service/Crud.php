<?php

namespace devphp\Model\Service;

interface Crud
{
    public function create($entity);
    public function read(int $id);
    public function update($entity);
    public function delete(int $id);
}