<?php

return [
    'modules_folder' => 'Modules',

    'generateFiles' => [
        'config.stub' => 'config/config.php',
        'controller.stub' => 'Http/Controllers/$StudlyDummyModuleName$Controller.php',
        'provider.stub' => 'Providers/$StudlyDummyModuleName$ServiceProvider.php',
        'route-provider.stub' => 'Providers/RouteServiceProvider.php',
        'api.stub' => 'routes/api.php',
        'web.stub' => 'routes/web.php'
    ]
];