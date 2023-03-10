<?php

namespace App\DataFixtures;

use App\Entity\Recipe;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\String\Slugger\SluggerInterface;
use Faker;

class RecipeFixtures extends Fixture
{
    public function __construct(private SluggerInterface $slugger){}
    public function load(ObjectManager $manager): void
    {
        $this->createRecipe(name:'Lasagne',manager:$manager);
        $this->createRecipe(name:'Parmentier de canard',manager:$manager);
        $this->createRecipe(name:'Crêpes',manager:$manager);
        $this->createRecipe(name:'Cake aux olives',manager:$manager);
        $this->createRecipe(name:'Pizza 4 fromages',manager:$manager);

        
        
        
    }

    public function createRecipe(string $name, ObjectManager $manager){

        $faker = Faker\Factory::create('fr_FR');
        $recipe = new Recipe();
        $recipe->setName($name);
        $recipe->setSlug($this->slugger->slug($recipe->getName())->lower());
        $recipe->setType($faker->word); 
        $recipe->setRating($faker->numberBetween(0,5)); 
        $recipe->setPreparationTime($faker->numberBetween(3,180)); 
        $recipe->setCookingTime($faker->numberBetween(0,180)); 
        $recipe->setDifficulty($faker->numberBetween(0,10)); 
        $recipe->setPicture($faker->image(null,640,480)); 
        $recipe->setComment($faker->text(110));
        $recipe->setSteps($faker->numberBetween(2,30));  




        $manager->persist($recipe);

        $manager->flush();

        return $recipe;
    }
}
