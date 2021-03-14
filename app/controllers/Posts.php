<?php 
    class Posts extends Controller {
        public function __construct()
        {
            if(!isLoggedIn()) {
                redirect('users/login');
            }

            $this->postModel = $this->model('Post');
            $this->userModel = $this->model('User');
            $this->commentModel = $this->model('Comment');
        }

        public function index() {

            $items_total_count = $this->postModel->postCount();
            $page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;
            $items_per_page = !empty($_GET['items_per_page']) ? (int)$_GET['items_per_page'] : 4;

            // Get posts
            $posts = $this->postModel->getPosts($page, $items_per_page, $items_total_count);

            $data = [
                'posts' => $posts,
                'posts_total' => $items_total_count,
                'page_total' => ceil($items_total_count/$items_per_page),
                'current_page' => $page
            ];

            $this->view('posts/index', $data);
        }

        public function add() {
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                $upload_errors = array(
                    UPLOAD_ERR_OK        => "There is no error",
                    UPLOAD_ERR_INI_SIZE  => "The uploaded file exceeds the upload_max_filesize ",
                    UPLOAD_ERR_FORM_SIZE => "The uploaded file exceeds the MAX_FILE_SIZE directive",
                    UPLOAD_ERR_PARTIAL   => "The uploaded file was only partially uploaded.",
                    // UPLOAD_ERR_NO_FILE   => "No file was uploaded.",
                    UPLOAD_ERR_NO_TMP_DIR=> "Missing a temporary folder.",
                    UPLOAD_ERR_CANT_WRITE=> "Failed to write file to disk.",
                    UPLOAD_ERR_EXTENSION => "A PHP extension stopped the file upload."
                );
                
                // Sanitize POST array
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $path_parts = pathinfo($_FILES['post_image']["name"]);
                $image_path = $path_parts['filename'].'_'.time().'.'.$path_parts['extension'];

                $data = [
                    'title' => trim($_POST['title']),
                    'body' => trim($_POST['body']),
                    'post_image' => $_FILES['post_image']['name'] ? $image_path : 'default.jpg',
                    'user_id' => $_SESSION['user_id'],
                    'title_err' => '',
                    'body_err' => '',
                    'post_image_err' => '',
                    'message' => ''
                ];

                // Validate title
                if(empty($data['title'])) {
                    $data['title_err'] = 'Please enter title';
                }

                if(empty($data['body'])) {
                    $data['body_err'] = 'Please enter body text';
                }


                $the_error = $_FILES['post_image']['error'];

                
                $temp_name = $_FILES['post_image']['tmp_name'];
                $directory = "upload";

                $allowedTypes = array(IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF);
                $detectedType = @exif_imagetype($_FILES['post_image']['tmp_name']);

                if (is_uploaded_file($temp_name)) {
                    if ($_FILES['post_image']['size'] > 80000000) {
                        $data['post_image_err'] = 'The uploaded file exceeds the upload_max_filesize 80MB';
                    } else if (!in_array($detectedType, $allowedTypes) && !empty($_FILES['post_image']['name'])) {
                        $data['post_image_err'] = "File must be image type.";
                    } else if(move_uploaded_file($temp_name, $directory . "/" . $image_path)) {
                        $data['message'] = "File upload successfully";
                    } else {
                        $the_error = $_FILES['post_image']['error'];
                        $data['post_image_err'] = $upload_errors[$the_error];
                    }
                }

                // Make sure no errors
                if(empty($data['title_err']) && empty($data['body_err']) && empty($data['post_image_err'])) {
                    // Validated

                    if ($this->postModel->addPost($data)) {
                        flash('post_message', 'Post Added');
                        redirect('posts');
                    } else {
                        die('Somrthing went wrong');
                    }
                } else {
                    // Load view with errors
                    $this->view('posts/add', $data);
                }

            } else {
                $data = [
                    'title' => '',
                    'body' => ''
                ];
                $this->view('posts/add', $data);
            }
            
            
        }

        public function edit($id) {
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                
                // Sanitize POST array
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $data = [
                    'id' => $id, 
                    'title' => trim($_POST['title']),
                    'body' => trim($_POST['body']),
                    'user_id' => $_SESSION['user_id'],
                    'title_err' => '',
                    'body_err' => ''
                ];

                // Validate title
                if(empty($data['title'])) {
                    $data['title_err'] = 'Please enter title';
                }

                if(empty($data['body'])) {
                    $data['body_err'] = 'Please enter body text';
                }

                // Make sure no errors
                if(empty($data['title_err']) && empty($data['body_err'])) {
                    // Validated
                    if ($this->postModel->updatePost($data)) {
                        flash('post_message', 'Post updated');
                        redirect('posts');
                    } else {
                        die('Somrthing went wrong');
                    }
                } else {
                    // Load view with errors
                    $this->view('posts/edit', $data);
                }

            } else {
                // Get existing post from model
                $post = $this->postModel->getPostById($id);

                // Check for owner
                if($post->user_id != $_SESSION['user_id']) {
                    redirect('posts');
                }

                $data = [
                    'id' => $id,
                    'title' => $post->title,
                    'body' => $post->body
                ];

                // Load view with errors
                $this->view('posts/edit', $data);
            }
            
            
        }

        public function show($id) {
            $post = $this->postModel->getPostById($id);
            $this->postModel->viewsPostCount($id);
            $user = $this->userModel->getUserById($post->user_id);
            $comments = $this->commentModel->getCommentById($id);

            $data = [
                'post' => $post,
                'user' => $user,
                'comments' => $comments
            ];

            $this->view('posts/show', $data);
        }

        public function delete($id) {
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                // Get existing post from model
                $post = $this->postModel->getPostById($id);

                // Check for owner or admin
                if ($post->user_id != $_SESSION['user_id'] || $_SESSION['user_role'] != 'admin') {
                    redirect('posts');
                }
                if ($this->postModel->deletePost($id)) {
                    flash('post_message', 'Post removed');
                    redirect('posts');
                } else {
                    die('Something wentwrong');
                }
            } else {
                redirect('posts');
            }
        }

    }
?>