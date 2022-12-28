<?php

declare(strict_types=1);

/*
 * This file is part of the Symfony Invoice Bundle package.
 * Copyright (c) Patrick Kenekayoro
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PatrickKenekayoro\InvoiceBundle\Manager;

use PatrickKenekayoro\InvoiceBundle\Model\InvoiceInterface;

interface InvoiceManagerInterface
{
    public function createInvoice();

    public function updateInvoice(InvoiceInterface $invoice): void;

    public function deleteInvoice(InvoiceInterface $invoice);

    public function getInvoiceById($invoiceId): ?InvoiceInterface;

    public function findInvoices();

    public function findInvoicesBy(array $criteria);
}
