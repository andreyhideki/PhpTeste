<?php
namespace src\controllers;

use \core\Controller;

class HomeController extends Controller {

    public function index() {
        echo("AE");
        $this->render('home', ['nome' => 'Teste']);
    }

    public function sobre() {
        $this->render('sobre');
    }

    public function sobreP($args) {
        print_r($args);
    }

    public function getAll(){
        echo("GETALL");
    }

    public function ping(){
        echo("PONG");
    }
}