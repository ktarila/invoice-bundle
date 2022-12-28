<?php

declare(strict_types=1);

/*
 * This file is part of the Symfony Invoice Bundle package.
 * Copyright (c) Patrick Kenekayoro
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PatrickKenekayoro\InvoiceBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class InvoiceType extends AbstractType
{
    protected $invoiceClass;

    public function __construct(string $invoiceClass)
    {
        $this->invoiceClass = $invoiceClass;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('customer', TextType::class, [
                'label' => 'label.customer', ],
            )
            ->add('amount', NumberType::class, [
                'label' => 'label.amount', ],
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => $this->invoiceClass,
                'translation_domain' => 'PatrickKenekayoroInvoiceBundle',
            ]
        );
    }

    public function getBlockPrefix(): string
    {
        return 'invoice';
    }
}
