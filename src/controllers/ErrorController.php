<?php

namespace src\controllers;

use src\core\Controller;

class ErrorController extends Controller {

    public function index() {
        $this->render('404');
    }

}