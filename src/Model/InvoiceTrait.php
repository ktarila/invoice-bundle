<?php

namespace PatrickKenekayoro\InvoiceBundle\Model;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;


trait InvoiceTrait
{

    #[ORM\Column(type: Types::STRING, length: 180)]
    protected string $customer;

    #[ORM\Column(type: Types::INTEGER, nullable: true)]
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