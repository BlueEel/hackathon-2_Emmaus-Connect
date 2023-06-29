<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    public function __construct(private UserPasswordHasherInterface $userPasswordHasher)
    {
    }

    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setFirstname('Titouan')
            ->setLastname('TITOU')
            ->setEmail('test@test.com')
            ->setPassword($this->userPasswordHasher->hashPassword($user, 'titou'))
            ->setRoles(['ROLE_USER']);
        $manager->persist($user);

        $admin = new User();
        $admin->setFirstname('Joss')
            ->setLastname('JOSSOU')
            ->setEmail('admintest@test.com')
            ->setPassword($this->userPasswordHasher->hashPassword($admin, 'jossou'))
            ->setRoles(['ROLE_ADMIN']);
        $manager->persist($admin);

        $manager->flush();
    }
}
