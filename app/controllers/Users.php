<?php
class Users extends Controller
{
    public function __construct()
    {
        $this->userModel = $this->model('User');
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = ['display_name' => trim($_POST['display_name']), 'email' => trim($_POST['email']), 'password' => $_POST['password'], 'confirm_password' => $_POST['confirm_password'],  'display_name_err' => '', 'email_err' => '', 'password_err' => '', 'confirm_password_err' => '',];
            $data = $this->userModel->checkEmail($data);
            $data = $this->userModel->checkDisplayName($data);
            $data = $this->userModel->checkPassword($data);
            if (empty($data['email_err']) && empty($data['display_name_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])) {
                $data = $this->userModel->sendConfirmationEmail($data);
                if ($this->userModel->register($data)) {
                    redirect('users/login');
                } else {
                    redirect('pages/error');
                }
            } else {
                $this->view('users/register', $data);
            }
        } else {
            $data = ['display_name' => '', 'email' => '', 'password' => '', 'confirm_password' => '', 'cle' => '', 'display_name_err' => '', 'email_err' => '', 'password_err' => '', 'confirm_password_err' => '',];
            $this->view('users/register', $data);
        }
    }

    public function activation()
    {
        $url = $_GET['url'];
        $path = explode("/", $url);
        $data['cle'] = end($path);

        if (empty($data['cle']) || !isset($data['cle'])) {
            $data['cle_err'] = 'wrong verification link';
            redirect('users/register');
        }
        if ($this->userModel->findUserBykey($data['cle']) && empty($data['cle_err'])) {
            if ($this->userModel->activate($data['cle'])) {

                redirect('users/login');
            } else {
                redirect('pages/error');
            }
        } else {
            redirect('users/register');
        }
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = ['display_name' => trim($_POST['display_name']), 'password' => trim($_POST['password']), 'display_name_err' => '', 'password_err' => '',];

            if (empty($data['display_name']) || !isset($data['display_name'])) {
                $data['display_name_err'] = 'Please enter ur display name';
            }
            if (empty($data['password']) || !isset($data['password'])) {
                $data['password_err'] = 'Please enter password';
            }
            if ($this->userModel->findUserByDisplayName($data['display_name'])) {
            } else {
                $data['display_name_err'] = 'No user found';
            }
            if (empty($data['display_name_err']) && empty($data['password_err'])) {
                $loggedInUser = $this->userModel->login($data['display_name'], $data['password']);
                if ($loggedInUser) {
                    $this->createUserSession($loggedInUser);
                } else {
                    $data['password_err'] = 'password incorrect or account not activated';
                    $this->view('users/login', $data);
                }
            } else {
                $this->view('users/login', $data);
            }
        } else {
            $data = ['display_name' => '', 'password' => '', 'display_name_err' => '', 'password_err' => '',];
            $this->view('users/login', $data);
        }
    }

    public function createUserSession($user)
    {
        $_SESSION['user_id'] = $user->id;
        $_SESSION['display_name'] = $user->display_name;
        redirect('posts');
    }

    public function logout()
    {
        unset($_SESSION['user_id']);
        unset($_SESSION['display_name']);
        session_destroy();
        redirect('users/login');
    }

    public function recover()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_EMAIL);

            $data = ['email' => trim($_POST['email']), 'email_err' => '',];
            if (empty($data['email']) || !isset($data['email'])) {
                $data['email_err'] = 'Please enter email';
            } else if (!empty($data['email']) && is_string($data['email'])) {
                if ($this->userModel->findUserByEmail($data['email']) && empty($data['email_err'])) {
                    $randomPassword = bin2hex(random_bytes(10));
                    if ($this->userModel->recover($randomPassword))
                    {
                        $this->userModel->sendRecoveryEmail($data,$randomPassword);
                        die("SUCCESS RECOVER");
                        var_dump($randomPassword);
                    }
                    else
                    {
                        redirect('page/error');
                    }
                        
                }
                else
                {
                    $data['email_err'] = ' no user registred with this email';
                    $this->view('users/recover', $data);
                }


            } 
            
            } 
            else {
                $data = ['email' => '', 'email_err' => '',];
                $this->view('users/recover', $data);
            }
    }

    // public function setting()
    // {
    //     //check for post
    //     if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //         // process the form
    //         // sanitize POSTE data
    //         $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    //         //init data
    //         $data = [
    //             'display_name' => trim($_POST['display_name']),
    //             'email' => trim($_POST('email')),
    //             'password' => trim($_POST['password']),
    //             'new_password' => trim($_POST['new_password']),
    //             'confirmNewPassword' => trim($_POST['confirmNewPassword']),
    //             'display_name_err' => '',
    //             'email_err' => '',
    //             'password_err' => '',
    //             'confirm_password_err' => '',
    //             'new_password_err' => ''
    //         ];



    //         //validate email
    //         if (isset($data['display_name'])) {
    //             if (strlen($data['display_name']) < '3' || $_SESSION['display_name'] == $data['display_name']) {
    //                 $data['display_name_err'] = "display name must be longer than 3 and different than current one";
    //             }
    //         }
    //         if (isset($data['email'])) {
    //             if (strlen($data['display_name']) < '3' || $_SESSION['display_name'] == $data['display_name']) {
    //                 $data['display_name_err'] = "display name must be longer than 3 and different than current one";
    //             }
    //         }
    //         // validate password
    //         if (isset($data['password'])) {
    //             if ($data['password'] != $_SESSION['password'])
    //                 $data['password_err'] = 'Please enter ur current password !';
    //         }
    //         //check for user /displayname

    //     }
    // }
}
