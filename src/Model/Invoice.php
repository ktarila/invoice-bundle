<?php

/*
 * This file is part of the FOSUserBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PatrickKenekayoro\InvoiceBundle\Model;


abstract class Invoice
{

    protected ?int $id;

    protected string $customer;

    protected int $amount = 0;


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

    public function getAmount(): int
    {
        return $this->customer;
    }

    
    public function setAmount(int $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

   
}