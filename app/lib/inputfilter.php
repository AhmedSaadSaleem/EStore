<?php

namespace PHPMVC\Lib;

trait InputFilter
{
    public function filterInt($input): mixed
    {
        return filter_var($input, FILTER_SANITIZE_NUMBER_INT);
    }

    public function filterFloat($input): mixed
    {
        return filter_var($input, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    }

    public function filterString($input): string
    {
        return htmlentities(strip_tags($input), ENT_QUOTES, 'UTF-8');
    }
}