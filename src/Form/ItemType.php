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

final class ItemType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('item', TextType::class, [
            // 'label' => ['label.item'],
        ])
        ->add('itemAmount', NumberType::class, [
            // 'label' => ['label.item_amount'],
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'translation_domain' => 'PatrickKenekayoroInvoiceBundle',
        ]);
    }
}
