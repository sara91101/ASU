<?php

use App\Console\Commands\ArchieveAdvertisement;
use App\Http\Middleware\LanguageManager;
use App\Http\Middleware\Privileges;
use App\Http\Middleware\WebsiteVisitor;
use Artesaos\SEOTools\Facades\SEOTools as SEOTools;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware)
    {
        $middleware->alias([
            'visitors' => WebsiteVisitor::class,
            'Privilege' => Privileges::class,
            'SEO' => SEOTools::class,
        ]);
        $middleware->web([LanguageManager::class,]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->withCommands([
        ArchieveAdvertisement::class,
    ])->create();
