<?php

namespace App\Controllers;

use App\View;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mime\Email;

class MailController{
    
    public function index(){
        return View::make('mail');
    }

    public function sendEmail(){
        echo 'the email is : ' . $_POST['email'] . '<br/>';

        try{
            $email = (new Email())
            ->from($_ENV['MAIL_FROM'])
            ->to($_POST['email'])
            ->subject('Time for Symfony Mailer!')
            ->text('Sending emails is fun again!')
            ->html('<p>See Twig integration for better HTML integration!</p>');
    
            $dsn = 'smtp://'.$_ENV['MAIL_USERNAME'].':'.$_ENV['MAIL_PASSWORD'].'@'.$_ENV['MAIL_HOSTNAME'].':'.$_ENV['MAIL_PORT'];
            $transport = Transport::fromDsn($dsn);
    
            $mailer = new Mailer($transport);
            $mailer->send($email);

        }catch(\Exception $e){
            echo $e->getMessage();
        }

    }
}