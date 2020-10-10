<?php

namespace App\Controllers;

use Core\View;
use App\Models\Post;

class Postcontroller
{
    public function __construct()
    {
      
    }

    public function index()
    {
        $data['posts'] = Post::connectTable()->select()->get();

        View::load('posts/index',$data);
    }

    public function create()
    {
        echo 'Create Function';
    }

    public function edit($id)
    {
        echo 'This is Post Controller and edit function and the param is equal'.$id;
    }
}