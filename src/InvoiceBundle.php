<?php
namespace PatrickKenekayoro\InvoiceBundle;

use Symfony\Component\HttpKernel\Bundle\AbstractBundle;


class InvoiceBundle extends AbstractBundle
{

    public function getPath(): string
    {
        return \dirname(__DIR__);
    }

}