<?php
namespace PHPMVC\Lib\Template;

trait TemplateHelper
{
    public function matchUrl($url): bool
    {
        return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) === $url;
    }

    public function showValue($fieldName, $object = null): mixed
    {
        return isset($_POST[$fieldName]) ? $_POST[$fieldName] : (is_null($object) ? '' : $object->$fieldName); 
    }

    public function selectedIf($fieldName, $value, $object = null): string
    {
        return ((isset($_POST[$fieldName]) && $_POST[$fieldName] == $value) || (!is_null($object) && $object->$fieldName == $value)) ? 'selected="selected"' : '' ; 
    }
}