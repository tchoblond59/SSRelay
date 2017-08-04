<?php

namespace Tchoblond59\SSRelay\Commands;


use Composer\Script\Event;
use Composer\Installer\PackageEvent;

class PostInstall
{

    public static function postPackageInstall(PackageEvent $event)
    {
        \Artisan::call('migrate');
    }
}