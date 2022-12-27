<?php
namespace PatrickKenekayoro\InvoiceBundle;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;

class PatrickKenekayoroInvoiceBundle extends AbstractBundle
{

     public function loadExtension(array $config, ContainerConfigurator $container, ContainerBuilder $builder): void
    {
        // load an XML, PHP or Yaml file
        // $container->import('./Resources/config/controller_services.php');
        $container->import('./Resources/config/services.yaml');
        dump($this->getName());
        // $container->import('./Resources/config/routes.yml');

        
    }

    public function getPath(): string
    {
        return __DIR__;
    }

    

    // public function getName(): string
    // {
    //     return "PatrickKenekayoroInvoiceBundle";
    // }

}