<?php

namespace App\Models;

use App\Core\Model;

class Posts extends Model {
    public function __construct() {
        self::init('posts', ['title', 'content', 'category']);
    }
}