<?php

/*
 * This file is part of the Symfony Invoice Bundle package.
 * Copyright (c) Patrick Kenekayoro
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PatrickKenekayoro\InvoiceBundle\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

trait InvoiceTrait
{
    #[ORM\Column(type: Types::STRING, length: 180)]
    protected string $customer;

    #[ORM\Column(type: Types::FLOAT, nullable: true)]
    protected float $amount = 0;

    #[ORM\Column(type: Types::JSON, nullable: true)]
    private ?array $items = [];

    /**
     * @return string
     */
    public function __toString()
    {
        return (string) $this->getCustomer();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCustomer(): string
    {
        return $this->customer;
    }

    public function setCustomer(string $customer): self
    {
        $this->customer = $customer;

        return $this;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function setAmount(float $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getItems(): array
    {
        if (null === $this->items) {
            return [];
        }

        return $this->items;
    }

    public function setItems(?array $items): self
    {
        $this->items = $items;

        return $this;
    }

    public function addItem(array $item): self
    {
        $items = $this->items;
        if (isset($item['item']) && isset($item['itemAmount'])) {
            $items[] = ['item' => $item['item'], 'itemAmount' => $item['itemAmount']];
            $this->items = $items;
        }

        return $this;
    }

    public function removeItem(array $item): self
    {
        $collection = new ArrayCollection($this->items);
        $collection->removeElement($item);
        $this->items = $collection->toArray();

        return $this;
    }
}
