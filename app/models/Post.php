<?php
class post
{
    private $db;
    public function __construct()
    {
        $this->db = new Database;
    }
    public function getposts()
    {
        $this->db->query('SELECT *,
                            posts.id as postId,
                            users.id as userId
                            FROM posts
                            INNER JOIN users
                            ON posts.user_id = users.id
                            ORDER BY posts.created_at DESC
                            ');
        $results = $this->db->resultSet();
        return $results;
    }

    public function getmyposts()
    {
        if (!isLoggedIn()) {
            redirect('users/login');
        }
        #userid = 
        $this->db->query("SELECT *
        FROM posts P join users U on P.user_id = U.id
        WHERE P.user_id ='{$_SESSION['user_id']}'");
        $results = $this->db->resultSet();
        return $results;
    }
    
    public function getsnitching($user_id){
        if (!isLoggedIn()) {
            redirect('users/login');
        }
        if ($_SESSION['user_id'] == $user_id)
        redirect('posts/me');

        $this->db->query("SELECT *
        FROM posts P join users U on P.user_id = U.id
        WHERE P.user_id = $user_id;");
        #$this->db->query("SELECT *
        #FROM posts P join users U on P.user_id = U.id
        #WHERE P.user_id = U.id");
        $results = $this->db->resultSet();
        return $results;
    }
    public function confirmAccount(){
        
    }
    public function addPost($data)
    {
        if (!isLoggedIn()) {
            redirect('users/login');
        } elseif (isLoggedIn()) {

            $this->db->query('INSERT INTO posts (title, user_id, image) VALUES(:title, :user_id, :image)');

            //binding login values

            $this->db->bind(':title', $data['title']);
            $this->db->bind(':user_id', $data['user_id']);
            $this->db->bind(':image', $data['image']);
        }


        //execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function updatePost($data)
    {
        $this->db->query('UPDATE posts SET title = :title, image = :image WHERE id = :id');

        //binding login values

        $this->db->bind(':id', $data['id']);
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':image', $data['image']);


        //execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }


    public function getPostById($id)
    {
        $this->db->query('SELECT * FROM posts WHERE id = :id');
        $this->db->bind(':id', $id);
        $row = $this->db->single();
        return $row;
    }
    public function deletePost($id){
        $this->db->query('DELETE FROM posts WHERE id = :id');
        //binding login values
        $this->db->bind(':id',$id);

        //execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
