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
					$data['recover'] = md5(microtime(true) * 100000);

					if ($this->userModel->recover($data)) {

						$this->userModel->sendRecoveryEmail($data);
						redirect('users/login');
					} else {
						$data['email_err'] = ' no user registred with this email';
						redirect('page/recover');
					}
				} else {
					$data['email_err'] = ' no user registred with this email';
					$this->view('users/recover', $data);
				}
			}
		} else {
			$data = ['email' => '', 'email_err' => '',];
			$this->view('users/recover', $data);
		}
	}

	public function setting()
	{
		//check for post
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			// process the form
			// sanitize POSTE data
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
			//init data
			$data = ['display_name' => trim($_POST['display_name']), 'email' => trim($_POST('email')), 'currentPassword' => $_POST['currentPassword'], 'newPassword' => $_POST['newPassword'], 'confirmNewPassword' => $_POST['confirmNewPassword'], 'display_name_err' => '', 'email_err' => '', 'currentPassword_err' => '', 'newPassword_err' => '', 'confirmNewPassword_err' => ''];

			if (isset($data['email']))
				$data = $this->userModel->checkEmail($data);
			if (isset($data['display_name']))
				$data = $this->userModel->checkDisplayName($data);
			if (isset($data['currentPassword']) || isset($data['newPassword']) || isset($data['confirmNewPassword']))
				$data = $this->userModel->checkChangePassword($data);

			if ($data['currentPassword_err'] == '' && $data['newPassword_err'] == '' && $data['confirmNewPassword_err'] == '')
			{
				$data = $this->userModel->newSettings($data);
			}
			//validate email
		
			//check for user /displayname

		}
	}
}
