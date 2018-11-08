<?php

declare(strict_types=1);

/*
 * The MIT License (MIT)
 *
 * Copyright (c) 2016-2018 Spomky-Labs
 *
 * This software may be modified and distributed under the terms
 * of the MIT license.  See the LICENSE file for details.
 */

namespace BehatExtension\DoctrineDataFixturesExtension\Tests\DemoBundle\DataFixtures\ORM;

use BehatExtension\DoctrineDataFixturesExtension\Tests\DemoBundle\Entity\Product;
use BehatExtension\DoctrineDataFixturesExtension\Tests\DemoBundle\Entity\ProductManager;
use BehatExtension\DoctrineDataFixturesExtension\Tests\DemoBundle\Tests\DataFixtures\ProductLoader;
use BehatExtension\DoctrineDataFixturesExtension\Tests\DemoBundle\Tests\DataFixtures\ProductLoaderWithDependencyInjection;
use BehatExtension\DoctrineDataFixturesExtension\Tests\Dummy\Fixtures\DummyProductLoaderFromDirectory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class AnotherProductLoader extends Fixture implements DependentFixtureInterface
{
    private $service;

    public function __construct(ProductManager $service)
    {
        $this->service = $service;
    }

    public function load(ObjectManager $manager)
    {
        array_map(function (array $item) {
            $product = new Product(
                $item['name'],
                $item['description']
            );
            $this->service->create($product);
        }, $this->getData());
    }

    private function getData(): array
    {
        return [
            [
                'name'        => 'Product #9',
                'description' => 'This is the product number 9',
            ],
            [
                'name'        => 'Product #10',
                'description' => 'This is the product number 10',
            ],
        ];
    }

    /**
     * This method must return an array of fixtures classes
     * on which the implementing class depends on
     *
     * @return array
     */
    public function getDependencies()
    {
        return [
            ProductLoaderWithDependencyInjection::class
        ];
    }
}
