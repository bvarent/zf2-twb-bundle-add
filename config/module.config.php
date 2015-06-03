<?php

namespace Bvarent\TwbBundleAdd;

return array(
    Module::CONFIG_KEY => Options::defaults(),
    'service_manager' => array (
        'factories' => array (
            __NAMESPACE__ . '\Options' => __NAMESPACE__ . '\ServiceManager\OptionsFactory',
        )
    ),
    'view_helpers' => array (
        'factories' => array (
            'formCollection' => __NAMESPACE__ . '\ServiceManager\TwbBundleFormCollectionFactory',
        )
    ),
);
