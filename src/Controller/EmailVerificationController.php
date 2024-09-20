<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;

class EmailVerificationController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager, LoggerInterface $logger)
    {
        $this->entityManager = $entityManager;
        $this->logger = $logger;
    }

    public function verifyEmail(Request $request): Response
    {

        $this->logger->info('Vérification de l\'email démarrée.');
        // Récupérer le token depuis l'URL
        $token = $request->query->get('token');

        if (!$token) {
            return new JsonResponse(['error' => 'Token manquant'], 400);
        }

        // Chercher l'utilisateur par le token de validation
        $user = $this->entityManager->getRepository(User::class)
            ->findOneBy(['validationToken' => $token]);

        // Vérifier si l'utilisateur existe et n'est pas déjà vérifié
        if (!$user) {
            return new JsonResponse(['error' => 'Token invalide'], 400);
        }

        if ($user->getIsVerified() === 'yes') {
            return new JsonResponse(['message' => 'Votre compte est déjà vérifié.'], 400);
        }

        // Marquer l'utilisateur comme vérifié
        $user->setIsVerified('yes'); 
        $user->setValidationToken(null);  // On retire le token de validation
        $this->entityManager->flush();

        return new JsonResponse(['message' => 'Votre compte a été vérifié avec succès.'], 200);
    }
}
