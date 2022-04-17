<?php

namespace PHPMVC\Lib;

class Authentication
{
    private static $instance;
    private $_session;
    private $_execludeRoutes = [
        '/index/default',
        '/auth/login',
        '/auth/logout',
        '/users/profile',
        '/users/setting',
        '/users/changepassword',
        '/language/default',
        '/accessdenied/default',
        'notfound/noutfound',
        '/test/default',
        '/notifications/default'
    ];

    private function __construct($session)
    {
        $this->_session = $session;
    }

    private function __clone(){}

    public static function getInstance(SessionManager $session)
    {
        if(self::$instance === null){
            self::$instance = new self($session);
        }
        return self::$instance;
    }

    public function isAuthorized()
    {
        return isset($this->_session->u);
    }

    public function hasAccess($controller, $action)
    {
        $url = '/' . $controller . '/' . $action;
        if(in_array($url, $this->_execludeRoutes) || in_array($url, $this->_session->u->privileges)){
            return true;
        }
        return false;
    }
}