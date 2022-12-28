<?php

/*
 * This file is part of the Symfony Invoice Bundle package.
 * Copyright (c) Patrick Kenekayoro
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PatrickKenekayoro\InvoiceBundle;

use Symfony\Component\Config\Definition\Configurator\DefinitionConfigurator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;

class PatrickKenekayoroInvoiceBundle extends AbstractBundle
{
    public function loadExtension(array $config, ContainerConfigurator $container, ContainerBuilder $builder): void
    {
        // load an XML, PHP or Yaml file
        $container->import('./Resources/config/services.yaml');
    }

    public function prependExtension(ContainerConfigurator $container, ContainerBuilder $builder): void
    {
        // get all bundles
        $bundles = $builder->getParameter('kernel.bundles');
        // determine if AcmeGoodbyeBundle is registered
        if (!isset($bundles['PatrickKenekayoroInvoiceBundle'])) {
            // disable AcmeGoodbyeBundle in bundles
            $config = ['patrick_kenekayoro_invoice' => false];
            foreach ($container->getExtensions() as $name => $extension) {
                match ($name) {
                    // set use_acme_goodbye to false in the config of
                    // acme_something and acme_other
                //
                    // note that if the user manually configured
                    // use_acme_goodbye to true in config/services.yaml
                    // then the setting would in the end be true and not false
                    'acme_something', 'acme_other' => $container->prependExtensionConfig($name, $config),
                    default => null
                };
            }
        }

        // $container->import('./Resources/config/packages/patrick_kenekayoro_invoice.yaml');

        // get the configuration of AcmeHelloExtension (it's a list of configuration)
        $configs = $builder->getExtensionConfig($this->getAlias());

        // iterate in reverse to preserve the original order after prepending the config
        foreach (array_reverse($configs) as $config) {
            // check if entity_manager_name is set in the "acme_hello" configuration
            if (isset($config[$this->getAlias()])) {
                // prepend the acme_something settings with the entity_manager_name
                $builder->prependExtensionConfig($this->getAlias(), [
                'company_name' => $config['company_name'],
            ]);
            }
        }
    }

    public function configure(DefinitionConfigurator $definition): void
    {
        $definition->rootNode()
            ->children()
                ->scalarNode('company_name')->defaultValue('Acme Company')->end()
            ->end()
        ;
    }

    public function getPath(): string
    {
        return __DIR__;
    }

    public function getAlias(): string
    {
        return 'patrick_kenekayoro_invoice';
    }
}
