<?php
/**
 * welcome page
 * @author awlad
 *
 */
namespace  Module\controllers;

class WelcomeController extends BaseController {

    /**
     * @desc render home page
     * @return mixed
     */
    public function home()
    {
        return $this->renderPage('welcome/welcome');
    }

    /**
     * @desc render 404 page
     * @return mixed
     */
    public function not_found()
    {
        return $this->renderPage('errors/404');
    }
}