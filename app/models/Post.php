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
        $this->db->query("SELECT *
        FROM posts P join users U on P.user_id = U.id
        WHERE P.user_id ='{$_SESSION['user_id']}'");
        $results = $this->db->resultSet();
        return $results;

    }
    public function galerietrick()
    {
        if (!isLoggedIn()) {
            redirect('users/login');
        }
        $this->db->query("SELECT id
        FROM posts P join users U on P.user_id = U.id
        WHERE P.user_id ='{$_SESSION['user_id']}'");
        $results = $this->db->resultSet();
        die(var_dump($posts));

        die(var_dump($results));
        return $results;

    }

    public function checkLikes($id)
    {

        $this->db->query('SELECT * FROM likes WHERE user_id = :user_id AND post_id = :id');
        $this->db->bind(':id', $id);
        $this->db->bind(':user_id', $_SESSION['user_id']);
        $results = $this->db->resultSet();
        if (count($results) >= 1) {
            return true;
        } else {
            return false;
        }
    }

    public function checkCmnt($data)
    {
        if (!preg_match('/^([\s*\w]+[\.\\/\-\@\s]*)+[\s\w]$/', $data['blabla']))
            return (redirect('posts'));
        else
            return true;
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
    public function checkadd($data)
    {
        if (!empty($_POST['title']) && isset($_POST['title']) && !empty($_POST['image']) && isset($_POST['image']))
        {
                $data['title'] = trim($_POST['title']);
                $data['image'] = trim($_POST['image']);
                return($data);
        }
        else
        {
            return(redirect('posts'));
        }
    }

    public function addPost($data, $imgthing)
    {
        if (!isLoggedIn()) {
            redirect('users/login');
        } elseif (isLoggedIn()) {

            $this->db->query('INSERT INTO posts (title, user_id, image) VALUES(:title, :user_id, :image)');


            $this->db->bind(':title', $data['title']);
            $this->db->bind(':user_id', $data['user_id']);
            $this->db->bind(':image', $imgthing);
        }

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
            $this->db->query('INSERT INTO cmnt (post_id, user_id, cmnt, display_name) VALUES (:id, :user_id, :cmnt , :display_name)');
            $this->db->bind(':id', $id);
            $this->db->bind(':user_id', $_SESSION['user_id']);
            $this->db->bind(':cmnt', $data['blabla']);
            $this->db->bind(':display_name', $_SESSION['display_name']);
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

    public function updatePost($data)
    {
        $this->db->query('UPDATE posts SET title = :title, image = :image WHERE id = :id');


        $this->db->bind(':id', $data['id']);
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':image', $data['image']);
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

    public function getCmntById($id)
    {
        $this->db->query('SELECT * FROM cmnt WHERE post_id = :id');
        $this->db->bind(':id', $id);
        $results = $this->db->resultSet();
        return $results;
    }

    public function deletePost($id)
    {
        $this->db->query('DELETE FROM posts WHERE id = :id');
        $this->db->bind(':id', $id);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function resize_image($url, $width, $height) {
        list($width_orig, $height_orig) = getimagesize($url);
        $ratio_orig = $width_orig / $height_orig;
        $height = $width / $ratio_orig;
        $src = imagecreatefromstring(file_get_contents($url));
        $dst = imagecreatetruecolor($width, $height);
        imagecopyresampled($dst, $src, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
        return $dst;
    }

    public function saveImage($img, $num_fil)
    {
        if ($num_fil < 1 || $num_fil > 6)
            return false;
            $urlfil = 'img/sup/' . $num_fil . '.png';
        if (!file_exists('upload/'))
            mkdir("upload/", 0700);
        $folderPath = "upload/";
        $image_parts = explode(";base64,", $img['image']);
        $image_type_aux = explode("image/", $image_parts[0]);
        if (!isset($image_type_aux[1]) || empty($image_type_aux[1]))
            return false;
        $image_type = $image_type_aux[1];
        if (!($image_base64 = base64_decode($image_parts[1], true)))
            return false;
        $fileName = uniqid() . '.png';
        $file = $folderPath . $fileName;
        file_put_contents($file, $image_base64);
        $imgTmp = $this->resize_image($file, 800, 600);
        $filter = imagecreatefromstring(file_get_contents($urlfil));
        $sx = imagesx($filter);
        $sy = imagesy($filter);
        imagecopy( $imgTmp,$filter, 400 - ($sx / 2), 300 - ($sy - 150), 0, 0, $sx, $sy);
        imagejpeg($imgTmp, $file);
        imagedestroy($imgTmp);

        return ($file);
    }
}
