<?php

namespace PatrickKenekayoro\InvoiceBundle\Model;


interface InvoiceInterface
{
    public function getId(): ?int;

    public function getCustomer(): string;

    public function setCustomer(string $customer): self;

    public function getAmount(): int;

    public function setAmount(int $amount): self;
}