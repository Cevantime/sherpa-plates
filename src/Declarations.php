<?php

namespace Sherpa\Plates;

use DI\ContainerBuilder;
use function DI\create;
use function DI\get;
use function DI\string;
use League\Plates\Engine;
use Psr\Http\Message\ServerRequestInterface;
use Sherpa\App\App;
use Sherpa\Declaration\Declaration;
use Sherpa\Declaration\DeclarationInterface;
use Sherpa\Plates\PlateExtension\AppExtension;
use Sherpa\Plates\PlateExtension\HelperExtension;

class Declarations extends Declaration
{

    public function definitions(ContainerBuilder $builder)
    {
        $builder->addDefinitions([
            Engine::class => create()
                ->constructor(get('renderer.dir'), get('renderer.ext'))
                ->method('loadExtension', get(AppExtension::class))
                ->method('loadExtension', get(HelperExtension::class))
            ,
            AppExtension::class => create()->constructor(get(ServerRequestInterface::class), get('router')),
            'renderer.engine' => \DI\get(Engine::class),
            'renderer.dir' => string('{project.root}/templates'),
            'renderer.ext' => 'php'
        ]);
    }

}
