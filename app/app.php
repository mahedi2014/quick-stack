<?php

// Prepare view
$app->view(new \Slim\Views\Twig());
$app->view->parserOptions = array(
    'charset' => 'utf-8',
    'cache' => realpath('../templates/cache'),
    'debug' => true,
    'auto_reload' => true,
    'strict_variables' => false,
    'autoescape' => true
);
$app->view->parserExtensions = array(new \Slim\Views\TwigExtension(), new Twig_Extension_Debug());

// Define routes
require_once dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'routes/global.php';
require_once dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'routes/error.php';
require_once dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'routes/signup-login-logout.php';
require_once dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'routes/dashboard.php';
require_once dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'routes/profile.php';

require_once dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'routes/admin-user-list.php';
require_once dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'routes/admin-add-user.php';

require_once dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'routes/test.php';

/* End of file app.php */