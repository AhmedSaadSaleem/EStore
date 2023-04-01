<?php

namespace PHPMVC\Controllers;

use PHPMVC\Models\ArticleModel;

class IndexController extends AbstractController
{
    public function defaultAction(): void
    {

        $this->language->load('template.common');
        $this->language->load('index.default');
        $this->_data['articles'] = ArticleModel::getAll();
        $this->_template->swapTemplate(
            [
                'header'    => TEMPLATE_PATH . 'header.php',
                'navbar'    => TEMPLATE_PATH . 'nav.php',
                'titlebar'  => TEMPLATE_PATH . 'titlebar.php', 
                ':view'     => 'action_view',
                'footer'    => TEMPLATE_PATH . 'footer.php'
            ]);
        $this->_view();
    }
}