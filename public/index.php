<?php
mb_internal_encoding('UTF-8');
mb_http_output('UTF-8');
date_default_timezone_set('Asia/Dhaka');

session_start();

require_once dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'environment.php';

/**
 * Some startup functions
 */
function requireLogin()
{
    if (!App::userLoggedIn()) {
        $app = \Slim\Slim::getInstance();
        if (!$app->request()->isAjax()) {
            $app->flash('error', 'You must be logged in to access that page');
            $app->redirect('/');
        } else {
            App::returnJson(
                array(
                    'status' => 'error',
                    'message' => 'You must be logged in to access that page'
                )
            );
        }
    }
}

function requireAdmin()
{
    $app = \Slim\Slim::getInstance();
    if (!App::getAdmin()) {
        if (!$app->request()->isAjax()) {
            $app->flash('error', 'You don\'t have permission to access that page');
            $app->redirect('/home');
        } else {
            App::returnJson(
                array(
                    'status' => 'error',
                    'message' => 'You must be logged in to access that page'
                )
            );
        }

    }
}

function requireProjectManager()
{
    $app = \Slim\Slim::getInstance();
    if (!App::getProjectManager()) {
        if (!$app->request()->isAjax()) {
            $app->flash('error', 'You don\'t have permission to access that page');
            $app->redirect('/home');
        } else {
            App::returnJson(
                array(
                    'status' => 'error',
                    'message' => 'You must be logged in to access that page'
                )
            );
        }

    }
}


require_once dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'app.php';

$app->run();