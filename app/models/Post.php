<?php 
    class Post {
        private $db;
        public $upload_errors_array = array(
            UPLOAD_ERR_OK        => "There is no error",
            UPLOAD_ERR_INI_SIZE  => "The uploaded file exceeds the upload_max_filesize directive in php.ini",
            UPLOAD_ERR_FORM_SIZE => "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML",
            UPLOAD_ERR_PARTIAL   => "The uploaded file was only partially uploaded.",
            UPLOAD_ERR_NO_FILE   => "No file was uploaded.",
            UPLOAD_ERR_NO_TMP_DIR=> "Missing a temporary folder.",
            UPLOAD_ERR_CANT_WRITE=> "Failed to write file to disk.",
            UPLOAD_ERR_EXTENSION => "A PHP extension stopped the file upload."
        );

        public function __construct()
        {
            $this->db = new Database;
            $this->paginate = new Paginate;
        }

        public function getPosts($page, $items_per_page, $items_total_count) {

            $this->paginate->page = $page;
            $this->paginate->items_per_page = $items_per_page;
            $this->paginate->items_total_count = $items_total_count;
            $current_page = ($page - 1) * $items_per_page;
            
            $this->db->query("SELECT *,
                              posts.id as postId,
                              users.id as userId,
                              posts.created_at as postCreated,
                              users.created_at as userCreated
                              FROM posts
                              INNER JOIN users
                              ON posts.user_id = users.id
                              ORDER BY posts.created_at DESC
                              LIMIT ${items_per_page} 
                              OFFSET {$current_page}
                              ");

            $results = $this->db->resultSet();

            return $results;
        }

        // This is passing $_FILES['uploaded_file'] as an argument
        public function set_file($file) {

            if (empty($file) || !$file || !is_array($file)) {
                $this->errors[] = "There was no file uploaded here";
                return false;
            } else if ($file['error'] != 0) {
                $this->errors[] = $this->upload_errors_array[$file['error']];
                return false;
            } else {
                $this->filename = basename($file['name']);
                $this->temp_path = $file['tmp_name'];
                $this->type = $file['type'];
                $this->size = $file['size'];
            }

        }

        public function addPost($data) {
            $this->db->query('INSERT INTO posts (title, user_id, body, post_image) VALUES(:title, :user_id, :body, :post_image)');
            // Bind values
            $this->db->bind(':title', $data['title']);
            $this->db->bind(':body', $data['body']);
            $this->db->bind(':post_image', $data['post_image']);
            $this->db->bind(':user_id', $data['user_id']);

            // Execute
            if ($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        }

        public function updatePost($data) {
            $this->db->query('UPDATE posts SET title = :title, body = :body WHERE id = :id');
            // Bind values
            $this->db->bind(':id', $data['id']);
            $this->db->bind(':title', $data['title']);
            $this->db->bind(':body', $data['body']);

            // Execute
            if ($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        }

        public function getPostById($id) {
            $this->db->query('SELECT * FROM POSTS WHERE id = :id');
            $this->db->bind(':id', $id);

            $row = $this->db->single();
            return $row;
        }

        public function deletePost($id) {
            $this->db->query('DELETE FROM posts WHERE id = :id');
            // Bind values
            $this->db->bind(':id', $id);

            // Execute
            if ($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        }

        public function postCount() {
            // Post Count
            $this->db->query('SELECT COUNT(*) FROM posts');
            $results = $this->db->Count();
            return $results;
        }

        public function viewsPostCount($id) {
            // Add View count
            $this->db->query("UPDATE posts SET post_views_count = post_views_count + 1 WHERE id = :id ");
            $this->db->bind(':id', $id);

            $this->db->execute();
        }
    }
?>