<?php
/**
 * Created by PhpStorm.
 * User: cevantime
 * Date: 26/10/18
 * Time: 23:34
 */

namespace Sherpa\Plates\PlateExtension;


use League\Plates\Engine;
use League\Plates\Extension\ExtensionInterface;

class HelperExtension implements ExtensionInterface
{

    public function register(Engine $engine)
    {
        if (!$engine->doesFunctionExist('entry')) {
            $engine->registerFunction('entry', [$this, 'printEntry']);
        }
        if (!$engine->doesFunctionExist('listing')) {
            $engine->registerFunction('listing', [$this, 'printList']);
        }
    }

    public function printEntry(string $entryName, $data)
    {
        return !empty($data[$entryName]) ? htmlspecialchars($data[$entryName], ENT_QUOTES | (defined('ENT_SUBSTITUTE') ? ENT_SUBSTITUTE : 0), 'UTF-8') : '';
    }

    public function printList($data, $wrapperTag = 'ul', $delimiterTag = 'li')
    {
        if(empty($data)) {
            return;
        }
        $ewexp = explode(' ', $wrapperTag);
        $endWrapper = array_shift($ewexp);
        $wrapperTagStart = '<' . $wrapperTag . '>';
        $wrapperTagEnd = '</' . $endWrapper . '>';

        $dtexp = explode(' ', $delimiterTag);
        $endDelimiter = array_shift($dtexp);
        $delimiterTagStart = '<' . $delimiterTag . '>';
        $delimiterTagEnd = '</' . $endDelimiter . '>';

        $out = $wrapperTagStart . PHP_EOL;

        foreach ($data as $value) {
            $out .= $delimiterTagStart . htmlspecialchars($value, ENT_QUOTES | (defined('ENT_SUBSTITUTE') ? ENT_SUBSTITUTE : 0), 'UTF-8') . $delimiterTagEnd . PHP_EOL;
        }
        $out .= $wrapperTagEnd;

        return $out;
    }
}