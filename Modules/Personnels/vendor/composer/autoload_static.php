<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit76110872645d63bf6d978e5b1897d512
{
    public static $prefixLengthsPsr4 = array (
        'D' => 
        array (
            'Dtic\\Personnels\\' => 16,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Dtic\\Personnels\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'Dtic\\Personnels\\PersonnelServiceProvider' => __DIR__ . '/../..' . '/src/PersonnelServiceProvider.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit76110872645d63bf6d978e5b1897d512::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit76110872645d63bf6d978e5b1897d512::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit76110872645d63bf6d978e5b1897d512::$classMap;

        }, null, ClassLoader::class);
    }
}