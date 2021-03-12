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
            
        }

        public function index() {
            

            $data = [
                'title' => 'Admin Dashboard',
            ];

            $this->view('admin/index', $data);
        }
    }