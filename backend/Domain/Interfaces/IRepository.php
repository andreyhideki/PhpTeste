<?php 

namespace backend\Domain\Interfaces;

interface IRepository{
    public function getAll();

    public function getById($id);

    
}