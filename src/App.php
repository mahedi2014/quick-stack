<?php

class App
{

    private static $_instance;

    public static function getInstance()
    {
        if (!is_null(self::$_instance)) {
            return self::$_instance;
        }
        self::$_instance = new self;
        return self::$_instance;
    }

    public static function returnJson($json = array())
    {
        $app = \Slim\Slim::getInstance();
        $http = $app->response();
        $http['Content-Type'] = 'application/json';
        echo $http->write(json_encode($json));
        exit;
    }

    public static function getModule()
    {
        $app = \Slim\Slim::getInstance();
        $path = $app->request()->getPath();
        $pieces = explode('/', $path);
        if (count($pieces) > 0) {
            $last = end($pieces);
            return $last;
        }
        return '';
    }

    public static function getUser()
    {
        if (isset($_SESSION['userUUID']) &&
            $_SESSION['userUUID'] != '' &&
            ($user = UserQuery::create()->findOneByUUID($_SESSION['userUUID']))
        ) {
            return $user;
        }
        return null;
    }

    /**
     * Get logged User profile information
     *
     * @return null|ChildProfile
     */
    public static function getProfile()
    {
        if (isset($_SESSION['userUUID']) &&
            $_SESSION['userUUID'] != '' &&
            ($profile = ProfileQuery::create()->findOneByUserID(App::getUserId()))
        ) {
            return $profile;
        }
        return null;
    }



    /**
     * returns the database ID of the User
     * @return int
     */
    public static function getUserId()
    {
        $user = self::getUser();
        return $user ? $user->getId() : null;
    }

    /**
     * returns true if the user is logged in
     * @return bool
     */
    public static function userLoggedIn()
    {
        return self::getUserId() > 0;
    }

    /**
     * returns the remote ip (client ip) of the user
     * @return string
     */
    public static function getRemoteAddress()
    {

        if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip_list = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
            return array_pop($ip_list);
        }

        if (isset($_SERVER['REMOTE_IP'])) {
            $ip_list = explode(',', $_SERVER['REMOTE_IP']);
            return array_pop($ip_list);
        }

        if (isset($_SERVER['REMOTE_ADDR'])) {
            $ip_list = explode(',', $_SERVER['REMOTE_ADDR']);
            return array_pop($ip_list);
        }

        return '';
    }

    /**
     * @param String $format
     * @return DateTime|string
     */
    public static function getUserDateTime($format = null)
    {
        return self::getUtcDateTime($format);
    }

    /**
     * returns true if the user is project manager
     * @return bool
     */
    public static function getProjectManager()
    {
        if (self::userLoggedIn()) {
            $projectManager = self::getUser();

            return 2 ? $projectManager->getUserRole() : null;
        }
        return null;
    }

    /**
     * returns true if the user is admin
     * @return bool
     */
    public static function getAdmin()
    {
        if (self::userLoggedIn()) {
            $admin = self::getUser();

            return 1 ? $admin->getUserRole() : null;
        }
        return null;
    }


    /**
     * @param String $format
     * @return DateTime|string
     */
    public static function getUtcDateTime($format = null)
    {
        $serverTimezone = 'UTC';
        $dte = new DateTime('now', new DateTimeZone($serverTimezone));
        return null === $format ? $dte : $dte->format($format);
    }

    /**
     * @param null $dir
     * @param null $fileName
     * @param null $data
     * @param bool $keep
     * @return resource
     */
    public static function savePdf($dir = null, $fileName = null, $data = null, $keep = true)
    {
        $tempPdf = fopen($dir . '/' . $fileName, "w");
        fputs($tempPdf, $data);
        fclose($tempPdf);
        if ($keep === false) {
            unlink($tempPdf);
        }
        return $tempPdf;
    }

    /**
     * @return bool true if database user table fully complete for payment
     */

    public static function isFillUpUser()
    {

        $user = self::getUser();
        if (($user->getEmailAddress() != '') & ($user->getFirstName() != '') & ($user->getLastName() != '')) {
            return true;
        } else {
            return false;
        }
    }

    //checking mandrill and email
    public static function activeMandrillEmail()
    {
        $mandrill = MandrillKeysQuery::create()
            ->findOneByStatus(1)
            ->getMandrillKye();

        $email = SenderEmailQuery::create()
            ->findOneByStatus(1)
            ->getEmailAddress();

        if($mandrill != '' | $email != ''){
            $data = array('key'=>$mandrill, 'email'=> $email);
        } else{
            $data = array('key'=>'Q1D2TWmoxJZbALX6M8TfxA', 'email'=> 'info@previewict.com');
        }

        return $data;
    }



}