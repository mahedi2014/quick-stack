<?php
require '../vendor/mandrill/mandrill/src/Mandrill.php';
class Email
{
    public $manrill;
    public $message;
    public $key;
    public $sender;


    public function __construct($data)
    {
        //return $this->manrill = new Mandrill('key');
        $this->key = $data['key'];
        $this->sender = $data['email'];
        $this->manrill = new Mandrill($this->key);
    }


    public function sendMail($subject, $to, $htmlContent)
    {
        $fromName = 'SEO MOnitoring'; // Sender Name
        $from = $this->sender; //sender email
        $this->message = array(
            'subject' => $subject,
            'from_email' => '.' . $from,
            'from_name' => $fromName,
            'html' => $htmlContent,
            'to' => array(
                array(
                    'email' => $to,
                    'type' => 'to'
                )
            ),
            'merge_vars' => array(
                array(
                    'rcpt' => $to,
                    'vars' =>
                        array(
                            array(
                                'name' => 'FIRSTNAME',
                                'content' => 'Recipient 1 first name'),
                            array(
                                'name' => 'LASTNAME',
                                'content' => 'Last name')
                        )
                )
            )
        );
        $result = $this->manrill->messages->send($this->message, $async = false, $ip_pool = '', $send_at = '');
        return $result;
    }

}