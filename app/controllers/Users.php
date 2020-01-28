<?php
class Users extends Controller
{
    public function __construct()
    {
        $this->userModel = $this->model('User');
    }

    public function register()
    {
        //check for post
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //prepere key for confirmation email
            $cle = md5(microtime(TRUE) * 100000);
            // process the form
            // sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            //init data
            $data = [
                'display_name' => trim($_POST['display_name']),
                'email' => trim($_POST['email']),
                'password' => $_POST['password'],
                'confirm_password' => $_POST['confirm_password'],
                'cle' => $cle,
                'display_name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => '',
            ];
            //validate email
            //Benbraitit1993*
            if (empty($data['email'])) {
                $data['email_err'] = 'Please enter email';
            }
            if (!empty($data['email']) && !preg_match("/([\w\-]{3,}\@[\w\-]{3,9}\.[\w\-]{2,3})/", $data['email'])) {
                $data['email_err'] = "You Entered An Invalid Email Format";
            }
           
            if ($this->userModel->findUserByEmail($data['email'])) {

                $data['email_err'] = 'email is already taken';
            }
            //check email repitition

            //validate display_name
            if (empty($data['display_name'])) {
                $data['display_name_err'] = 'Please enter a display_name';
            } else if (strlen($data['display_name']) < '2') {
                $data['display_name_err'] = "Your displayName Must Contain Between 5 and 16 Characters!";
            }
            //validate password
            if (empty($data['password'])) {
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
            //validate confirm password
            if (empty($data['confirm_password'])) {
                $data['confirm_password_err'] = 'Please confirm password';
            } else {
                if ($data['password'] != $data['confirm_password']) {
                    $data['confirm_password_err'] = 'passwords do not match';
                }
            }
            $login = $data['display_name'];
            //make sure errers are empty
            if (empty($data['email_err']) && empty($data['display_name_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])) {
                //send confirmation email
                $to = $data['email'];
                $subject = "Activer votre compte";
                $message = 'Hello '.$data['display_name'] . '! ,
 
                Thanks for registering.

                to Activate ur account click on the link bellow or just copy/past in your browser.
                 
                http://10.11.8.2/camagru/activation.php?log='.urlencode($login).'&cle='.urlencode($cle).'
                 
                 
                ---------------
                Ceci est un mail automatique, Merci de ne pas y répondre.';
   
                            $from = "khimya@camagru.com";
   $headers = "MIME-Version: 1.0" . "\n";
   $headers .= "Content-type:text/html;charset=iso-8859-1" . "\n";
   $headers .= "From: $from" . "\n";
   
   // Send email
   mail($to,$subject,$message,$headers);
   //mail(to,subject,message,headers,parameters);
   
   // Inform the user
   echo "Thanks for registering! We have just sent you an email with your password.";
                //hash password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
                //register user
                if ($this->userModel->register($data)) {
                    redirect('users/login');
                } else {
                    var_dump("erreur N:1");
                }
            } else {
                // Load view with the errors
                $this->view('users/register', $data);
            }
        } else {
            //init data
            $data = [
                'display_name' => '',
                'email' => '',
                'password' => '',
                'confirm_password' => '',
                'cle' => '',
                'display_name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => '',
            ];
            // loead he view
            $this->view('users/register', $data);
        }
    }



    /////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////

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
                    $data['password_err'] = 'password incorrect';

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
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////

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
}
