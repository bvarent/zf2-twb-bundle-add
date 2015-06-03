<?php

namespace Bvarent\TwbBundleAdd\ServiceManager;

use Bvarent\TwbBundleAdd\Form\View\Helper\TwbBundleFormCollectionWithButtons;
use Bvarent\TwbBundleAdd\Options;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Factory to inject the ModuleOptions hard dependency
 *
 * @author bvarent <r.arents@bva-auctions.com>
 */
class TwbBundleFormCollectionFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $options = $serviceLocator->getServiceLocator()->get(Options::class);
        return new TwbBundleFormCollectionWithButtons($options);
    }
}
