<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInited0b810d2335ff32efaa9eba9b865f86
{
    public static $prefixesPsr0 = array (
        'P' => 
        array (
            'Phroute' => 
            array (
                0 => __DIR__ . '/..' . '/phroute/phroute/src',
            ),
        ),
    );

    public static $classMap = array (
        'App\\Controllers\\DocumentsController' => __DIR__ . '/../..' . '/app/controllers/DocumentsController.php',
        'App\\Controllers\\FilesController' => __DIR__ . '/../..' . '/app/controllers/FilesController.php',
        'App\\Core\\App' => __DIR__ . '/../..' . '/core/App.php',
        'App\\Core\\Request' => __DIR__ . '/../..' . '/core/Request.php',
        'ComposerAutoloaderInited0b810d2335ff32efaa9eba9b865f86' => __DIR__ . '/..' . '/composer/autoload_real.php',
        'Composer\\Autoload\\ClassLoader' => __DIR__ . '/..' . '/composer/ClassLoader.php',
        'Composer\\Autoload\\ComposerStaticInited0b810d2335ff32efaa9eba9b865f86' => __DIR__ . '/..' . '/composer/autoload_static.php',
        'Connection' => __DIR__ . '/../..' . '/core/database/Connection.php',
        'PagesController' => __DIR__ . '/../..' . '/app/controllers/PagesController.php',
        'Phroute\\Dispatcher' => __DIR__ . '/..' . '/phroute/phroute/src/Phroute/Dispatcher.php',
        'Phroute\\Dispatcher\\DispatcherTest' => __DIR__ . '/..' . '/phroute/phroute/test/Dispatcher/DispatcherTest.php',
        'Phroute\\Dispatcher\\Test' => __DIR__ . '/..' . '/phroute/phroute/test/Dispatcher/DispatcherTest.php',
        'Phroute\\Exception\\BadRouteException' => __DIR__ . '/..' . '/phroute/phroute/src/Phroute/Exception/BadRouteException.php',
        'Phroute\\Exception\\HttpException' => __DIR__ . '/..' . '/phroute/phroute/src/Phroute/Exception/HttpException.php',
        'Phroute\\Exception\\HttpMethodNotAllowedException' => __DIR__ . '/..' . '/phroute/phroute/src/Phroute/Exception/HttpMethodNotAllowedException.php',
        'Phroute\\Exception\\HttpRouteNotFoundException' => __DIR__ . '/..' . '/phroute/phroute/src/Phroute/Exception/HttpRouteNotFoundException.php',
        'Phroute\\HandlerResolver' => __DIR__ . '/..' . '/phroute/phroute/src/Phroute/HandlerResolver.php',
        'Phroute\\HandlerResolverInterface' => __DIR__ . '/..' . '/phroute/phroute/src/Phroute/HandlerResolverInterface.php',
        'Phroute\\Route' => __DIR__ . '/..' . '/phroute/phroute/src/Phroute/Route.php',
        'Phroute\\RouteCollector' => __DIR__ . '/..' . '/phroute/phroute/src/Phroute/RouteCollector.php',
        'Phroute\\RouteParser' => __DIR__ . '/..' . '/phroute/phroute/src/Phroute/RouteParser.php',
        'QueryBuilder' => __DIR__ . '/../..' . '/core/database/QueryBuilder.php',
        'Test' => __DIR__ . '/../..' . '/app/controllers/Test.php',
        'UserController' => __DIR__ . '/../..' . '/app/controllers/UserController.php',
        'UsersController' => __DIR__ . '/../..' . '/app/controllers/UsersController.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixesPsr0 = ComposerStaticInited0b810d2335ff32efaa9eba9b865f86::$prefixesPsr0;
            $loader->classMap = ComposerStaticInited0b810d2335ff32efaa9eba9b865f86::$classMap;

        }, null, ClassLoader::class);
    }
}
