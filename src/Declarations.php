<?php

namespace Sherpa\Plates;

use League\Plates\Engine;
use Sherpa\App\App;
use Sherpa\Declaration\DeclarationInterface;
use Sherpa\Plates\Middlewares\PlatesRenderer;

class Declarations implements DeclarationInterface
{

    public function register(App $app)
    {
        $builder = $app->getContainerBuilder();

        $builder->addDefinitions([
            'renderer.engine' => function($container) {
                return (new Engine($container->get('renderer.dir'), $container->get('renderer.ext')));
            },
            Engine::class => \DI\get("renderer.engine"),
            'renderer.dir' => 'templates',
            'renderer.ext' => 'php'
        ]);

        $app->delayed(function(App $app) {
            $app->add(new PlatesRenderer($app->get('renderer.engine')), 10);
        });
    }

}
