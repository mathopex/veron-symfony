<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Repository\RawFavoriteRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class RawFavoriteController extends AbstractController
{
    public function __construct(RawFavoriteRepository $rawFavoriteRepository)
    {

        $this->rawFavoriteRepository = $rawFavoriteRepository;
    }

    #[Route("/user/{id}/favorites", name: 'app_raw_favorite')]
    public function getUserFavorites(int $id): JsonResponse
    {
        $favorites = $this->rawFavoriteRepository->findByUser($id);

        // Convertir les objets en tableau pour la réponse JSON
        $favoritesArray = array_map(function($favorite) {
            return [
                'id' => $favorite->getId(),
                'user_id' => $favorite->getUser()->getId(),
                'raw_id' => $favorite->getRaw()->getId()
            ];
        }, $favorites);

        return new JsonResponse($favoritesArray);
    }

}
