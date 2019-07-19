<?php

namespace App\DataFixtures\ORM;

use App\Entity\User\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Class UserFixtures
 */
final class UserFixtures extends Fixture
{
    private const PASSWORD = 'pass';

    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordHashing;

    /**
     * UserFixtures constructor.
     *
     * @param UserPasswordEncoderInterface $passwordHashing
     */
    public function __construct(UserPasswordEncoderInterface $passwordHashing)
    {
        $this->passwordHashing = $passwordHashing;
    }

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        // user
        $user = new User();
        $user->setEmail('test@test.dev');
        $user->setName('Danas');
        $user->setUsername('admin');
        $user->setPassword(
            $this->passwordHashing->encodePassword(
                $user,
                self::PASSWORD
            )
        );

        $manager->persist($user);
        $manager->flush();
    }

}
