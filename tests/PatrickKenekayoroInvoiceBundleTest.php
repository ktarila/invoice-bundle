<?php
// tests/PatrickKenekayoroInvoiceBundleTest.php


namespace PatrickKenekayoro\InvoiceBundle\Tests;


use PatrickKenekayoro\InvoiceBundle\PatrickKenekayoroInvoiceBundle;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\Extension\Extension;

class PatrickKenekayoroInvoiceBundleTest extends TestCase
{
    public function testGetContainerExtension(): void
    {
        $bundle = new PatrickKenekayoroInvoiceBundle();
        $this->assertInstanceOf(Extension::class, $bundle->getContainerExtension());
    }
}