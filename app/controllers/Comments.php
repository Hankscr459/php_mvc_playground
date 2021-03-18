<?php
    class Comments extends Controller {

        public function __construct()
        {

            if($_SESSION['user_role'] != 'admin') {
                redirect('posts');
            }
            
            $this->commentModel = $this->model('Comment');
            $this->postModel = $this->model('Post');
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

                $this->postModel->addCommentsCount($post_id);
                
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

        public function edit($id, $post_id) {
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                // Get existing post from model

                // Sanitize POST array
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $data = [
                    'id' => $id,
                    'post_id' => $post_id,
                    'body' => trim($_POST['body'])
                ];


                
                if ($this->commentModel->editComment($data)) {
                    flash('comment_message', 'update comment');
                    redirect("posts/show/$post_id");
                } else {
                    die('Something wentwrong');
                }
            } else {
                redirect("posts/show/$post_id");
            }
        }

        public function delete($id) {
            if($_SERVER['REQUEST_METHOD'] == 'POST') {

                $comment = $this->commentModel->getComment($id);

                $this->postModel->removeOneCommentCount($comment->post_id);

                if ($comment->user_id != $_SESSION['user_id'] || $_SESSION['user_role'] != 'admin') {
                    redirect("posts/show/$comment->post_id");
                }

                if ($this->commentModel->deleteComment($id)) {
                    flash('comment_message', 'Remove comment');
                    redirect("posts/show/$comment->post_id");
                } else {
                    die('Something wentwrong');
                }
            } else {
                redirect("posts/");
            }
        }
    }