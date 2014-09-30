<?php
$app->get(
    '/test',
    function () use ($app) {
        $app->log->info("Slim-Skeleton '/' route");
        $app->render(
            'test.twig',
            array(
                'pageTitle' => 'RHINO CMS'
            )
        );
    }
);