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

        $configuration = $this->getConfiguration($configs, $container);

        $config = $this->processConfiguration($configuration, $configs);

        $helperDefinition = $container->getDefinition('symfonycasts.reset_password.helper');
        $helperDefinition->replaceArgument(2, new Reference($config['request_password_repository']));
        $helperDefinition->replaceArgument(3, $config['lifetime']);
        $helperDefinition->replaceArgument(4, $config['throttle_limit']);

        $cleanerDefinition = $container->getDefinition('symfonycasts.reset_password.cleaner');
        $cleanerDefinition->replaceArgument(0, new Reference($config['request_password_repository']));
        $cleanerDefinition->replaceArgument(1, $config['enable_garbage_collection']);
    }

    public function getAlias(): string
    {
        return 'patrickkenekayoro_invoice_bundle';
    }

    public static function bundleDirectory()
    {
        return realpath(__DIR__.'/..');
    }
}
