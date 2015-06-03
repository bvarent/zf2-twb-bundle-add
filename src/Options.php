<?php

namespace Bvarent\TwbBundleAdd;

use Zend\Stdlib\AbstractOptions;

/**
 * Config options for the Bvarent\TwbBundleAdd module.
 * 
 * @property string $assets_path Path (as in: URL part) to where the assets of this module can be found. E.g. '/public'.
 * 
 * @author bvarent <r.arents@bva-auctions.com>
 */
class Options extends AbstractOptions
{

    /**
     * @return array Default values for all options.
     */
    public static function defaults()
    {
        return [
            'assets_path' => '/',
        ];
    }

    protected $assetsPath;

    protected function getAssetsPath()
    {
        return $this->assetsPath;
    }

    protected function setAssetsPath($val)
    {
        $this->assetsPath = (string) $val;
    }

}
