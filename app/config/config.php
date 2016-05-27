<?php

defined('APP_PATH') || define('APP_PATH', realpath('.'));

return new \Phalcon\Config(array(
                               'database'         => array(
                                   'adapter'  => 'Mysql',
                                   'host'     => 'localhost',
                                   'username' => 'root',
                                   'password' => 'mHCbTh54KH2VE6vB',
                                   'dbname'   => 'starcode',
                                   'charset'  => 'utf8',
                               ),
                               'application'      => array(
                                   'controllersDir' => APP_PATH . '/app/controllers/',
                                   'modelsDir'      => APP_PATH . '/app/models/',
                                   'migrationsDir'  => APP_PATH . '/app/migrations/',
                                   'viewsDir'       => APP_PATH . '/app/views/',
                                   'pluginsDir'     => APP_PATH . '/app/plugins/',
                                   'formsDir'       => APP_PATH . '/app/forms/',
                                   'validationDir'  => APP_PATH . '/app/validation/',
                                   'libraryDir'     => APP_PATH . '/app/library/',
                                   'cacheDir'       => APP_PATH . '/app/cache/',
                                   'baseUri'        => '/~silvio/phalcon/starcode/',
                               ),
                               'fallbackLanguage' => "hr"
                           ));
