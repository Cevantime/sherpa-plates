<?php

namespace Sherpa\Plates\Traits;

use Zend\Diactoros\Response\HtmlResponse;

/**
 * Description of RendererTrait
 *
 * @author cevantime
 */
trait RendererTrait
{
    public function render($name, $data = array()) 
    {
        return new HtmlResponse($this->container->get('renderer.engine')->render($name, $data));
    }
}
