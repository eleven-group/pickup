<?php

namespace App\Service;

use SendinBlue\Client\Api\SMTPApi;

class Mailer
{
    private $sendinblue;

    public function __construct(SMTPApi $sendinblue)
    {
        $this->sendinblue = $sendinblue;
    }
    
    public function sendMail(string $mailTo, int $templateId, array $params = []): void
    {
        $sendSmtpEmail = new \SendinBlue\Client\Model\SendSmtpEmail();
        $sendSmtpEmail['to'] = array(array('email'=>$mailTo));
        $sendSmtpEmail['templateId'] = $templateId;
        if(!empty($params)){
            $sendSmtpEmail['params'] = $params;
        }
        
        try {
            $this->sendinblue->sendTransacEmail($sendSmtpEmail);
        } catch (Exception $e) {
            echo 'Exception when calling SMTPApi->sendTransacEmail: ', $e->getMessage(), PHP_EOL;
        }
    }
}