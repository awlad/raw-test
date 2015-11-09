<?php
namespace  Module\controllers;

class WelcomeController extends BaseController {

    public function not_found()
    {
        return $this->renderPage('errors/404');
    }

    public function home()
    {
        return $this->renderPage('welcome/welcome');
    }
}