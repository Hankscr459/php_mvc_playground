<?php
    class Admin extends Controller {

        public function __construct()
        {
            if(!isLoggedIn()) {
                redirect('users/login');
            }

            if($_SESSION['user_role'] != 'admin') {
                redirect('posts');
            }
            
            $this->postModel = $this->model('Post');
        }

        public function index() {
            

            $data = [
                'title' => 'Admin Dashboard',
            ];

            $this->view('admin/index', $data);
        }

        public function posts() {
            
            $items_total_count = $this->postModel->postCount();
            $page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;
            $items_per_page = !empty($_GET['items_per_page']) ? (int)$_GET['items_per_page'] : 4;

            // Get posts
            $posts = $this->postModel->getPosts($page, $items_per_page, $items_total_count);

            $data = [
                'title' => 'Manage Posts',
                'posts' => $posts,
                'posts_total' => $items_total_count,
                'page_total' => ceil($items_total_count/$items_per_page),
                'current_page' => $page
            ];

            $this->view('admin/posts', $data);
        }
    }