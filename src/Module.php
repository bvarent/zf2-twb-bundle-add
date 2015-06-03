<?php

namespace Bvarent\TwbBundleAdd;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\DependencyIndicatorInterface;

class Module implements
AutoloaderProviderInterface, ConfigProviderInterface, DependencyIndicatorInterface
{
    
    /**
     * A human readable name for this module.
     */
    const MODULE_NAME = 'Bvarent TwbBundle additions';
    
    /**
     * The key to use in the global ZF2 config to identify this module.
     */
    const CONFIG_KEY = 'bvarent-twbbundle';

    /**
     * Gives the path to the root directory of this module.
     * @return string
     */
    protected function getModulePath()
    {
        // Assume this file is in {module root path}/src.
        return dirname(__DIR__);
    }

    public function getAutoloaderConfig()
    {
        // This is a backup in case composer's autoloader is not in use or does
        //  not know about this module.
        // Assert that the current class is __NAMESPACE__\Module living in __DIR__.
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__,
                ),
            ),
        );
    }

    public function getConfig()
    {
        $modulePath = $this->getModulePath();

        return include $modulePath . '/config/module.config.php';
    }

    public function getModuleDependencies()
    {
        return array(
            'TwbBundle',
        );
    }

}
