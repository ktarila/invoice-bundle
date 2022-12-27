<?php

/*
 * This file is part of the SymfonyCasts ResetPasswordBundle package.
 * Copyright (c) SymfonyCasts <https://symfonycasts.com/>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PatrickKenekayoro\InvoiceBundle\Persistence\Repository;

use PatrickKenekayoro\InvoiceBundle\Model\InvoiceInterface;

/**
 * Trait can be added to a Doctrine ORM repository to help implement
 * InvoiceRepositoryInterface.
 *
 * @author Jesse Rushlow <jr@rushlow.dev>
 * @author Ryan Weaver   <ryan@symfonycasts.com>
 */
trait InvoiceRepositoryRepositoryTrait
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