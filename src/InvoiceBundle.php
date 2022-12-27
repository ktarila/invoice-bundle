<?php
namespace PatrickKenekayoro\InvoiceBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * InvoiceBundle
 */
class InvoiceBundle extends Bundle
{

    public function getPath(): string
    {
        return \dirname(__DIR__);
    }

}