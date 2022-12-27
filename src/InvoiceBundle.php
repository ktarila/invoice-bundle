<?php
namespace PatrickKenekayoro\InvoiceBundle;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;


class InvoiceBundle extends AbstractBundle
{

     public function loadExtension(array $config, ContainerConfigurator $container, ContainerBuilder $builder): void
    {
        // load an XML, PHP or Yaml file
        $container->import('./Resources/config/controller_services.php');
        $container->import('./Resources/config/routing.yml');

        
    }

    public function getPath(): string
    {
        return \dirname(__DIR__);
    }

}