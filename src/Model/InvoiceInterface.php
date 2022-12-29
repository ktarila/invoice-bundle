<?php

/*
 * This file is part of the Symfony Invoice Bundle package.
 * Copyright (c) Patrick Kenekayoro
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PatrickKenekayoro\InvoiceBundle\Model;

interface InvoiceInterface
{
    public function getId(): ?int;

    public function getCustomer(): string;

    public function setCustomer(string $customer): self;

    public function getAmount(): float;

    public function setAmount(float $amount): self;

    public function getItems(): array;

    public function setItems(array $items): self;
}
