<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Customer;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends AppFixtures
{
    private $email = [
        'test@example.pl',
        'example@example.pl',
        'simple@example.pl',
        'malpa@example.pl',
    ];
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    protected function loadData(ObjectManager $manager)
    {
        for ($i = 0; $i < 3; ++$i) {
            $email = $this->faker->randomElement($this->email);
            unset($this->email[array_search($email, $this->email)]);
            $entity = new User(
                $email
            );
            $entity->setEnabled(true);
            $entity->setPassword($this->passwordEncoder->encodePassword($entity, 'Testowe123!'));
            $manager->persist($entity);

            $customer = new Customer(
                $entity,
                $this->faker->firstName,
                $this->faker->lastName,
                $this->faker->dateTime()
            );
            $manager->persist($customer);
        }

        $manager->flush();
    }
}
