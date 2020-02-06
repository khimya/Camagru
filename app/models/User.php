<?php
class User
{
    private $db;

    public function  __construct()
    {
        $this->db = new Database;
    }

    // register user
    public function register($data)
    {
        $this->db->query('INSERT INTO users (display_name, email, password, cle) VALUES(:display_name, :email, :password, :cle)');
        //binding register values
        $this->db->bind(':display_name', $data['display_name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']);
        $this->db->bind(':cle', $data['cle']);


        //execute
        if ($this->db->execute()) {
            return true;
        } else {

            return false;
        }
    }


    ////////////////////////////////////////////////////////////////////////////
    // login user
    public function login($display_name, $password)
    {
        $this->db->query('SELECT * FROM users WHERE display_name = :display_name AND actif = 1');
        $this->db->bind(':display_name', $display_name);

        $row = $this->db->single();

        $hashed_password = $row->password;
        if (password_verify($password, $hashed_password)) {
            return $row;
        } else {
            return false;
        }
    }
    // public function recover($data)
    // {
    //     // $this->db->query('SELECT * FROM users WHERE email = :email');

    //     //binding login values
    //     $this->db->bind(':email', $data['email']);
    //     // $this->db->bind(':password', $data['password']);


    //     //execute
    //     if ($this->db->execute()) {
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }
    //find user by email

    public function checkEmail($data)
    {
        if (empty($data['email']) || !isset($_POST['email'])) {
            return ($data['email_err'] = 'Please enter email');
        }
        if (!empty($data['email']) && !preg_match("/([\w\-]{3,}\@[\w\-]{3,}\.[\w\-]{2,3})/", $data['email'])) {
            return ($data['email_err'] = "You Entered An Invalid Email Format");
        }

        if ($this->findUserByEmail($data['email'])) {

            return ($data['email_err'] = 'email is already taken');
        }
        return ($data);
    }

    public function checkDisplayName($data)
    {
        if (empty($data['display_name']) || !isset($_POST['display_name'])) {
            return ($data['display_name_err'] = 'Please enter a display_name');
        } else if (strlen($data['display_name']) < '3' || strlen($data['display_name']) > '16') {
            return ($data['display_name_err'] = "Your displayName Must Contain more than 3 and 16 Characters!");
        }
        if ($this->findUserByDisplayName($data['display_name'])) {

            return ($data['dosplay_name_err'] = 'display name  already taken');
        }
        return ($data);
    }

    public function checkPassword($data)
    {
        if (empty($data['password']) || !isset($_POST['password'])) {
            return ($data['password_err'] = 'Please enter a password');
        } else {
            if (strlen($data['password']) < '6') {
                return ($data['password_err'] = "Password must be at least 6 caracters");
            } elseif (!preg_match("#[0-9]+#", $data['password'])) {
                return ($data['password_err'] = "Your Password Must Contain At Least 1 Number!");
            } elseif (!preg_match("#[A-Z]+#", $data['password'])) {
                return ($data['password_err'] = "Your Password Must Contain At Least 1 Capital Letter!");
            }
        }
        if (empty($data['confirm_password']) || !isset($data['confirm_password'])) {
            $data['confirm_password_err'] = 'Please confirm password';
        } else {
            if ($data['password'] != $data['confirm_password']) {
                $data['confirm_password_err'] = 'passwords do not match';
            }
        }
        if ($data['password_err'] == '' && $data['confirm_password_err'] == '')
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        return ($data);
    }
    //Benbraitit1993*
    public function sendConfirmationEmail($data)
    {
        $login = $data['display_name'];
        $data['cle'] = $cle = md5(microtime(true) * 100000);

        $to = $data['email'];
        $subject = "Activer votre compte";
        $message = 'Hello ' . $data['display_name'] . '! ,
 
                Thanks for registering.

                to Activate ur account click on the link bellow or just copy/past in your browser.
                 
                http://10.11.8.2/camagru/activation.php?log=' . urlencode($login) . '&cle=' . urlencode($cle) . '
                 
                Ceci est un mail automatique, Merci de ne pas y répondre.';

        $from = "khimya@camagru.com";
        $headers = "MIME-Version: 1.0" . "\n";
        $headers .= "Content-type:text/html;charset=iso-8859-1" . "\n";
        $headers .= "From: $from" . "\n";
        mail($to, $subject, $message, $headers);
        die("success");
        return ($data);
    }

    public function findUserByEmail($email)
    {
        $this->db->query('SELECT * FROM users WHERE email = :email');
        $this->db->bind(':email', $email);
        $row = $this->db->single();
        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function findUserByDisplayName($display_name)
    {
        $this->db->query('SELECT * FROM users WHERE display_name = :display_name');
        $this->db->bind(':display_name', $display_name);
        $row = $this->db->single();

        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getUserById($id)
    {
        $this->db->query('SELECT * FROM users WHERE id = :id');
        $this->db->bind(':id', $id);
        $row = $this->db->single();
        return $row;
    }
}
