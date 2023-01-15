<?php 

namespace Domain\Interfaces;

interface IRepository{
    public function getAll();

    public function getById($id);

    
}