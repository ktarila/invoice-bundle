<?php

/*
 * This file is part of the Symfony Invoice Bundle package.
 * Copyright (c) Patrick Kenekayoro
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ktarila\InvoiceBundle\Persistence\Repository;

use Ktarila\InvoiceBundle\Model\InvoiceInterface;

trait InvoiceRepositoryTrait
{
    public function persistInvoice(InvoiceInterface $invoice): void
    {
        $this->getEntityManager()->persist($invoice);
        $this->getEntityManager()->flush();
    }

    public function findResetPasswordRequest(string $selector): ?InvoiceInterface
    {
        return $this->findOneBy(['selector' => $selector]);
    }
}
