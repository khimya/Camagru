<?php
class User
{
    private $db;

    public function  __construct()
    {
        $this->db = new Database;
    }

    public function register($data)
    {

        $this->db->query('INSERT INTO users (display_name, email, password, cle) VALUES(:display_name, :email, :password, :cle)');

        $this->db->bind(':display_name', $data['display_name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']);
        $this->db->bind(':cle', $data['cle']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function login($display_name, $password)
    {
        $this->db->query('SELECT * FROM users WHERE display_name = :display_name AND actif = 1');
        $this->db->bind(':display_name', $display_name);

        $row = $this->db->single();
        if($row)
        $hashed_password = $row->password;
        if ($hashed_password && password_verify($password, $hashed_password)) {
            return $row;
        } else {
            return false;
        }
    }

    public function recover($data)
    {
        $data['recoverPassword'] = password_hash($data['recoverPassword'], PASSWORD_DEFAULT);
        $this->db->query('UPDATE users SET password = :recoverPassword WHERE email = :email');
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':recoverPassword', $data['recoverPassword']);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function checkEmail($data)
    {

        if (empty($data['email']) || !isset($data['email'])) {
            $data['email_err'] = 'Please enter email';
        }
        if (!empty($data['email']) && !preg_match("/^[a-zA-Z0-9.!#$%&’*+\=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/", $data['email'])) {
            $data['email_err'] = "You Entered An Invalid Email Format";
        }

        if ($this->findUserByEmail($data['email'])) {

            $data['email_err'] = 'email is already taken';
        }
        return ($data);
    }

    public function checkDisplayName($data)
    {
        if (!preg_match('/^[A-Za-z][A-Za-z0-9]{5,31}$/', $data['display_name']))
            $data['display_name_err'] = "Your displayName is not valide!";

        if (strlen($data['display_name']) < '3' || strlen($data['display_name']) > '25') {
            $data['display_name_err'] = "Your displayName Must Contain more than 3 and 25 Characters!";
        }
        if ($this->findUserByDisplayName($data['display_name'])) {
            $data['display_name_err'] = 'display name  already taken';
        }
        return ($data);
    }

    public function disableNotifications($data)
    {
        $this->db->query('UPDATE users SET notification = 0  WHERE id = :user_id');
        $this->db->bind(':user_id', $data);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function enableNotifications($data)
    {
        $this->db->query('UPDATE users SET notification = 1  WHERE id = :user_id');
        $this->db->bind(':user_id', $data);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function checkNotification($data)
    {
        if (!isLoggedIn()) {
            return(redirect('users/login'));
        }
        $this->db->query('SELECT notification FROM users WHERE id = :id');
        $this->db->bind(':id', $data);
            $notification = $this->db->resultSet();
            $notification = array_shift($notification);
            $notification_value = $notification->notification;
            if ($notification_value == 1)
                return ("ON");
                else
                return ("OFF");
    }
 
    public function checkNotificationForCmnt($id)
    {
        if (!isLoggedIn()) {
            return(redirect('users/login'));
        }
        $this->db->query('SELECT user_id FROM posts WHERE id = :id');
        $this->db->bind(':id', $id);
        $user_id = $this->db->resultSet();
        $user_id = array_shift($user_id);
        $user_id = $user_id->user_id;
        $this->db->query('SELECT notification FROM users WHERE id = :id');
        $this->db->bind(':id', $user_id);
        $notification = $this->db->resultSet();
        $notification = array_shift($notification);
        $notification_value = $notification->notification;
        if($notification_value == 1)
        return(1);
        else if ($notification_value == 0)
        return(0);

    }
    
    public function checkPassword($data)
    {

        if (empty($data['password']) || !isset($_POST['password'])) {
            $data['password_err'] = 'Please enter a password';
        } else {
            if (strlen($data['password']) < '6') {
                $data['password_err'] = "Password must be at least 6 caracters";
            } elseif (!preg_match("#[0-9]+#", $data['password'])) {
                $data['password_err'] = "Your Password Must Contain At Least 1 Number!";
            } elseif (!preg_match("#[A-Z]+#", $data['password'])) {
                $data['password_err'] = "Your Password Must Contain At Least 1 Capital Letter!";
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
        $data['confirm_password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        return ($data);
    }

    public function checkChangePassword($data)
    {

        if (isset($data['newPassword']) && isset($data['currentPassword']) && isset($data['confirmNewPassword'])) {
            if (empty($data['currentPassword']) || !isset($data['currentPassword'])) {
                $data['currentPassword_err'] = 'Please enter a password';
            }
            if (empty($data['newPassword']) || !isset($data['newPassword'])) {
                $data['newPassword_err'] = 'Please enter a password';
            }
            $x = strlen($data['newPassword']);
            if ($x < 6) {
                $data['newPassword_err'] = "Password must be at least 6 caracters";
            }
            if (!preg_match("#[0-9]+#", $data['newPassword']) || !preg_match("#[A-Z]+#", $data['newPassword'])) {
                $data['newPassword_err'] = "Password Must Contain At Least 1 Number Contain At Least 1 Capital Letter!";
            }
            if (empty($data['confirmNewPassword']) || !isset($data['confirmNewPassword'])) {
                $data['confirmNewPassword_err'] = 'Please confirm password';
            }
            if ($data['newPassword'] != $data['confirmNewPassword']) {
                $data['newPassword_err'] = "new password and confirm new password are different";
            }
        }
        return ($data);
    }

    public function newEmail($data)
    {
        $this->db->query('UPDATE users SET email = :email  WHERE id = :user_id');
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':user_id', $_SESSION['user_id']);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function sendConfirmationNewEmail($data)
    {
        $login = $_SESSION['display_name'];
        $to = $data['email'];
        $subject = "Notification About New Email Adress";
        $message = 'Hello ' . $login . '! ,
 
                Your profil <' .  $login . ' > Email has been changed to this adress.  ' . $data['email'] .

            '    This message is just an alert
                 
                Ceci est un mail automatique, Merci de ne pas y répondre.';

        $from = "khimya@camagru.com";
        $headers = "MIME-Version: 1.0" . "\n";
        $headers .= "Content-type:text/html;charset=iso-8859-1" . "\n";
        $headers .= "From: $from" . "\n";
        mail($to, $subject, $message, $headers);
    }

    public function newDisplayName($data)
    {

        $this->db->query('UPDATE users SET display_name = :display_name  WHERE id = :user_id');
        $this->db->bind(':display_name', $data['display_name']);
        $this->db->bind(':user_id', $_SESSION['user_id']);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function newPassword($data)
    {
        $data['newPassword'] = password_hash($data['newPassword'], PASSWORD_DEFAULT);

        $this->db->query('UPDATE users SET password = :newPassword  WHERE id = :user_id');
        $this->db->bind(':newPassword', $data['newPassword']);
        $this->db->bind(':user_id', $_SESSION['user_id']);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function sendConfirmationEmail($data)
    {
        $login = $data['display_name'];
        $data['cle'] = $cle = md5(microtime(true) * 100000);

        $to = $data['email'];
        $subject = "Activer votre compte";
        $message = 'Hello ' . $login . '! ,
 
                Thanks for registering.

                to Activate ur account click on the link bellow or just copy/past in your browser.
                 
                http://localhost/camagru/users/activation/cle/' . urlencode($cle) . '
                 
                Ceci est un mail automatique, Merci de ne pas y répondre.';

        $from = "khimya@camagru.com";
        $headers = "MIME-Version: 1.0" . "\n";
        $headers .= "Content-type:text/html;charset=iso-8859-1" . "\n";
        $headers .= "From: $from" . "\n";
        mail($to, $subject, $message, $headers);

        return ($data);
    }

    public function sendRecoveryEmail($data)
    {
        $login = $data['email'];

        $to = $login;
        $subject = "Password Recover";
        $message = 'Hello ' . $login . '! ,
 
                This is your temerary password : Dont forget to change it at the setting Menu for security Raisons  <br>'



            . urlencode($data['recoverPassword']) .



            '<br>  Ceci est un mail automatique, Merci de ne pas y répondre.';

        $from = "khimya@camagru.com";
        $headers = "MIME-Version: 1.0" . "\n";
        $headers .= "Content-type:text/html;charset=iso-8859-1" . "\n";
        $headers .= "From: $from" . "\n";
        mail($to, $subject, $message, $headers);
    }

    public function notificationMessage($email)
    {
        $login = $email;

        $to = $email;
        $subject = "Notification Message";
        $message = 'Hello ' . $login . '! ,
 
                You got a new comment in your post go check it out , if you want to disable this future , you can do it in ur profil setting .
                Ceci est un mail automatique, Merci de ne pas y répondre.';

        $from = "khimya@camagru.com";
        $headers = "MIME-Version: 1.0" . "\n";
        $headers .= "Content-type:text/html;charset=iso-8859-1" . "\n";
        $headers .= "From: $from" . "\n";
        mail($to, $subject, $message, $headers);
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

    public function findUserBykey($cle)
    {
        $this->db->query('SELECT * FROM users WHERE cle = :cle AND actif = 0');
        $this->db->bind(':cle', $cle);
        $row = $this->db->single();

        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }


    public function activate($cle)
    {
        $this->db->query('UPDATE users SET actif = 1 WHERE cle = :cle AND actif = 0');
        $this->db->bind(':cle', $cle);
        if ($this->db->execute()) {
            return true;
        } else {

            return false;
        }
    }

    public function findUserByDisplayName($data)
    {
        $this->db->query('SELECT * FROM users WHERE display_name = :display_name');
        $this->db->bind(':display_name', $data);
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
