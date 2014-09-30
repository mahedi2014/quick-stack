<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 8/28/14
 * Time: 5:33 PM
 */

if(App::getUser()){

    $app->view->setData(
        array(
            'userName' => $_SESSION['UserName'],
            'role' => $_SESSION['UserRole'],
            'logedUserID' => $_SESSION['UserLogedID'],
            'logedUserUUID' =>  $_SESSION['userUUID'],
            'logedUser' => App::getUser(),
            'logedProfile' => App::getProfile()
        )
    );

} else{
    $app->view->setData(
        array(
            'userName' => 'Guest',
            'role' => 0
        )
    );
}