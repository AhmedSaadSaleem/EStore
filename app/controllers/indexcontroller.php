<?php

namespace PHPMVC\Controllers;

class IndexController extends AbstractController
{
    public function defaultAction(): void
    {
        $this->language->load('template.common');
        $this->language->load('index.default');
        $this->_view();
    }
}