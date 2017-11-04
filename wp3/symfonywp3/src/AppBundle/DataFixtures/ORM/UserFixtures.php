<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\User;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Symfony\Component\DependencyInjection\ContainerInterface;


class UserFixtures implements FixtureInterface, ContainerAwareInterface
{

    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager): void
    {
        $passwordEncoder = $this->container->get('security.password_encoder');

        $user = new User();
        $user->setUsername('user1');
        $encodedPassword = $passwordEncoder->encodePassword($user, 'u1');
        $user->setPassword($encodedPassword);
        $user->setRolesString("ROLE_USER");
        $manager->persist($user);

        $admin = new User();
        $admin->setUsername('admin1');
        $encodedPassword = $passwordEncoder->encodePassword($admin, 'a1');
        $admin->setPassword($encodedPassword);
        $admin->setRolesString("ROLE_ADMIN ROLE_USER");
        $manager->persist($admin);

        $manager->flush();
    }

    /**
     * Sets the container.
     *
     * @param ContainerInterface|null $container A ContainerInterface instance or null
     */
    public function setContainer(ContainerInterface $container = null)
    {
       $this->container = $container;
    }
}
