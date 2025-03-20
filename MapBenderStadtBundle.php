<?php
namespace DanielKnoop\StadtBundle;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\Config\Resource\FileResource;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class DanielKnoopStadtBundle extends Bundle
{
    public function build(ContainerBuilder $container): void
    {
        $configLocator = new FileLocator(__DIR__ . '/Resources/config');
        $loader = new XmlFileLoader($container, $configLocator);
        $loader->load('templates.xml');
        $container->addResource(new FileResource($configLocator->locate('templates.xml')));
    }
}
