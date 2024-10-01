<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\UserRepository;

class EmailCheckController extends AbstractController
{
    #[Route('/email/check', name: 'app_email_check')]
    public function index(Request $request, UserRepository $userRepository): Response
    {
        $data = $request->get('email');
        $email = $data ?? null;

        if (!$email || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return $this->json(['error' => 'Invalid email format'], Response::HTTP_BAD_REQUEST);
        }

        $userExists = $userRepository->findOneBy(['email' => $email]) !== null;
        return $this->json(['exists' => $userExists]);
    }
}
