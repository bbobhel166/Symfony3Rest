<?php
/**
 * Created by PhpStorm.
 * User: helvasb
 * Date: 28/01/2017
 * Time: 10:56
 */

namespace Wunderman\Eprevention\DataFixtures\ORM;

use Wunderman\EpreventionBundle\Entity\Metier;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Nelmio\Alice\Fixtures;
use Wunderman\EpreventionBundle\Service\LoadEzDatas;

class LoadFixtures implements FixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        $objects = Fixtures::load(
            __DIR__ . '/fixtures.yml',
            $manager,
            [
                'providers' => [$this]
            ]
        );
    }
}