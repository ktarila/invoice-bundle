<?php

declare(strict_types=1);

/*
 * This file is part of the Symfony Invoice Bundle package.
 * Copyright (c) Patrick Kenekayoro
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ktarila\InvoiceBundle\Manager;

trait InvoiceManagerTrait
{
    private ?InvoiceManagerInterface $ticketManager;

    protected function getTicketManager(): InvoiceManagerInterface
    {
        return $this->ticketManager;
    }
}
