<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 9/21/14
 * Time: 7:37 PM
 */

$app->get(
    '/dashboard',
    'requireLogin',
    function () use ($app) {

        $app->log->info("Slim-Skeleton '/' route");
        $app->render(
            'index.twig',
            array(
                'pageTitle' => 'RHINO-CMS',
                'menu' => 'dashboard',
                'submenu' => 'home'
            )
        );
    }
);

