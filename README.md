TwbBundle additions
===================

Additions to [TwbBundle v2 for ZF2](https://github.com/neilime/zf2-twb-bundle).

Installation
------------
* Require this package `bvarent/zf2-twb-bundle-add` using composer.
* Add the Module `Bvarent\TwbBundleAdd` to the list of loaded modules in your 
  application config. After `TwbBundle`.
* Make sure the assets are available via www under the configured path. Usually
  this means copying `assets/*` to your `public` dir.
* If you want to override configuration, copy and mod
  `config/bvarent-twbbundle.local.php.dist` to your autoload dir.

Features
--------
* The `formCollection` view helper now also renders buttons to dynamically add/
  remove elements in the collection.

TODO
----
* Tests.
* Include configuration for Assetic and/or other asset managers.