<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\DependencyInjection\ContainerInterface;


class ServiceTestCase extends WebTestCase
{
    protected ContainerInterface $containerInterface;

    protected function setUp(): void
    {
        parent::setUp();

        $this->containerInterface = static::createClient()->getContainer();
    }
}
