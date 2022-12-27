<?php

namespace PatrickKenekayoro\InvoiceBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;
class Configuration implements ConfigurationInterface {
    
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('invoice_bundle');
        $treeBuilder
            ->getRootNode()
            ->children()
                ->scalarNode('ticket_class')->isRequired()->cannotBeEmpty()
            ->end();
       

        return $treeBuilder;
    }
}
