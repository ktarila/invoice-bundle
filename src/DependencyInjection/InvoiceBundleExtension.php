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
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\PhpFileLoader($container, new FileLocator(self::bundleDirectory().'/Resources/config'));

        $loader->load('manager.php');

        $container->setParameter('patrickkenekayoro_invoice.model.invoice.class', $config['ticket_class']);

        // $configuration = $this->getConfiguration($configs, $container);

        // $config = $this->processConfiguration($configuration, $configs);

        
    }

    public function getAlias(): string
    {
        return 'invoice_bundle';
    }

    public static function bundleDirectory()
    {
        return realpath(__DIR__.'/..');
    }
}
