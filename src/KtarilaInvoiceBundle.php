<?php

/*
 * This file is part of the Symfony Invoice Bundle package.
 * Copyright (c) Patrick Kenekayoro
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ktarila\InvoiceBundle;

use Symfony\Component\Config\Definition\Configurator\DefinitionConfigurator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;

class KtarilaInvoiceBundle extends AbstractBundle
{
    public function loadExtension(array $config, ContainerConfigurator $container, ContainerBuilder $builder): void
    {
        // load an XML, PHP or Yaml file
        $container->import('./Resources/config/controller_services.php');
        $container->import('./Resources/config/manager.php');
        $container->import('./Resources/config/form.php');

        $container->parameters()
            ->set('ktarila_invoice.company_name', $config['company_name']);
        $container->parameters()->set('ktarila_invoice.model.invoice.class', $config['invoice_class']);
        $container->parameters()->set('ktarila_invoice.templates', $config['templates']);
    }

    public function configure(DefinitionConfigurator $definition): void
    {
        $definition->rootNode()
            ->children()
                ->scalarNode('company_name')->defaultValue('Acme Company')->end()
                ->scalarNode('invoice_class')->isRequired()->cannotBeEmpty()->end()
                ->arrayNode('templates')
                    ->addDefaultsIfNotSet()
                    ->canBeUnset()
                    ->children()
                        ->scalarNode('index')->defaultValue('@KtarilaInvoice/bootstrap5/invoice/index.html.twig')->end()
                        ->scalarNode('new')->defaultValue('@KtarilaInvoice/bootstrap5/invoice/new.html.twig')->end()
                        ->scalarNode('edit')->defaultValue('@KtarilaInvoice/bootstrap5/invoice/edit.html.twig')->end()
                        ->scalarNode('show')->defaultValue('@KtarilaInvoice/bootstrap5/invoice/show.html.twig')->end()
                    ->end()
            ->end()
        ;
    }

    public function getPath(): string
    {
        return __DIR__;
    }

    public function getAlias(): string
    {
        return 'ktarila_invoice';
    }
}
