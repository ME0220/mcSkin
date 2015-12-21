<?php

namespace Controller;

class Index
{
    public function index()
    {
        throw new \Core\Error('this page is not available', 500);
    }
}
