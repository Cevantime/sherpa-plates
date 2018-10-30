<?php

namespace Sherpa\Plates\PlateExtension;

use Aura\Router\RouterContainer;
use League\Plates\Engine;
use League\Plates\Extension\ExtensionInterface;
use Psr\Http\Message\ServerRequestInterface;
use Sherpa\App\App;

/**
 * Description of AppExtension
 *
 * @author cevantime
 */
class AppExtension implements ExtensionInterface
{
    /**
     * @var ServerRequestInterface $request
     */
    private $request;

    private $router;

    /**
     * AppExtension constructor.
     * @param ServerRequestInterface $request
     */
    public function __construct(ServerRequestInterface $request, RouterContainer $router)
    {
        $this->request = $request;
        $this->router = $router;
    }

    public function register(Engine $engine)
    {
        if( ! $engine->doesFunctionExist('request')){
            $engine->registerFunction('request', [$this,'getRequest']);
        }

       if( ! $engine->doesFunctionExist('url')){
            $engine->registerFunction('url', [$this,'generateUrl']);
       }
    }
    
    public function getRequest()
    {
        return $this->request;
    }

    public function generateUrl($routeName, $params = [])
    {
        return $this->router->getGenerator()->generate($routeName, $params);
    }

}
