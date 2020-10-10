<?php

namespace App\Models;

use Core\Database;
class Post
{
    public static function connectTable()
    {
        return Database::getInstance()->table('posts');
    }
}