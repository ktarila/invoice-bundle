<?php

/*
 * This file is part of the Symfony Invoice Bundle package.
 * Copyright (c) Patrick Kenekayoro
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PatrickKenekayoro\InvoiceBundle\Controller;

use PatrickKenekayoro\InvoiceBundle\Form\InvoiceType;
use PatrickKenekayoro\InvoiceBundle\Manager\InvoiceManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class InvoiceController extends AbstractController
{
    private InvoiceManager $invoiceManager;

    public function __construct(
        InvoiceManager $invoiceManager,
    ) {
        $this->invoiceManager = $invoiceManager;
    }

    public function index(): Response
    {
        $companyName = $this->getParameter('patrick_kenekayoro_invoice.company_name');
        $templates = $this->getParameter('patrick_kenekayoro_invoice.templates');
        $invoices = $this->invoiceManager->findInvoices();

        return $this->render(
            $templates['index'],
            [
                'company_name' => $companyName,
                'invoices' => $invoices,
            ]
        );
    }

    public function new(Request $request): Response
    {
        $companyName = $this->getParameter('patrick_kenekayoro_invoice.company_name');
        $templates = $this->getParameter('patrick_kenekayoro_invoice.templates');

        $invoice = $this->invoiceManager->createInvoice();
        $form = $this->createForm(InvoiceType::class, $invoice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->invoiceManager->updateInvoice($invoice);

            return $this->redirectToRoute('pk_invoice_show', ['invoiceId' => $invoice->getId()]);
        }

        return $this->render(
            $templates['new'],
            [
                'company_name' => $companyName,
                'invoice' => $invoice,
                'form' => $form->createView(),
            ]
        );
    }

    public function update(Request $request, int $invoiceId): Response
    {
        $companyName = $this->getParameter('patrick_kenekayoro_invoice.company_name');
        $templates = $this->getParameter('patrick_kenekayoro_invoice.templates');

        $invoice = $this->invoiceManager->getInvoiceById($invoiceId);
        if (null === $invoice) {
            throw $this->createNotFoundException('Invoice not found');
        }

        $form = $this->createForm(InvoiceType::class, $invoice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->invoiceManager->updateInvoice($invoice);

            return $this->redirectToRoute('pk_invoice_show', ['invoiceId' => $invoice->getId()]);
        }

        return $this->render(
            $templates['edit'],
            [
                'company_name' => $companyName,
                'invoice' => $invoice,
                'form' => $form->createView(),
            ]
        );
    }

    public function show(int $invoiceId): Response
    {
        $companyName = $this->getParameter('patrick_kenekayoro_invoice.company_name');
        $templates = $this->getParameter('patrick_kenekayoro_invoice.templates');

        $invoice = $this->invoiceManager->getInvoiceById($invoiceId);
        if (null === $invoice) {
            throw $this->createNotFoundException('Invoice not found');
        }

        return $this->render(
            $templates['show'],
            [
                'company_name' => $companyName,
                'invoice' => $invoice,
            ]
        );
    }
}
