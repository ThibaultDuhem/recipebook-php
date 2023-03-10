<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\String\Slugger\SluggerInterface;
use Faker;

class UserFixtures extends Fixture
{
    public function __construct(
        private UserPasswordHasherInterface $passwordEncoder, 
        private SluggerInterface $slugger){}
    public function load(ObjectManager $manager): void
    {
 
        $admin = new User();
        $admin->setEmail('admin@admin.com');
        $admin->setPseudo('Administrateur');
        $admin->setfirstName('Thibault');
        $admin->setLastname('Duhem');
        $admin->setBirth(new \DateTime('1998-01-17'));
        $admin->setPassword($this->passwordEncoder->hashPassword($admin, 'admin'));
        $admin->setRoles(['ROLE_ADMIN']);
        $manager->persist($admin);



        $faker = Faker\Factory::create('fr_FR');
        for ($usr=1; $usr<=5 ; $usr++){
            $user = new User();
            $user->setEmail($faker->email);
            $user->setPseudo($faker->city);
            $user->setfirstName($faker->firstName);
            $user->setLastname($faker->lastName);
            $user->setBirth(new \DateTime($faker->date));
            $user->setPassword($this->passwordEncoder->hashPassword($admin, 'secret'));
            $manager->persist($admin);
        }


        $manager->flush();
    }
}
