<?php

namespace App\Controllers;

class Postcontroller
{
    public function __construct()
    {
       // echo __CLASS__;
    }

    public function index()
    {
        echo 'index function';
    }

    public function create()
    {
        echo 'Create Function';
    }
}