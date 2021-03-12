<?php
    class Comments extends Controller {

        public function __construct()
        {

            if($_SESSION['user_role'] != 'admin') {
                redirect('posts');
            }
            
            $this->commentModel = $this->model('Comment');
        }

        public function add($post_id) {
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                // Get existing post from model

                $data = [
                    'post_id' => $post_id,
                    'user_id' => $_SESSION['user_id'],
                    'body' => trim($_POST['body']),
                    'author' => $_SESSION['user_name']
                ];


                
                if ($this->commentModel->addComment($data)) {
                    flash('comment_message', 'add comment');
                    redirect("posts/show/$post_id");
                } else {
                    die('Something wentwrong');
                }
            } else {
                redirect("posts/show/$post_id");
            }
        }
    }