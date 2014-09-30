<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 9/23/14
 * Time: 5:08 PM
 */
$app->group(
    '/user',
    'requireAdmin',
    function () use ($app) {
        //User list
        $app->get(
            '/',
            function () use ($app) {
                $users = UserQuery::create()
                    ->orderByCreatedAt('DESC')
                    ->find()
                    ->toArray();

                $app->log->info("Slim-Skeleton '/' route");
                $app->render(
                    'admin-user-list.twig',
                    array(
                        'pageTitle' => 'RHINO-CMS | User list',
                        'menu'=> 'users',
                        'sudmenu' => 'userList',
                        'users' => array_reverse($users)
                    )
                );
            }
        );

        //A user details
        $app->group(
            '/view',
            function () use ($app) {
                //view
                $app->get(
                    '/:UUID',
                    function ($UUID) use ($app) {
                        $user = UserQuery::create()
                            ->findOneByUUID($UUID);

                        $profile = ProfileQuery::create()
                            ->findOneByUserID($user->getID());

                        $app->log->info("Slim-Skeleton '/' route");
                        $app->render(
                            'admin-user-profile-view.twig',
                            array(
                                'pageTitle' => 'RHINO-CMS | User details',
                                'menu'=> 'users',
                                'sudmenu' => 'userList',
                                'user' => $user,
                                'profile' => $profile

                            )
                        );
                    }
                );

                //Update profile
                $app->put(
                    '/:UUID',
                    function ($UUID) use ($app) {

                        $formPart = strtolower($app->request()->put('form-part'));

                        $firstName = strtolower(filter_var($app->request()->put('first-name'), FILTER_SANITIZE_STRING));
                        $lastName = strtolower(filter_var($app->request()->put('last-name'), FILTER_SANITIZE_STRING));
                        $gender = strtolower(filter_var($app->request()->put('gender'), FILTER_SANITIZE_STRING));
                        $dateOfBirth = $app->request()->post('date-of-birth');
                        $phoneNumber = strtolower(filter_var($app->request()->put('phone-number'), FILTER_SANITIZE_STRING));
                        $mobileNumber = strtolower(filter_var($app->request()->put('mobile-number'), FILTER_SANITIZE_STRING));
                        $companyName = strtolower(filter_var($app->request()->put('company-name'), FILTER_SANITIZE_STRING));
                        $primaryAddressStreet = strtolower(filter_var($app->request()->put('primary-address-street'), FILTER_SANITIZE_STRING));
                        $primaryAddressStreet2 = strtolower(filter_var($app->request()->put('primary-address-street-2'), FILTER_SANITIZE_STRING));
                        $state = strtolower(filter_var($app->request()->put('state'), FILTER_SANITIZE_STRING));
                        $city = strtolower(filter_var($app->request()->put('city'), FILTER_SANITIZE_STRING));
                        $postCode = strtolower(filter_var($app->request()->put('post-code'), FILTER_SANITIZE_STRING));
                        $country = strtolower(filter_var($app->request()->put('country'), FILTER_SANITIZE_STRING));

                        $billingStreet = strtolower(filter_var($app->request()->put('billing-address-street'), FILTER_SANITIZE_STRING));
                        $billingCity = strtolower(filter_var($app->request()->put('billing-city'), FILTER_SANITIZE_STRING));
                        $billingState = strtolower(filter_var($app->request()->put('billing-state'), FILTER_SANITIZE_STRING));
                        $billingPostCode = strtolower(filter_var($app->request()->put('billing-post-code'), FILTER_SANITIZE_STRING));
                        $billingCountry = strtolower(filter_var($app->request()->put('billing-country'), FILTER_SANITIZE_STRING));;

                        $firstQuestion = strtolower(filter_var($app->request()->put('first-question'), FILTER_SANITIZE_STRING));;
                        $secondQuestion = strtolower(filter_var($app->request()->put('second-question'), FILTER_SANITIZE_STRING));;
                        $customQuestion = strtolower(filter_var($app->request()->put('custom-question'), FILTER_SANITIZE_STRING));;
                        $firstAns = strtolower(filter_var($app->request()->put('first-answer'), FILTER_SANITIZE_STRING));;
                        $secondAns = strtolower(filter_var($app->request()->put('second-answer'), FILTER_SANITIZE_STRING));;
                        $customAns = strtolower(filter_var($app->request()->put('custom-answer'), FILTER_SANITIZE_STRING));;

                        $newPassword = strtolower(filter_var($app->request()->post('newPassword'), FILTER_SANITIZE_STRING));
                        $reTypeNewPassword = strtolower(filter_var($app->request()->post('reTypeNewPassword'), FILTER_SANITIZE_STRING));

                        $user = UserQuery::create()
                            ->findOneByUUID($UUID);

                        $profile = ProfileQuery::create()
                            ->findOneByUserID($user->getID());

                        if($formPart == 'profile'){


                            $profile->setFirstName($firstName);
                            $profile->setLastName($lastName);
                            if($gender != ''){
                                $profile->setGender($gender);
                            }
                            $profile->setDateOfBirth($dateOfBirth);
                            $profile->setPhoneNumber($phoneNumber);
                            $profile->setMobileNumber($mobileNumber);



                            $profile->setCompanyName($companyName);
                            $profile->setPrimaryAddressStreet($primaryAddressStreet);
                            $profile->setPrimaryAddressStreet2($primaryAddressStreet2);
                            $profile->setPrimaryAddressState($state);
                            $profile->setPrimaryAddressCity($city);

                            $profile->setPrimaryAddressPostCode($postCode);
                            $profile->setPrimaryAddressCountry($country);

                            if($profile->save()){
                                $app->flash('info', 'User information update successfully done.');
                                $app->redirect($_SERVER['HTTP_REFERER']);
                            }

                        }elseif($formPart == 'billing'){
                            $profile->setBillingAddressStreet($billingStreet);
                            $profile->setBillingAddressCity($billingCity);
                            $profile->setBillingAddressState($billingState);
                            $profile->setBillingAddressPostCode($billingPostCode);
                            $profile->setBillingAddressCountry($billingCountry);

                            if($profile->save()){
                                $app->flash('info', 'User billing information update successfully done.');
                                $app->redirect($_SERVER['HTTP_REFERER']);
                            }

                        } elseif($formPart == 'security'){
                            $profile->setFirstSecurityQuestion($firstQuestion);
                            $profile->setFirstSecurityQuestionAnswer($firstAns);
                            $profile->setSecondSecurityQuestion($secondQuestion);
                            $profile->setSecondSecurityQuestionAnswer($secondAns);
                            $profile->setCustomSecurityQuestion($customQuestion);
                            $profile->setCustomSecurityAnswer($customAns);

                            if($profile->save()){
                                $app->flash('info', 'User security questions update successfully done.');
                                $app->redirect($_SERVER['HTTP_REFERER']);
                            }

                        } elseif($formPart == 'profile-image'){ //image change
                            $imgPath = 'uploads/'.uniqid().$_FILES["file"]["name"];
                            if(move_uploaded_file($_FILES["file"]["tmp_name"], $imgPath)){
                                $profile->setProfileImage($imgPath);
                            }
                            if($profile->save()){
                                $app->flash('info', "User's profile picture updated");
                                $app->redirect($_SERVER['HTTP_REFERER']);
                            }

                        }elseif($formPart == 'password'){ //password change
                            if($newPassword == ''){
                                $app->flash('error', 'New password can not be empty');
                                $app->redirect($_SERVER['HTTP_REFERER']);

                            } elseif($reTypeNewPassword == ''){
                                $app->flash('error', 'Re-type password can not be empty');
                                $app->redirect($_SERVER['HTTP_REFERER']);

                            } elseif($newPassword != $reTypeNewPassword ){
                                $app->flash('error', 'New password and re-type password does not match');
                                $app->redirect($_SERVER['HTTP_REFERER']);

                            } else{
                                $user = UserQuery::create()
                                    ->findOneByUUID($UUID);

                                if($formPart == 'password'){
                                    $user->setPassword(password_hash($newPassword, PASSWORD_DEFAULT));
                                    if($user->save()){
                                        $app->flash('info', 'Password successfully done.');
                                        $app->redirect($_SERVER['HTTP_REFERER']);

                                    } else{
                                        $app->flash('error', 'Sorry! Something wrong. Please contact with webmaster.');
                                        $app->redirect($_SERVER['HTTP_REFERER']);
                                    }
                                }
                            }


                        }else{
                            $app->flash('error', 'Some thing wrong');
                            $app->redirect($_SERVER['HTTP_REFERER']);
                        }
                    }
                );
            }
        );


        //set user admin/general
        $app->get(
            '/role/:userRole/:UUID',
            function ($userRole, $UUID) use ($app) {
                $user = UserQuery::create()
                    ->filterByUUID($UUID)
                    ->findOneByUserRole($userRole);

                if($userRole == 0){
                    $user->setUserRole(1);

                } elseif($userRole == 1){

                    $user->setUserRole(0);
                }

                if($user->save()){
                    $app->flash('info', 'User role updated');
                    $app->redirect($_SERVER['HTTP_REFERER']);

                } else{
                    $app->flash('error', 'Sorry! User role can not be updated.');
                    $app->redirect($_SERVER['HTTP_REFERER']);
                }



            }
        );

        //set user visible/invisible
        $app->get(
            '/visibility/:isVisible/:UUID',
            function ($isVisible, $UUID) use ($app) {
                $user = UserQuery::create()
                    ->filterByUUID($UUID)
                    ->findOneByIsVisible($isVisible);

                if($isVisible == 0){
                    $user->setIsVisible(1);

                } elseif($isVisible == 1){

                    $user->setIsVisible(0);
                }

                if($user->save()){
                    $app->flash('info', 'User visibility updated');
                    $app->redirect($_SERVER['HTTP_REFERER']);

                } else{
                    $app->flash('error', 'Sorry! User visibility can not be updated.');
                    $app->redirect($_SERVER['HTTP_REFERER']);
                }



            }
        );
    }
);
