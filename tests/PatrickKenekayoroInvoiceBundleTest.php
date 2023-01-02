<?php

/*
 * This file is part of the Symfony Invoice Bundle package.
 * Copyright (c) Patrick Kenekayoro
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ktarila\InvoiceBundle\Tests;

use Ktarila\InvoiceBundle\KtarilaInvoiceBundle;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\Extension\Extension;

class KtarilaInvoiceBundleTest extends TestCase
{
    public function testGetContainerExtension(): void
    {
        $bundle = new KtarilaInvoiceBundle();
        $this->assertInstanceOf(Extension::class, $bundle->getContainerExtension());
    }
}
