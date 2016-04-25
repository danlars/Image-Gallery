<?php
use Phalcon\Mvc\Controller;

class ApiController extends Controller
{
    protected function initialize()
    {
        $this->view->disable();
    }

    public function getUser(){

    }
}