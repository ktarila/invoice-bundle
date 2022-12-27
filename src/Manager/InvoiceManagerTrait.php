<?php

namespace PatrickKenekayoro\InvoiceBundle\Manager;

trait InvoiceManagerTrait
{
    private ?InvoiceManagerInterface $InvoiceManager;

    protected function getInvoiceManager(): InvoiceManagerInterface
    {
        return $this->InvoiceManager;
    }
}