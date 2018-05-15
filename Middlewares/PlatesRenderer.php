<?php

namespace Sherpa\Middlewares;

use Sherpa\PlateExtension\AppExtension;
use League\Plates\Engine;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

/**
 * Description of PlatesRendererMiddleware
 *
 * @author cevantime
 */
class PlatesRenderer implements MiddlewareInterface
{
    private $rendererEngine;
    
    public function __construct(Engine $rendererEngine)
    {
        $this->rendererEngine = $rendererEngine;
    }
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $this->rendererEngine->loadExtension(new AppExtension($request));
        
        return $handler->handle($request);
    }

}
