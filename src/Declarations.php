<?php

namespace Sherpa\Plates;

use DI\ContainerBuilder;
use function DI\create;
use function DI\get;
use function DI\string;
use League\Plates\Engine;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Sherpa\App\App;
use Sherpa\Declaration\Declaration;
use Sherpa\Declaration\DeclarationInterface;
use Sherpa\Middlewares\RequestHandler;
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
            'renderer.engine' => \DI\get(Engine::class),
            'renderer.dir' => string('{project.root}/templates'),
            'renderer.ext' => 'php'
        ]);
    }

    public function custom(App $app)
    {
        $app->pipe(function(ServerRequestInterface $request, RequestHandlerInterface $handler)use($app){
            $app->set(AppExtension::class, new AppExtension($app->get(ServerRequestInterface::class), $app->get('router')));
            return $handler->handle($request);
        }, 0, RequestHandler::class);
    }

}
