<?php
    class Comment {
        private $db;

        public function __construct() {
            $this->db = new Database;
        }

        public function getCommentById($post_id) {
            $this->db->query('SELECT * FROM comments WHERE 	post_id	 = :post_id');
            $this->db->bind(':post_id', $post_id);

            $results = $this->db->resultSet();
            return $results;
        }

        public function addComment($data) {
            $this->db->query('INSERT INTO comments (post_id, user_id, author, body) VALUES(:post_id, :user_id, :author, :body)');
            // Bind values
            $this->db->bind(':post_id', $data['post_id']);
            $this->db->bind(':body', $data['body']);
            $this->db->bind(':author', $data['author']);
            $this->db->bind(':user_id', $data['user_id']);

            // Execute
            if ($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        }
    }