<?php 

namespace src\Domain\Interfaces;

interface IRepository{
    public function findAll();

    public function findById($id);

    public function add($entity);

    public function update($entity);
    
    public function delete($id);
    
}