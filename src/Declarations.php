<?php

namespace Sherpa\Plates;

use Sherpa\Declaration\DeclarationInterface;

class Declarations implements DeclarationInterface
{

    public function register(\Sherpa\App\App $app)
    {
        $builder = $app->getContainerBuilder();

        $builder->addDefinitions([
            'renderer.engine' => function($container) {
                return (new League\Plates\Engine($container->get('renderer.dir'), $container->get('renderer.ext')));
            },
            'renderer.dir' => PROJECT_FOLDER . '/templates',
            'renderer.ext' => 'php'
        ]);

        $app->delayed(function(Sherpa\App\App $app) {
            $app->add(new Sherpa\Plates\Middlewares\PlatesRenderer($app->get('renderer.engine')), 10);
        });
    }

}
