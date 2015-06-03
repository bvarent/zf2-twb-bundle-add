<?php

namespace Bvarent\TwbBundleAdd\ServiceManager;

use Bvarent\TwbBundleAdd\Module;
use Bvarent\TwbBundleAdd\Options;
use Zend\Config\Config;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Creates an Options instance from the ZF2 Config.
 *
 * @author bvarent <r.arents@bva-auctions.com>
 */
class OptionsFactory implements FactoryInterface
{

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        // Read the module configuration from the overall config into an options
        //  object.
        $totalConfig = $serviceLocator->get('config');
        /* @var $config Config */
        $options = new Options($totalConfig[Module::CONFIG_KEY]);

        return $options;
    }

}
