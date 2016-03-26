<?php

use Phalcon\Mvc\Controller;

class ControllerBase extends Controller
{
    protected function initialize()
    {
        $this->tag->prependTitle('Gallery | ');
        $this->view->setTemplateAfter('flash');
    }

    protected function forward($uri)
    {
        $uriParts = explode('/', $uri);
        $params = array_slice($uriParts, 2);
        return $this->dispatcher->forward(
            array(
                'controller' => $uriParts[0],
                'action' => $uriParts[1],
                'params' => $params
            )
        );
    }
}