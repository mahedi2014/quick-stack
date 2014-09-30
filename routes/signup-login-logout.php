<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 8/27/14
 * Time: 3:27 PM
 */
$app->get(
    '/',
    function () use ($app) {
        if (App::userLoggedIn()) {
//            $app->redirect('/dashboard');
            $app->redirect('/profile');
        } else{
            $app->redirect('/signin');
        }
    }
);


$app->group(
    '/signup',
    function () use ($app) {
        $app->get(
            '/',
            function () use ($app) {
                if (App::userLoggedIn()) {
                    $app->redirect('/dashboard');

                } else{
                    $app->log->info("Slim-Skeleton '/' route");
                    $app->render(
                        'signup.twig',
                        array(
                            'pageTitle' => 'Sign up'
                        )
                    );
                }

            }
        );

        $app->post(
            '/',
            function () use ($app) {
                $userName = strtolower(filter_var($app->request()->post('username'), FILTER_SANITIZE_STRING));
                $emailAddress =  strtolower(filter_var($app->request()->post('email'), FILTER_SANITIZE_EMAIL));
                $password = filter_var($app->request()->post('password'), FILTER_SANITIZE_STRING);
                $confirmPassword = filter_var($app->request()->post('confirm_password'), FILTER_SANITIZE_STRING);
                $agreement = $app->request()->post('agreement');


                //Data process
                if($userName == ''){
                    $app->flash('error', 'Username can not be empty');
                    $app->redirect('/signup');

                }elseif($emailAddress == ''){
                    $app->flash('error', 'Email can not be empty');
                    $app->redirect('/signup');

                }elseif($password == ''){
                    $app->flash('error', 'Password can not be empty');
                    $app->redirect('/signup');

                }elseif($confirmPassword == ''){
                    $app->flash('error', 'Confirm password can not be empty');
                    $app->redirect('/signup');

                }elseif($password != $confirmPassword ){
                    $app->flash('error', 'Confirm password not match');
                    $app->redirect('/signup');

                }elseif(!$agreement ){
                    $app->flash('error', 'Please accept agreement');
                    $app->redirect('/signup');

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
                            $app->flash('info', 'Signup successfully done. Please login to access your account');
                            $app->redirect('/signin');

                        } else{
                            $app->flash('info', 'Something wrong.');
                            $app->redirect('/signup');
                        }


                    } else {
                    $app->flash('error', 'Email address already exist');
                    $app->redirect('/signup');
                }
            }


            }
);

}
);


$app->group(
    '/signin',
    function () use ($app) {
        $app->get(
            '/',
            function () use ($app) {
                if (App::userLoggedIn()) {
                    $app->redirect('/dashboard');

                } else{
                    $app->log->info("Slim-Skeleton '/' route");
                    $app->render(
                        'signin.twig',
                        array(
                            'pageTitle' => 'Sign in'
                        )
                    );
                }

            }
        );

        $app->post(
            '/',
            function () use ($app) {
                $emailAddress = strtolower(filter_var($app->request()->post('email'), FILTER_SANITIZE_STRING));
                $password = filter_var($app->request()->post('password'), FILTER_SANITIZE_STRING);

                //Data process
                if ($emailAddress != '' && $password != '') {

                    // get user here from propel
                    $user = UserQuery::create()
                        ->findOneByEmailAddress($emailAddress);

                    if ($user) {

                        if (!$user->getIsVisible()) {
                            $app->flash('error', 'Sorry! You are not authorized. Please contact with admin');
                            $app->redirect('/signin');
                        }

                        if (password_verify($password, $user->getPassword())) {
                            $_SESSION['UserName'] = $user->getUserName();
                            $_SESSION['UserLogedID'] = $user->getID();
                            $_SESSION['userUUID'] = $user->getUUID();
                            $_SESSION['UserRole'] = $user->getUserRole();
                            $app->redirect('/dashboard');

                        } else {
                            $app->flash('error', 'Invalid email address and/or password');
                            $app->redirect('/signin');
                        }

                    } else {
                        $app->flash('error', 'Invalid email address and/or password');
                        $app->redirect('/signin');
                    }
                } else{
                    $app->flash('error', 'Invalid email address and/or password');
                    $app->redirect('/signin');
                }


            }
        );

    }
);




$app->get(
    '/logout',
    function () use ($app) {
        unset($_SESSION['UserName']);
        unset($_SESSION['UserUUID']);
        unset($_SESSION['UserRole']);
        session_destroy();
        $app->redirect('/signin');
    }
);
