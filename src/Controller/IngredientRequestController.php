<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Repository\IngredientRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IngredientRequestController extends AbstractController
{
    public function __construct(IngredientRepository $ingredientRepository)
    {

        $this->ingredientRepository = $ingredientRepository;
    }
    
    #[Route('/ingredient/request', name: 'app_ingredient_request')]
    public function index(Request $request): Response
    {
        $id = $request->get('recipeId');
        $ingredient = $this->ingredientRepository->ingredienRequest($id);
        return $this->json(['ingredient' => $ingredient], Response::HTTP_CREATED);
    }
}
