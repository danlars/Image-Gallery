<?php
use Phalcon\Mvc\Router as Router;

$router = new Router();

$router->add(
    '/:controller/:action',
    array(
        'controller' => 'login',
        'action' => 'index'
    )
);

$router->add(
    '/login/:action',
    array(
        'controller' => 'login',
        'action' => 1
    )
);