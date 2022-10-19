<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit2c0da605de6610ea1272f50106981b5d
{
    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'Vuewp_general_class' => __DIR__ . '/../..' . '/classes/Vuewp_general_class.php',
        'Vuewp_scripts_class' => __DIR__ . '/../..' . '/classes/Vuewp_scripts_class.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->classMap = ComposerStaticInit2c0da605de6610ea1272f50106981b5d::$classMap;

        }, null, ClassLoader::class);
    }
}