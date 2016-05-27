<?php

$loader = new \Phalcon\Loader();

/**
 * We're a registering a set of directories taken from the configuration file
 */

$loader->registerNamespaces(
    array(
        'Starcode\Controllers' => $config->application->controllersDir,
        'Starcode\Models'      => $config->application->modelsDir,
        'Starcode\Library'     => $config->application->libraryDir,
        'Starcode\Plugins'     => $config->application->pluginsDir,
        'Starcode\Forms'       => $config->application->formsDir,
        'Starcode\Validation'  => $config->application->validationDir,
    )
);

$loader->registerDirs(
    array(
        APP_PATH . '/public/securimage/'
    )
);

$loader->register();
