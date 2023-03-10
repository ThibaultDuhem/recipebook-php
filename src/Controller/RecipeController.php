<?php

namespace App\Controller;

use App\Entity\Recipe;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/recipe', name: 'recipe_')]
class RecipeController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        return $this->render('recipe/index.html.twig', [
            'controller_name' => 'Recettes',
        ]);
    }

    #[Route('/{slug}', name: 'détails')]
    public function details(Recipe $recipe): Response
    {
         $ingredients = $recipe->getIngredients();
        return $this->render('recipe/details.html.twig', compact('recipe','ingredients'));
    }


}
