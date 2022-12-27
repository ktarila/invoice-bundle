<?php

namespace PatrickKenekayoro\InvoiceBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;
class Configuration implements ConfigurationInterface {
    
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('invoice_bundle');
        /** @var ArrayNodeDefinition $rootNode */
        // $rootNode = $treeBuilder->getRootNode();

        return $treeBuilder;
    }
}
