<?php

namespace PHPMVC\Controllers;

use PHPMVC\LIB\FrontController;
use PHPMVC\Lib\Helper;
use PHPMVC\Lib\InputFilter;
use PHPMVC\Lib\Validate;

class AbstractController
{

    use Validate;
    use InputFilter;
    use Helper;

    protected $_controller;
    protected $_action;
    protected $_params;

    protected $_registry;
    /**
     * @var Template\Template
     */
    protected $_template;
    
    protected $_data = [];

    public function setController($controllerName): void
    {
        $this->_controller = $controllerName;
    }

    public function setAction($actionName): void
    {
        $this->_action = $actionName;
    }

    public function setParams($params): void
    {
        $this->_params = $params;
    }

    public function setRegistry($registry): void
    {
        $this->_registry = $registry;
    }

    public function setTemplate($template): void
    {
        $this->_template = $template;
    }

    public function __get($key): mixed
    {
        return $this->_registry->$key;
    }
    
    protected function _view(): void
    {
        $view = VIEWS_PATH . $this->_controller . DS . $this->_action . '.view.php';
        if($this->_action == FrontController::NOT_FOUND_ACTION || !file_exists($view)){
            $view =  VIEWS_PATH . 'notfound' . DS . 'notfound.view.php';
        }

        $this->_data = array_merge($this->_data, $this->language->getDictionary());
        $this->_template->setRegistry($this->_registry);
        $this->_template->setActionViewFile($view);
        $this->_template->setAppData($this->_data);
        $this->_template->renderApp();
        
    }
}