<?php
namespace App\Subscriber;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use App\Entity\Category;
use App\Entity\RecipeCategory;

class CategoryDeletionSubscriber implements EventSubscriber
{
    public function getSubscribedEvents()
    {
        return [
            Events::preRemove,
        ];
    }

    public function preRemove(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();

        if (!$entity instanceof Category) {
            return;
        }

        $entityManager = $args->getObjectManager();
        $recipeCategories = $entityManager->getRepository(RecipeCategory::class)->findBy(['category' => $entity]);

        foreach ($recipeCategories as $recipeCategory) {
            // Définir RecipeCategory sur null pour chaque Recipe associé
            $recipe = $recipeCategory->getRecipe();
            if ($recipe) {
                $recipe->setRecipeCategory(null);
                $entityManager->persist($recipe);
            }
            // Supprimer l'entité RecipeCategory
            $entityManager->remove($recipeCategory);
        }
    }
}
