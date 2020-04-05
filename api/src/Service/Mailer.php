<?php

namespace App\Service;

use SendinBlue\Client\Api\SMTPApi;

class Mailer
{
    private $sendinblue;

    private $templates = [
        'user_order_validation' => 2,
        'user_order_confirmation' => 3,
        'user_order_canceled_by_user' => 7,
        'user_order_canceled_by_prod' => 4,
        'prod_password_forget' => 6,
        'prod_register_confirmation' => 5,
        'prod_order_canceled_by_user' => 9,
        'prod_order_new' => 8,
    ];

    public function __construct(SMTPApi $sendinblue)
    {
        $this->sendinblue = $sendinblue;
    }

    public function sendMail(string $mailTo, string $templateId, array $params = []): void
    {
        $sendSmtpEmail = new \SendinBlue\Client\Model\SendSmtpEmail();
        $sendSmtpEmail['to'] = array(array('email'=>$mailTo));
        $sendSmtpEmail['templateId'] = $this->templates[$templateId];

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
