<?php

declare(strict_types=1);

/*
 * This file is part of the Symfony Invoice Bundle package.
 * Copyright (c) Patrick Kenekayoro
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ktarila\InvoiceBundle\Manager;

use Doctrine\Persistence\ObjectManager;
use Ktarila\InvoiceBundle\Model\InvoiceInterface;
use Psr\Log\LoggerInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

final class InvoiceManager implements InvoiceManagerInterface
{
    private $translator;

    private $translationDomain = 'KtarilaInvoiceBundle';

    private $objectManager;

    private $invoiceRepository;

    private $invoiceClass;

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

        return $this;
    }

    public function setObjectManager(ObjectManager $objectManager): self
    {
        $this->objectManager = $objectManager;

        if ($this->invoiceClass) {
            $this->invoiceRepository = $objectManager->getRepository($this->invoiceClass);
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function setTranslator(TranslatorInterface $translator): self
    {
        $this->translator = $translator;

        return $this;
    }

    /**
     * Create a new instance of Invoice entity.
     *
     * @return InvoiceInterface
     */
    public function createInvoice()
    {
        /* @var InvoiceInterface $invoice */
        $invoice = new $this->invoiceClass();

        return $invoice;
    }

    /**
     * {@inheritdoc}
     */
    public function updateInvoice(InvoiceInterface $invoice): void
    {
        if (null === $invoice->getId()) {
            $this->objectManager->persist($invoice);
        }

        $this->objectManager->flush();
    }

    /**
     * Delete a invoice from the database.
     */
    public function deleteInvoice(InvoiceInterface $invoice)
    {
        $this->objectManager->remove($invoice);
        $this->objectManager->flush();
    }

    /**
     * Find all invoices in the database.
     *
     * @return InvoiceInterface[]
     */
    public function findInvoices()
    {
        return $this->invoiceRepository->findAll();
    }

    /**
     * Find invoice in the database.
     *
     * @param int $invoiceId
     *
     * @return ?InvoiceInterface
     */
    public function getInvoiceById($invoiceId): ?InvoiceInterface
    {
        return $this->invoiceRepository->find($invoiceId);
    }

    /**
     * Find invoice by criteria.
     *
     * @return array|InvoiceInterface[]
     */
    public function findInvoicesBy(array $criteria)
    {
        return $this->invoiceRepository->findBy($criteria);
    }
}
