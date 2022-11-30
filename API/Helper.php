<?php

namespace API;

class Helper
{
    function isXml(string $value): bool
    {
        $prev = libxml_use_internal_errors(true);
        $doc = simplexml_load_string($value);
        $errors = libxml_get_errors();
        libxml_clear_errors();
        libxml_use_internal_errors($prev);

        return false !== $doc && empty($errors);
    }

    public function isJSON($string): bool
    {
        return is_string($string) && is_array(json_decode($string, true));
    }

    public function arrayToXml($array, $rootElement = null, $xml = null)
    {
        $_xml = $xml;
        if ($_xml === null) {
            $_xml = new \SimpleXMLElement($rootElement !== null ? $rootElement : '<root/>');
        }

        foreach ($array as $k => $v) {
            if (is_array($v)) {
                $this->arrayToXml($v, $k, $_xml->addChild($k));
            } else {
                $_xml->addChild($k, $v);
            }
        }

        return $_xml->asXML();
    }
}
