<?php

namespace PHPMVC\Controllers;

class AccessDeniedController extends AbstractController
{
    public function defaultAction()
    {
        $this->language->load('template.common');
        $this->language->load('notfound.notfound');
        $this->_view();
    }
}