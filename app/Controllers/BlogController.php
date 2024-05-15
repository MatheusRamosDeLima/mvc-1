<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Utils\View;
use App\Models\BlogModel;

class BlogController extends Controller {
    private BlogModel $db;

    public function index() {
        $this->db = new BlogModel;

        $categories = $this->db->getAll('categories');
        $posts = $this->db->getAll('posts');

        $view = new View('Blog/index', 'All posts', 'Blog/index');
        $this->viewWithTemplate($view, [
            'categories' => $categories,
            'posts' => $posts,
            'postCategory' => function($post) {
                return $this->db->getObject('categories', $post->categoryid)->name;
            }
        ]);
        return;
    }

    public function category(string $categoryName) {
        $this->db = new BlogModel;

        $category = $this->db->getObject('categories', $categoryName, 'name');
        if ($category) {
            $doesPostsExist = false;
            $categoryPosts = $this->db->getArray('posts', $category->id, 'categoryid');
            if ($categoryPosts) $doesPostsExist = true;
            $view = new View('Blog/category', "Posts about $categoryName");
            $this->viewWithTemplate($view, [
                'categoryName' => $categoryName,
                'doesPostsExist' => $doesPostsExist,
                'posts' => $categoryPosts
            ]);
            return;
        }
        $this->error404();
        return;
    }

    public function get(string $postId) {
        $this->db = new BlogModel;

        $post = $this->db->getObject('posts', $postId);
        if ($post) {
            $view = new View('Blog/get', "$post->name");
            $this->viewWithTemplate($view, [
                'postName' => $post->name,
                'postContent' => $post->content,
                'postCategory' => $this->db->getObject('categories', $post->categoryid)->name
            ]);
            return;
        }
        $this->error404();
        return;
    }
}