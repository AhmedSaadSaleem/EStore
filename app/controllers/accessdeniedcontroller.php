<?php

namespace PHPMVC\Controllers;

class AccessDeniedController extends AbstractController
{
    public function defaultAction(): void
    {
        $this->language->load('template.common');
        $this->language->load('notfound.notfound');
        $this->_view();
    }
}