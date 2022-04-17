<?php
namespace PHPMVC\Lib;

class Language
{
    
    private $_dictionary = [];

    public function load($path)
    {
        $lang = APP_DEFAULT_LANGUAGE;
        if(isset($_SESSION['lang'])){
            $lang = $_SESSION['lang'];
        }

        $languageFile = LANGUAGES_PATH . $lang . DS . str_replace('.', DS, $path) . '.lang.php';
        if(file_exists($languageFile)){
            require $languageFile;
            if(is_array($_) && !empty($_)){
                foreach($_ as $textTitle => $textValue){
                    $this->_dictionary[$textTitle] = $textValue;
                }
            }
        } else {
            trigger_error('Sorry the language file ' . $languageFile . ' Dos\'t exists', E_USER_WARNING);
        }
    }

    public function getDictionary()
    {
        return $this->_dictionary;
    }

    public function feedKey($key, $data)
    {
        if(array_key_exists($key, $this->_dictionary)){
            array_unshift($data, $this->_dictionary[$key]);
            return call_user_func_array('sprintf', $data);
        }
    }

    public function get($key)
    {
        if(array_key_exists($key, $this->_dictionary)){
            return $this->_dictionary[$key];
        }
    }
}