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

    public function getTotalAmount(): float;

    public function getItems(): array;

    public function setItems(array $items): self;

    public function addItem(array $item): self;

    public function removeItem(array $item): self;

    public function getInvoiceDate(): ?\DateTimeImmutable;

    public function setInvoiceDate(?\DateTimeImmutable $invoiceDate): self;
}
