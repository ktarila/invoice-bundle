<?php


namespace PatrickKenekayoro\InvoiceBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\DependencyInjection\Loader;

/**
 * @author Jesse Rushlow <jr@rushlow.dev>
 * @author Ryan Weaver   <ryan@symfonycasts.com>
 */
final class InvoiceBundleExtension extends Extension
{
     public function load(array $configs, ContainerBuilder $container): void
    {
        $loader = new XmlFileLoader($container, new FileLocator(\dirname(__DIR__).'/Resources/config'));
        $loader->load('invoice_bundle_services.xml');

        
    }

    public function getAlias(): string
    {
        return 'pk_invoice_bundle';
    }

    public static function bundleDirectory()
    {
        return realpath(__DIR__.'/..');
    }
}
