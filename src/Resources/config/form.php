<?php

declare(strict_types=1);

/*
 * This file is part of the Symfony Invoice Bundle package.
 * Copyright (c) Patrick Kenekayoro
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use PatrickKenekayoro\InvoiceBundle\Form\InvoiceType;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $containerConfigurator->services()
        ->set(InvoiceType::class, InvoiceType::class)
            ->tag('form.type', [
                'alias' => 'patrickkenekayoro_invoice',
            ])
            ->args([
                '%patrick_kenekayoro_invoice.model.invoice.class%',
            ])
    ;
};
