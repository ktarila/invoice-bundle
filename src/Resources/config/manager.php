<?php

declare(strict_types=1);


use Doctrine\ORM\EntityRepository;
use PatrickKenekayoro\InvoiceBundle\Manager\InvoiceManager;
use PatrickKenekayoro\InvoiceBundle\Manager\InvoiceManagerInterface;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\DependencyInjection\Loader\Configurator\ReferenceConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    // Use "service" function for creating references to services when dropping support for Symfony 4.4
    // Use "param" function for creating references to parameters when dropping support for Symfony 5.1
    $containerConfigurator->services()
        
        ->set(InvoiceManager::class)
            ->public()
            ->args([
                '%patrickkenekayoro_invoice.model.ticket.class%',
            ])
            ->call('setObjectManager', [
                new ReferenceConfigurator('doctrine.orm.entity_manager'),
            ])
            ->call('setLogger', [
                new ReferenceConfigurator('logger'),
            ])

        ->alias(InvoiceManagerInterface::class, InvoiceManager::class)
            ->public()
    ;
};