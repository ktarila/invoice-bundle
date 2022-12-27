<?php
namespace PatrickKenekayoro\InvoiceBundle;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class PatrickKenekayoroInvoiceBundle extends AbstractBundle
{

     public function loadExtension(array $config, ContainerConfigurator $container, ContainerBuilder $builder): void
    {
        // load an XML, PHP or Yaml file
        $container->import('./Resources/config/services.yaml');

    }

    public function getPath(): string
    {
        return __DIR__;
    }

}