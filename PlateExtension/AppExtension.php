<?php

namespace Sherpa\PlateExtension;

use Sherpa\App\App;
use League\Plates\Engine;
use League\Plates\Extension\ExtensionInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Description of AppExtension
 *
 * @author cevantime
 */
class AppExtension implements ExtensionInterface
{
    private $request;
    
    public function __construct(ServerRequestInterface $request)
    {
        $this->request = $request;
    }
    
    public function register(Engine $engine)
    {
        if( ! $engine->doesFunctionExist('request')){
            $engine->registerFunction('request', [$this,'getRequest']);
        }
    }
    
    public function getRequest()
    {
        return $this->request;
    }

}
