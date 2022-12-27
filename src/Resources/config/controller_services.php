<?php

declare(strict_types=1);


use PatrickKenekayoro\InvoiceBundle\Controller\InvoiceController;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\DependencyInjection\Loader\Configurator\ReferenceConfigurator;

return static function (ContainerConfigurator $container): void {
    

    $container->services()
        ->set(InvoiceController::class)
            ->args([
                new ReferenceConfigurator('event_dispatcher'),
                new ReferenceConfigurator('parameter_bag'),
            ])
            ->call('setContainer', [new ReferenceConfigurator('service_container')])
            ->tag('controller.service_arguments')
            ->alias('patrickkenekayoro_invoice.controller.invoice_controller', InvoiceController::class)
            ->public()
    ;
};