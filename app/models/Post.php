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
    public function checkLikes($id)
    {
        
        $this->db->query('SELECT * FROM likes WHERE user_id = :user_id AND post_id = :id');
        $this->db->bind(':id', $id);
        $this->db->bind(':user_id', $_SESSION['user_id']);
        $results = $this->db->resultSet();
        if (count($results) >= 1)
        {
            return true;
        } else {
            return false;
        }
    }
    public function checkCmnt($data)
    {
        
        if (!preg_match('/^([\s*\w]+[\.\\/\-\@\s]*)+[\s\w]$/',$data['blabla']))
        die(var_dump(preg_match('/^([\s*\w]+[\.\\\/\-\@\s]*)+[\s\w]$/',$data['blabla'])));
        // return(redirect('posts'));
        else
        die(var_dump($data));
        // return true;
    }
    public function removeLike($id)
    {
        if (!isLoggedIn()) {
            redirect('users/login');
        } elseif (isLoggedIn()) {
            $this->db->query('UPDATE posts SET like_count = (like_count - 1) WHERE id = :id');
        }
        $this->db->bind(':id', $id);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function removeLikeCount($id)
    {
        if (!isLoggedIn()) {
            redirect('users/login');
        } elseif (isLoggedIn()) {
            $this->db->query('DELETE FROM likes WHERE user_id = :user_id AND post_id = :id');
            $this->db->bind(':id', $id);
            $this->db->bind(':user_id', $_SESSION['user_id']);
        }
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    
    public function getsnitching($user_id)
    {
        if (!isLoggedIn()) {
            redirect('users/login');
        }
        if ($_SESSION['user_id'] == $user_id)
        redirect('posts/me');
        
        $this->db->query("SELECT *
        FROM posts P join users U on P.user_id = U.id
        WHERE P.user_id = $user_id;");
        $results = $this->db->resultSet();
        return $results;
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
    public function addLike($id)
    {
        if (!isLoggedIn()) {
            redirect('users/login');
        } elseif (isLoggedIn()) {
            $this->db->query('INSERT INTO likes (user_id, post_id) VALUES (:user_id, :id)');
            $this->db->bind(':id', $id);
            $this->db->bind(':user_id', $_SESSION['user_id']);
        }
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function addCmnt($data, $id)
    {
        if (!isLoggedIn()) {
            redirect('users/login');
        } elseif (isLoggedIn()) {
            $this->db->query('INSERT INTO cmnt (post_id, user_id, cmnt) VALUES (:id, :user_id, :cmnt)');
            $this->db->bind(':id', $id);
            $this->db->bind(':user_id', $_SESSION['user_id']);
            $this->db->bind(':cmnt', $data['blabla']);
        }
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    
    public function addLikeCount($id)
    {
    
        if (!isLoggedIn()) {
            redirect('users/login');
        } elseif (isLoggedIn()) {
            $this->db->query('UPDATE posts SET like_count = (like_count + 1) WHERE id = :id');
            $this->db->bind(':id', $id);
        }
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function addCmntcount($id)
    {
    
        if (!isLoggedIn()) {
            redirect('users/login');
        } elseif (isLoggedIn()) {
            $this->db->query('UPDATE posts SET cmnt_count = (cmnt_count + 1) WHERE id = :id');
            $this->db->bind(':id', $id);
        }
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    function saveImage64($data)
    {
        list($type, $data) = explode(';', $data);
        list(, $ext) = explode('/', $type);
        list(, $data) = explode(',', $data);
        $root = dirname(dirname(APPROOT));
        if (!file_exists($root . '/uploads'))
            exec('mkdir -p ' . $root . '/uploads');
        $dest = 'uploads/' . uniqid('', true) . '.' . $ext;
        file_put_contents($root . '/' . $dest, base64_decode($data));
        return $dest;
    }

    public function updatePost($data)
    {
        $this->db->query('UPDATE posts SET title = :title, image = :image WHERE id = :id');


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

    public function deletePost($id)
    {
        $this->db->query('DELETE FROM posts WHERE id = :id');
        //binding login values
        $this->db->bind(':id', $id);

        //execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
