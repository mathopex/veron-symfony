<?php
namespace App\Service;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class SomeService
{
    private $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function sendEmail(string $recipientEmail, string $newPassword)
    {
        $email = (new Email())
            ->from('noreply@veron.app.com')
            ->to($recipientEmail)
            ->subject('Votre nouveau mot de passe')
            ->text('Voici votre nouveau mot de passe : ' . $newPassword);
        $this->mailer->send($email);
    }
}
