<?php

namespace App\DataFixtures;

use App\Entity\Ingredient;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\String\Slugger\SluggerInterface;
use Faker;
class IngredientFixtures extends Fixture
{
    public function __construct(
        private SluggerInterface $slugger){}
    public function load(ObjectManager $manager): void
    {
        $this->createIngredient(name:'Tomate',manager:$manager);
        $this->createIngredient(name:'canard',manager:$manager);
        $this->createIngredient(name:'Oeuf',manager:$manager);
        $this->createIngredient(name:'Olive',manager:$manager);
        $this->createIngredient(name:'Fromages',manager:$manager);      
        
    }

    public function createIngredient(string $name, ObjectManager $manager){

        $faker = Faker\Factory::create('fr_FR');
        $ingredient = new Ingredient();
        $ingredient->setName($name);
        $ingredient->setSlug($this->slugger->slug($ingredient->getName())->lower());
        $ingredient->setPicture($faker->image(null,640,480)); 
        $ingredient->setAveragePrice($faker->numberBetween(1,50));
        $ingredient->setDescription($faker->text(50));



        $manager->persist($ingredient);

        $manager->flush();

        return $ingredient;
    }
}
