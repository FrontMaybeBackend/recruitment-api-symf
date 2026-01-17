<?php

namespace App\DataFixtures;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AdminFixtures extends Fixture
{
    public function __construct(
        private readonly UserPasswordHasherInterface $passwordHasher
    ) {}
    public function load(ObjectManager $manager): void
    {
        $adminUser = new User();
        $adminUser->setEmail('admin@admin.com');

        $hashedPassword = $this->passwordHasher->hashPassword(
            $adminUser,
            'admin'
        );
        $adminUser->setPassword($hashedPassword);

        $adminUser->setRoles(['ROLE_ADMIN']);

        $manager->persist($adminUser);
        $manager->flush();
    }
}
