<?php
define('ROOT_DIR', dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR);
require ROOT_DIR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

require_once ROOT_DIR . 'propel/generated-conf/config.php';

// Prepare app
$app = new \Slim\Slim(array(
    'templates.path' => dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'templates',
));

// Create monolog logger and store logger in container as singleton
// (Singleton resources retrieve the same log resource definition each time)
$app->container->singleton(
    'log',
    function () {
        $log = new \Monolog\Logger('slim-skeleton');
        $log->pushHandler(new \Monolog\Handler\StreamHandler(dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'logs' . DIRECTORY_SEPARATOR . 'app.log', \Monolog\Logger::DEBUG));
        return $log;
    }
);
