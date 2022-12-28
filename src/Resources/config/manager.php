<?php

declare(strict_types=1);

/*
 * This file is part of the Symfony Invoice Bundle package.
 * Copyright (c) Patrick Kenekayoro
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use PatrickKenekayoro\InvoiceBundle\Manager\TicketManager;
use PatrickKenekayoro\InvoiceBundle\Manager\TicketManagerInterface;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\DependencyInjection\Loader\Configurator\ReferenceConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    // Use "service" function for creating references to services when dropping support for Symfony 4.4
    // Use "param" function for creating references to parameters when dropping support for Symfony 5.1
    $containerConfigurator->services()
        ->set(TicketManager::class)
            ->public()
            ->args([
                '%patrickkenekayoro_invoice.model.invoice.class%',
            ])
            ->call('setObjectManager', [
                new ReferenceConfigurator('doctrine.orm.entity_manager'),
            ])
            ->call('setTranslator', [
                new ReferenceConfigurator('translator'),
            ])
            ->call('setLogger', [
                new ReferenceConfigurator('logger'),
            ])

        ->alias(TicketManagerInterface::class, TicketManager::class)
            ->public()
    ;
};
