<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit144b881691826c9e4f9b04e106a00eda
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit144b881691826c9e4f9b04e106a00eda::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit144b881691826c9e4f9b04e106a00eda::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
