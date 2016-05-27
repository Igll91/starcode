<?php
/**
 * Services are globally registered in this file
 *
 * @var \Phalcon\Config $config
 */

use Phalcon\Di\FactoryDefault;
use Phalcon\Mvc\View;
use Phalcon\Mvc\Url as UrlResolver;
use Phalcon\Mvc\View\Engine\Volt as VoltEngine;
use Phalcon\Mvc\Model\Metadata\Memory as MetaDataAdapter;
use Phalcon\Session\Adapter\Files as SessionAdapter;
use Phalcon\Flash\Direct as Flash;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Events\Manager as EventsManager;

/**
 * The FactoryDefault Dependency Injector automatically register the right services providing a full stack framework
 */
$di = new FactoryDefault();

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
                               '.volt'  => function ($view, $di) use ($config) {

                                   $volt = new VoltEngine($view, $di);

                                   $volt->setOptions(array(
                                                         'compiledPath'      => $config->application->cacheDir,
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
    $adapter  = $dbConfig['adapter'];
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
 * Register the session flash service with the Twitter Bootstrap classes
 */
$di->set('flash', function () {
    return new Flash(array(
                         'error'   => 'alert alert-danger',
                         'success' => 'alert alert-success',
                         'notice'  => 'alert alert-info',
                         'warning' => 'alert alert-warning'
                     ));
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
 * Dispatcher use a default namespace
 */
$di->set('dispatcher', function () {
    $dispatcher    = new Dispatcher();
    $eventsManager = new EventsManager;
    $dispatcher->setDefaultNamespace('Starcode\Controllers');

    /**
     * Check if the user is allowed to access certain action using the SecurityPlugin
     */
    $eventsManager->attach('dispatch:beforeExecuteRoute', new \Starcode\Library\Auth\Security());

    /**
     * Handle exceptions and not-found exceptions using NotFoundPlugin
     */
    $eventsManager->attach('dispatch:beforeException', new \Starcode\Plugins\NotFoundPlugin());

    $dispatcher->setEventsManager($eventsManager);

    return $dispatcher;
});

/**
 * Translation
 */
$di->setShared('trans', function () use ($di) {
    $session = $di->getShared('session');
    $request = $di->getShared('request');

    // Get language code
    if ($session->has("lg")) {
        $language = $session->get("lg");
    } else {
        // Ask browser what is the best language
        $language = $request->getBestLanguage();
    }

    // Check if we have a translation file for that language
    if (file_exists(APP_PATH . "/app/messages/" . $language . ".php")) {
        require APP_PATH . "/app/messages/" . $language . ".php";
    } else {
        // Fallback to default language
        require APP_PATH . "/app/messages/hr.php";
    }

    // Return a translation object
    return new \Phalcon\Translate\Adapter\NativeArray(array(
                                                          "content" => $messages
                                                      ));
});

/**
 *
 */
$di->setShared('config', $config);

$di->setShared('auth', function () use ($di) {
    $logger = new \Phalcon\Logger\Adapter\File(APP_PATH . "/app/logs/auth.log", "w");
    return new \Starcode\Library\Auth\Auth($logger);
});
