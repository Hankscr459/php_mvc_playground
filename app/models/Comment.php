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

        public function editComment($data) {
            $this->db->query('UPDATE comments SET body = :body WHERE id = :id');
            // Bind values 'UPDATE posts SET title = :title, body = :body WHERE id = :id'
            $this->db->bind(':id', $data['id']);
            $this->db->bind(':body', $data['body']);

            // Execute
            if ($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        }

        public function deleteComment($id) {
            $this->db->query('DELETE FROM comments WHERE id = :id');
            
            $this->db->bind(':id', $id);

            // Execute
            if ($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        }

        // public function deletePost($id) {
        //     $this->db->query('DELETE FROM posts WHERE id = :id');
        //     // Bind values
        //     $this->db->bind(':id', $id);

        //     // Execute
        //     if ($this->db->execute()) {
        //         return true;
        //     } else {
        //         return false;getComment
        //     }
        // }

        public function getComment($id) {
            $this->db->query('SELECT * FROM comments WHERE 	id	= :id');
            $this->db->bind(':id', $id);

            $row = $this->db->single();
            return $row;
        }
    }