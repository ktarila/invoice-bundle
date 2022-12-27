<?php

namespace PatrickKenekayoro\InvoiceBundle\Manager;

use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ObjectManager;
use Hackzilla\Bundle\TicketBundle\Model\InvoiceInterface;
use Hackzilla\Bundle\TicketBundle\Model\InvoiceMessageInterface;
use Psr\Log\LoggerInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class InvoiceManager implements InvoiceManagerInterface
{


    private $invoiceClass;

     private $objectManager;

    private $invoiceRepository;


    /**
     * InvoiceManager constructor.
     */
    public function __construct(string $invoiceClass)
    {
        $this->invoiceClass = $invoiceClass;
    }

    public function setLogger(LoggerInterface $logger): self
    {
        if (!class_exists($this->invoiceClass)) {
            $logger->error(sprintf('Invoice entity %s doesn\'t exist', $this->invoiceClass));
        }
        if (!class_exists($this->invoiceMessageClass)) {
            $logger->error(sprintf('Message entity %s doesn\'t exist', $this->invoiceMessageClass));
        }

        return $this;
    }

    


    /**
     * Create a new instance of Invoice entity.
     *
     * @return invoiceInterface
     */
    public function createInvoice()
    {
        /* @var InvoiceInterface $Invoice */
        $invoice = new $this->InvoiceClass();

        return $invoice;
    }

    public function setObjectManager(ObjectManager $objectManager): self
    {
        $this->objectManager = $objectManager;

        if ($this->invoiceClass) {
            $this->invoiceRepository = $objectManager->getRepository($this->invoiceClass);
        }

        if ($this->invoiceMessageClass) {
            $this->messageRepository = $objectManager->getRepository($this->invoiceMessageClass);
        }

        return $this;
    }



}