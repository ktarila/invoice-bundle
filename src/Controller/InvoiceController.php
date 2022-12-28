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
use Symfony\Component\Routing\Annotation\Route;

#[Route('/pk-invoice')]
final class InvoiceController extends AbstractController
{
    private InvoiceManager $invoiceManager;

    public function __construct(
        InvoiceManager $invoiceManager,
    ) {
        $this->invoiceManager = $invoiceManager;
    }

    #[Route('/', name: 'pk_invoice_index')]
    public function index(): Response
    {
        $companyName = $this->getParameter('patrick_kenekayoro_invoice.company_name');

        return $this->render(
            '@PatrickKenekayoroInvoice/invoice/index.html.twig',
            ['company_name' => $companyName]
        );
    }

    #[Route('/new', name: 'pk_invoice_new')]
    public function new(Request $request): Response
    {
        $companyName = $this->getParameter('patrick_kenekayoro_invoice.company_name');

        $invoice = $this->invoiceManager->createInvoice();
        $form = $this->createForm(InvoiceType::class, $invoice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->invoiceManager->updateInvoice($invoice);

            return $this->redirectToRoute('pk_invoice_index');
        }

        return $this->render(
            '@PatrickKenekayoroInvoice/invoice/new.html.twig',
            [
                'company_name' => $companyName,
                'invoice' => $invoice,
                'form' => $form->createView(),
            ]
        );
    }
}
