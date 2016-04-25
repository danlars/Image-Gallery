<?php
use Phalcon\Mvc\Router\Group as RouterGroup;

$api = new RouterGroup(
    array(
        'controller' => 'api'
    )
);

// All the routes start with /blog
$api->setPrefix('/api');

$api->addGet('/user/:int', array(
    'action' => 'getUser',
    'id'     => 1
));