<?php

$builder = $app->getContainerBuilder();

$builder->addDefinitions([
    'renderer.engine' => function($container) {
        return (new League\Plates\Engine($container->get('renderer.dir'), $container->get('renderer.ext')));
    },
    'renderer.dir' => PROJECT_FOLDER . '/templates',
    'renderer.ext' => 'php'
]);

$app->delayed(function(Sherpa\App\App $app) {
    $app->add(new Sherpa\Middlewares\PlatesRenderer($app->get('renderer.engine')), 10);
});
