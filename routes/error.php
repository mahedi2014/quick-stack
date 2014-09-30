<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 9/22/14
 * Time: 12:03 PM
 */
//404 page
$app->notFound(
    function () use ($app) {

        $app->log->info("Slim-Skeleton '/' route");
        $app->render(
            'error404.twig',
            array(
                'pageTitle' => 'RHINO-CMS | Missing 404 page',
                'page' => '404'
            )
        );

    }
);
