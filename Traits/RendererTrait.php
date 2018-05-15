<?php

namespace Sherpa\Traits;

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
        return new HtmlResponse($this->get('renderer.engine')->render($name, $data));
    }
}
