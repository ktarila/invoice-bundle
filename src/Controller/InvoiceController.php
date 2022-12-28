<?php

/*
 * This file is part of the Symfony Invoice Bundle package.
 * Copyright (c) Patrick Kenekayoro
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PatrickKenekayoro\InvoiceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/pk-invoice')]
final class InvoiceController extends AbstractController
{
    #[Route('/', name: 'pk_invoice_index')]
    public function index(): Response
    {
        $companyName = $this->getParameter('patrick_kenekayoro_invoice.company_name');

        return $this->render(
            '@PatrickKenekayoroInvoice/invoice/index.html.twig',
            ['company_name' => $companyName]
        );
    }
}
