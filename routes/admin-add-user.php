<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 9/25/14
 * Time: 1:45 PM
 */

$app->group(
    '/addUser',
    function () use ($app) {
        $app->get(
            '/',
            function () use ($app) {

                $app->log->info("Slim-Skeleton '/' route");
                $app->render(
                    'admin-add-user.twig',
                    array(
                        'pageTitle' => 'RHINO-CMS | Add user',
                        'menu'=> 'users',
                        'sudmenu' => 'addUser',
                    )
                );
            }
        );

        $app->post(
            '/',
            function () use ($app) {
                $userName = strtolower(filter_var($app->request()->post('username'), FILTER_SANITIZE_STRING));
                $emailAddress =  strtolower(filter_var($app->request()->post('email'), FILTER_SANITIZE_EMAIL));
                $password = filter_var($app->request()->post('password'), FILTER_SANITIZE_STRING);
                $confirmPassword = filter_var($app->request()->post('confirm_password'), FILTER_SANITIZE_STRING);


                //Data process
                if($userName == ''){
                    $app->flash('error', 'Username can not be empty');
                    $app->redirect($_SERVER['HTTP_REFERER']);

                }elseif($emailAddress == ''){
                    $app->flash('error', 'Email can not be empty');
                    $app->redirect($_SERVER['HTTP_REFERER']);

                }elseif($password == ''){
                    $app->flash('error', 'Password can not be empty');
                    $app->redirect($_SERVER['HTTP_REFERER']);

                }elseif($confirmPassword == ''){
                    $app->flash('error', 'Confirm password can not be empty');
                    $app->redirect($_SERVER['HTTP_REFERER']);

                }elseif($password != $confirmPassword ){
                    $app->flash('error', 'Confirm password not match');
                    $app->redirect($_SERVER['HTTP_REFERER']);

                }else {
                    // get user here from propel
                    $isUser = UserQuery::create()
                        ->filterByEmailAddress($emailAddress)
                        ->count();

                    if ($isUser == 0) {

                        $user = new User();
                        $user->setUUID(UUID::v4());
                        $user->setUserName($userName);
                        $user->setEmailAddress($emailAddress);
                        $user->setPassword(password_hash($password, PASSWORD_DEFAULT));
                        $user->setIsVisible(1);

                        $profile = new Profile();
                        $profile->setUser($user);
                        $profile->setUUID(UUID::v4());

                        if($profile->save()){
                            $app->flash('info', "User add successfully done. Please complete user's information");
                            $app->redirect('/user/view/'.$user->getUUID());

                        } else{
                            $app->flash('info', 'Something wrong.');
                            $app->redirect($_SERVER['HTTP_REFERER']);
                        }


                    } else {
                        $app->flash('error', 'Email address already exist');
                        $app->redirect($_SERVER['HTTP_REFERER']);
                    }
                }


            }
        );
    }
);
