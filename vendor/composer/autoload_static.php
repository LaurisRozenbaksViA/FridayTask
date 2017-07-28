<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit2afbf8464795489dcba930bc71c25757
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Symfony\\Component\\Routing\\' => 26,
            'Solbianca\\VarDumper\\' => 20,
        ),
        'P' => 
        array (
            'PHPBootcamp\\' => 12,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Symfony\\Component\\Routing\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/routing',
        ),
        'Solbianca\\VarDumper\\' => 
        array (
            0 => __DIR__ . '/..' . '/solbianca/vardumper',
        ),
        'PHPBootcamp\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit2afbf8464795489dcba930bc71c25757::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit2afbf8464795489dcba930bc71c25757::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
