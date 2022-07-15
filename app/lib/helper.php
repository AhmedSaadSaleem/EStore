<?php

namespace PHPMVC\Lib;

trait Helper
{
    public function redirect($path): never
    {
        session_write_close();
        header('Location: ' . $path);
        exit;
    }
}