<?php
/**
 * Services are globally registered in this file
 *
 * @var \Phalcon\Config $config
 */

use Phalcon\Crypt;
use Phalcon\Di\FactoryDefault;
use Phalcon\Mvc\View;
use Phalcon\Mvc\Url as UrlResolver;
use Phalcon\Mvc\View\Engine\Volt as VoltEngine;
use Phalcon\Mvc\Model\Metadata\Memory as MetaDataAdapter;
use Phalcon\Session\Adapter\Files as SessionAdapter;
use Phalcon\Flash\Session as Flash;
use Phalcon\Events\Manager as EventsManager;
use Phalcon\Dispatcher;
use Phalcon\Mvc\Dispatcher as MvcDispatcher;

try {
    /**
     * The FactoryDefault Dependency Injector automatically register the right services providing a full stack framework
     */
    $di = new FactoryDefault();

    $di->set('router', function () {
        require APP_PATH . '/app/config/router.php';
        return $router;
    });

    /**
     * We register the events manager
     */
    $di->set('dispatcher', function () {
        $eventsManager = new EventsManager;
        $dispatcher = new MvcDispatcher;
        /**
         * Check if the user is allowed to access certain action using the SecurityPlugin
         */
        $eventsManager->attach('dispatch:beforeDispatch', new SecurityPlugin);
        /**
         * Handle exceptions and not-found exceptions using NotFoundPlugin
         */
        $eventsManager->attach('dispatch:beforeException', new NotFoundPlugin);

        $dispatcher->setEventsManager($eventsManager);
        return $dispatcher;
    });

    /**
     * The URL component is used to generate all kind of urls in the application
     */
    $di->setShared('url', function () use ($config) {
        $url = new UrlResolver();
        $url->setBaseUri($config->application->baseUri);

        return $url;
    });

    /**
     * Setting up the view component
     */
    $di->setShared('view', function () use ($config) {

        $view = new View();

        $view->setViewsDir($config->application->viewsDir);

        $view->registerEngines(array(
            '.volt' => function ($view, $di) use ($config) {

                $volt = new VoltEngine($view, $di);

                $volt->setOptions(array(
                    'compiledPath' => $config->application->cacheDir,
                    'compiledSeparator' => '_'
                ));

                return $volt;
            },
            '.phtml' => 'Phalcon\Mvc\View\Engine\Php'
        ));

        return $view;
    });

    /**
     * Database connection is created based in the parameters defined in the configuration file
     */
    $di->setShared('db', function () use ($config) {
        $dbConfig = $config->database->toArray();
        $adapter = $dbConfig['adapter'];
        unset($dbConfig['adapter']);

        $class = 'Phalcon\Db\Adapter\Pdo\\' . $adapter;

        return new $class($dbConfig);
    });

    /**
     * If the configuration specify the use of metadata adapter use it or use memory otherwise
     */
    $di->setShared('modelsMetadata', function () {
        return new MetaDataAdapter();
    });

    /**
     * Start the session the first time some component request the session service
     */
    $di->setShared('session', function () {
        $session = new SessionAdapter();
        $session->start();

        return $session;
    });

    /**
     * Crypt service
     */
    $di->set('crypt', function () use ($config) {
        $crypt = new Crypt();
        $crypt->setKey($config->application->cryptSalt);
        return $crypt;
    });

    /**
     * Register the session flash service with the ZURB Foundation classes
     */
    $di->set('flash', function () {
        return new Flash(array(
            'error' => 'callout small alert',
            'success' => 'callout small success',
            'notice' => 'callout small primary',
            'warning' => 'callout small warning'
        ));
    });
} catch (\Phalcon\Exception $e) {
    return $e->getMessage();
}
