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

            $cle = md5(microtime(TRUE) * 100000);

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = ['display_name' => trim($_POST['display_name']), 'email' => trim($_POST['email']), 'password' => $_POST['password'], 'confirm_password' => $_POST['confirm_password'],  'display_name_err' => '', 'email_err' => '', 'password_err' => '', 'confirm_password_err' => '',];


            $data = $this->userModel->checkEmail($data);
            $data = $this->userModel->checkDisplayName($data);
            $data = $this->userModel->checkPassword($data);

            //make sure errers are empty
            if (empty($data['email_err']) && empty($data['display_name_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])) {

                $data = $this->userModel->sendConfirmationEmail($data);

                if ($this->userModel->register($data)) {
                    redirect('users/login');
                } else {
                    redirect('pages/error');
                }
            } else {
                // Load view with the errors
                $this->view('users/register', $data);
            }
        } else {
            //init data
            $data = ['display_name' => '', 'email' => '', 'password' => '', 'confirm_password' => '', 'cle' => '', 'display_name_err' => '', 'email_err' => '', 'password_err' => '', 'confirm_password_err' => '',];
            // loead he view
            $this->view('users/register', $data);
        }
    }



    /////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function activation()
    {
        // $data = [
        //     'cle' => trim($_GET['cle']),
        //         'cle_err' => '',
        // ];
        $url = $_GET['url'];
        $path = explode("/", $url); // splitting the path
        $data['cle'] = end($path);
        // var_dump($cle);
        if (empty($data['cle']) || !isset($data['cle'])) {
            $data['cle_err'] = 'wrong verification link';
            redirect('users/register');
        }
        if ($this->userModel->findUserBykey($data['cle']) && empty($data['cle_err'])) {
            //user found
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
        //check for post
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // process the form
            // sanitize POSTE data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            //init data
            $data = [
                'display_name' => trim($_POST['display_name']),
                'password' => trim($_POST['password']),
                'display_name_err' => '',
                'password_err' => '',
            ];
            //validate email
            if (empty($data['display_name'])) {
                $data['display_name_err'] = 'Please enter ur display name';
            }

            // validate password
            if (empty($data['password'])) {
                $data['password_err'] = 'Please enter password';
            }
            //check for user /displayname
            if ($this->userModel->findUserByDisplayName($data['display_name'])) {
                //user found
            } else {
                //user not found
                $data['display_name_err'] = 'No user found';
            }
            // check if errors are empty
            if (empty($data['display_name_err']) && empty($data['password_err'])) {
                //validated
                //check and set logged in user
                $loggedInUser = $this->userModel->login($data['display_name'], $data['password']);

                if ($loggedInUser) {
                    //create Session
                    $this->createUserSession($loggedInUser);
                } else {
                    $data['password_err'] = 'password incorrect or account not activated';

                    $this->view('users/login', $data);
                }
            } else {
                // Load error view
                $this->view('users/login', $data);
            }
        } else {
            // Init data
            $data = [
                'display_name' => '',
                'password' => '',
                'display_name_err' => '',
                'password_err' => '',
            ];

            // Load view
            $this->view('users/login', $data);
        }
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function createUserSession($user)
    {
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_email'] = $user->email;
        $_SESSION['user_name'] = $user->name;
        redirect('posts');
    }

    /////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function logout()
    {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_name']);
        session_destroy();
        redirect('users/login');
    }


    public function recover()
    {
        //check for post
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // process the form
            // sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            //init data
            $data = [
                'email' => trim($_POST['email']),
                'email_err' => '',
            ];
            //validate email
            //Benbraitit1993*
            if (empty($data['email'])) {
                $data['email_err'] = 'Please enter email';
            } else if (!empty($data['email']) && !preg_match("/([\w\-]{3,}\@[\w\-]{3,9}\.[\w\-]{2,3})/", $data['email'])) {
                $data['email_err'] = "You Entered An Invalid Email Format";
            }
            //check email existanse 
            else if (is_string($data['email'])) {
                if (!$this->userModel->findUserByEmail($data['email'])) {

                    $data['email_err'] = 'email not found';
                }
            }
            //make sure errers are empty
            if (empty($data['email_err'])) {
                //if the form is valide do this :
                /////////////
                ////////////
                ///////////
                //send rest password link pfff

                if ($this->userModel->recover($data)) {
                    redirect('users/login');
                } else {
                    var_dump("erreur on usermodel recover");
                }
            } else {
                // Load view with the errors
                $this->view('users/recover', $data);
            }
        } else {
            //init data
            $data = [
                'email' => '',
                'email_err' => '',
            ];
            // loead the view
            $this->view('users/recover', $data);
        }
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function setting()
    {
        //check for post
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // process the form
            // sanitize POSTE data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            //init data
            $data = [
                'display_name' => trim($_POST['display_name']),
                'email' => trim($_POST('email')),
                'password' => trim($_POST['password']),
                'new_password' => trim($_POST['new_password']),
                'confirmNewPassword' => trim($_POST['confirmNewPassword']),
                'display_name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => '',
                'new_password_err' => ''
            ];



            //validate email
            if (isset($data['display_name'])) {
                if (strlen($data['display_name']) < '3' || $_SESSION['display_name'] == $data['display_name']) {
                    $data['display_name_err'] = "display name must be longer than 3 and different than current one";
                }
            }
            if (isset($data['email'])) {
                if (strlen($data['display_name']) < '3' || $_SESSION['display_name'] == $data['display_name']) {
                    $data['display_name_err'] = "display name must be longer than 3 and different than current one";
                }
            }
            // validate password
            if (isset($data['password'])) {
                if ($data['password'] != $_SESSION['password'])
                    $data['password_err'] = 'Please enter ur current password !';
            }
            //check for user /displayname

        }
    }
}
