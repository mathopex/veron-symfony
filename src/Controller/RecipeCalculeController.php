<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\CalculService;

class RecipeCalculeController extends AbstractController
{
    public function __construct(CalculService $calculService){
        $this->calculService = $calculService;
    }
    #[Route('/recipe/calcule', name: 'app_recipe_calcule')]
    public function index(Request $request):JsonResponse
    {
        // $value = [[
        //     'poidMp' => [400, 580, 920, 280, 70, 200],
        //     'prixMp' => [0.8,0.87,4.6,1.96,0.32,0.4], 
        //     'deglaçageMp'=>[true,false,false,false,false,false],
        //     'userId'=> 1,
        //     'tempRange' => '12/20°C'
        //     ]];
        // $ids = [510,455,189,448,190,313];
        $data = json_decode($request->getContent(), true);
        $value = $data['value'];
        $ids = $data['ids'];
        $respDate = $this->calculService->calculRecette($ids,$value);
        return new JsonResponse($respDate);
    }
}