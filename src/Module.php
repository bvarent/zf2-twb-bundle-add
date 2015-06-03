<?php

namespace Bvarent\TwbBundleAdd;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\DependencyIndicatorInterface;
use Zend\ModuleManager\Feature\InitProviderInterface;
use Zend\ModuleManager\ModuleEvent;
use Zend\ModuleManager\ModuleManagerInterface;

class Module implements
AutoloaderProviderInterface, ConfigProviderInterface, DependencyIndicatorInterface, InitProviderInterface
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

    public function init(ModuleManagerInterface $manager)
    {
        // Attach to the 'merge config' event.
        $manager->getEventManager()->attach(ModuleEvent::EVENT_MERGE_CONFIG, array($this, 'onMergeConfig'));
    }

    public function onMergeConfig(ModuleEvent $e)
    {
        $configListener = $e->getConfigListener();
        $config = $configListener->getMergedConfig(false);

        // Unset the invokable formCollection view helper from TwbBundle.
        unset($config['view_helpers']['invokables']['formCollection']);

        // Pass the changed configuration back to the listener:
        $configListener->setMergedConfig($config);
    }

}
