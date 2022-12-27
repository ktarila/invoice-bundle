<?php

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
        return $this->render(
            '@InvoiceBundle/invoice/index.html.twig',
            array('msg' => 'Hello world')
        );
    }
}
