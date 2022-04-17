<?php

namespace PHPMVC\Controllers;

class notFoundController extends AbstractController
{
    public function notFoundAction()
    {
        $this->language->load('template.common');
        $this->language->load('notfound.notfound');
        $this->_view();
    }
}