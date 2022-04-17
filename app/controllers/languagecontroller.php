<?php

namespace PHPMVC\Controllers;

class LanguageController extends AbstractController
{
    public function defaultAction()
    {
        if($_SESSION['lang'] == 'ar'){
            $_SESSION['lang'] = 'en';
        } else {
            $_SESSION['lang'] = 'ar';
        }
        $this->redirect($_SERVER['HTTP_REFERER']);
    }
}