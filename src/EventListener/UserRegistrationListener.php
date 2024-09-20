<?php

namespace App\EventListener;

use Doctrine\Persistence\Event\LifecycleEventArgs;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use App\Entity\User;

class UserRegistrationListener {
    private $mailer;

    public function __construct(MailerInterface $mailer) {
        $this->mailer = $mailer;
    }

    public function postPersist(LifecycleEventArgs $eventArgs): void {
        $user = $eventArgs->getObject();

        // Vérifier si l'entité est bien une instance de User
        if (!$user instanceof User) {
            return; // Si ce n'est pas un User, on ne fait rien
        }
        
        // Générer un token de validation
        $validationToken = bin2hex(random_bytes(32));
        $user->setValidationToken($validationToken);

        // Enregistrer le token en base de données
        $entityManager = $eventArgs->getObjectManager();
        $entityManager->flush();

        // Envoyer l'email de validation
        $this->sendValidationEmail($user);
    }

    private function sendValidationEmail(User $user): void {
        $email = (new Email())
            ->from('noreply@veron-app.com')
            ->to($user->getEmail())
            ->subject('Vérification de votre compte')
            ->html(sprintf(
                '<p>Veuillez cliquer sur le lien suivant pour vérifier votre compte :</p><p><a href="www.veron-app.com/verify-email?token=%s">Vérifier mon compte</a></p>',
                $user->getValidationToken()
            ));

        $this->mailer->send($email);
    }
}
