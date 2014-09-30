<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 9/21/14
 * Time: 7:37 PM
 */

$app->group(
    '/profile',
    'requireLogin',
    function () use ($app) {
        $app->get(
            '/',
            function () use ($app) {

                $app->log->info("Slim-Skeleton '/' route");
                $app->render(
                    'profile.twig',
                    array(
                        'pageTitle' => 'RHINO-CMS'
                    )
                );
            }
        );

        $app->post(
            '/',
            function () use ($app) {
                $formPart = strtolower($app->request()->post('form-part'));

                $firstName = strtolower(filter_var($app->request()->post('first-name'), FILTER_SANITIZE_STRING));
                $lastName = strtolower(filter_var($app->request()->post('last-name'), FILTER_SANITIZE_STRING));
                $gender = strtolower(filter_var($app->request()->post('gender'), FILTER_SANITIZE_STRING));
                $dateOfBirth = $app->request()->post('date-of-birth');
                $phoneNumber = strtolower(filter_var($app->request()->post('phone-number'), FILTER_SANITIZE_STRING));
                $mobileNumber = strtolower(filter_var($app->request()->post('mobile-number'), FILTER_SANITIZE_STRING));
                $companyName = strtolower(filter_var($app->request()->post('company-name'), FILTER_SANITIZE_STRING));
                $primaryAddressStreet = strtolower(filter_var($app->request()->post('primary-address-street'), FILTER_SANITIZE_STRING));
                $primaryAddressStreet2 = strtolower(filter_var($app->request()->post('primary-address-street-2'), FILTER_SANITIZE_STRING));
                $state = strtolower(filter_var($app->request()->post('state'), FILTER_SANITIZE_STRING));
                $city = strtolower(filter_var($app->request()->post('city'), FILTER_SANITIZE_STRING));
                $postCode = strtolower(filter_var($app->request()->post('post-code'), FILTER_SANITIZE_STRING));
                $country = strtolower(filter_var($app->request()->post('country'), FILTER_SANITIZE_STRING));

                $billingStreet = strtolower(filter_var($app->request()->post('billing-address-street'), FILTER_SANITIZE_STRING));
                $billingCity = strtolower(filter_var($app->request()->post('billing-city'), FILTER_SANITIZE_STRING));
                $billingState = strtolower(filter_var($app->request()->post('billing-state'), FILTER_SANITIZE_STRING));
                $billingPostCode = strtolower(filter_var($app->request()->post('billing-post-code'), FILTER_SANITIZE_STRING));
                $billingCountry = strtolower(filter_var($app->request()->post('billing-country'), FILTER_SANITIZE_STRING));

                $firstQuestion = strtolower(filter_var($app->request()->post('first-question'), FILTER_SANITIZE_STRING));
                $secondQuestion = strtolower(filter_var($app->request()->post('second-question'), FILTER_SANITIZE_STRING));
                $customQuestion = strtolower(filter_var($app->request()->post('custom-question'), FILTER_SANITIZE_STRING));
                $firstAns = strtolower(filter_var($app->request()->post('first-answer'), FILTER_SANITIZE_STRING));
                $secondAns = strtolower(filter_var($app->request()->post('second-answer'), FILTER_SANITIZE_STRING));
                $customAns = strtolower(filter_var($app->request()->post('custom-answer'), FILTER_SANITIZE_STRING));

                $profile = ProfileQuery::create()
                    ->findOneByUserID(App::getUserId());
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

                } elseif($formPart == 'profile-image'){
                    $imgPath = 'uploads/'.uniqid().$_FILES["file"]["name"];
                    if(move_uploaded_file($_FILES["file"]["tmp_name"], $imgPath)){
                        $profile->setProfileImage($imgPath);
                    }
                    if($profile->save()){
                        $app->flash('info', 'Profile picture updated');
                        $app->redirect($_SERVER['HTTP_REFERER']);
                    }

                }else{
                        $app->flash('error', 'Some thing wrong');
                        $app->redirect($_SERVER['HTTP_REFERER']);
                }

            }
        );

        //change password
        $app->put(
            '/',
            function () use ($app) {
                $formPart = strtolower($app->request()->post('form-part'));
                $oldPassword = strtolower(filter_var($app->request()->post('oldPassword'), FILTER_SANITIZE_STRING));
                $newPassword = strtolower(filter_var($app->request()->post('newPassword'), FILTER_SANITIZE_STRING));
                $reTypeNewPassword = strtolower(filter_var($app->request()->post('reTypeNewPassword'), FILTER_SANITIZE_STRING));

                if($oldPassword == '' ){
                    $app->flash('error', 'Old password can not be empty');
                    $app->redirect($_SERVER['HTTP_REFERER']);

                } elseif($newPassword == ''){
                    $app->flash('error', 'New password can not be empty');
                    $app->redirect($_SERVER['HTTP_REFERER']);

                } elseif($reTypeNewPassword == ''){
                    $app->flash('error', 'Re-type password can not be empty');
                    $app->redirect($_SERVER['HTTP_REFERER']);

                } elseif($newPassword != $reTypeNewPassword ){
                    $app->flash('error', 'New password and re-type password does not match');
                    $app->redirect($_SERVER['HTTP_REFERER']);

                } elseif($formPart != 'password'){
                    $app->flash('error', 'Sorry! Not accepting data pass');
                    $app->redirect($_SERVER['HTTP_REFERER']);
                } else{

                    if($formPart == 'password'){
                        $user = UserQuery::create()
                            ->findOneByID(App::getUserId());

                        if (password_verify($oldPassword, $user->getPassword())) { //check old password with db

                            $user->setPassword(password_hash($newPassword, PASSWORD_DEFAULT));
                            if($user->save()){
                                $app->flash('info', 'Password successfully done.');
                                $app->redirect($_SERVER['HTTP_REFERER']);

                            } else{
                                $app->flash('error', 'Sorry! Something wrong. Please contact with webmaster.');
                                $app->redirect($_SERVER['HTTP_REFERER']);
                            }

                        } else{
                            $app->flash('error', 'Sorry! Old password does not match');
                            $app->redirect($_SERVER['HTTP_REFERER']);
                        }

                    } else{
                        $app->flash('error', 'Sorry! Data is not valid.');
                        $app->redirect($_SERVER['HTTP_REFERER']);
                    }
                }



            }
        );


    }
);
