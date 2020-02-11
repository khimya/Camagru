<?php
class Posts extends Controller
{
    public function __construct()
    {
        $this->postModel = $this->model('Post');
        $this->userModel = $this->model('User');
    }

    public function index()
    {
        $posts = $this->postModel->getPosts();
        $data = [
            'posts' => $posts
        ];
        $this->view('posts/index', $data);
    }

    public function me()
    {
        $posts = $this->postModel->getmyposts();
        $data = [
            'posts' => $posts
        ];
        $this->view('posts/me', $data);
    }

    public function snitch($user_id)
    {
        $posts = $this->postModel->getsnitching($user_id);
        $data = [
            'posts' => $posts
        ];
        $this->view('posts/snitch', $data);
    }

    public function add()
    {
        if (!isLoggedIn()) {
            redirect('users/login');
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = ['title' => trim($_POST['title']), 'image' => $_POST['image'], 'user_id' => $_SESSION['user_id'], 'title_err' => '', 'image_err' => ''];
            if (empty($data['title'])) {
                $data['title_err'] = 'Please enter a title';
            }
            if (empty($data['image'])) {
                $data['image_err'] = 'There is an error please try again';
            }
            //make sure there is no error
            if (empty($data['title_err']) && empty($data['image_err'])) {
                //validated posts
                if ($this->postModel->addPost($data)) {
                    flash('post_message', 'Post Added'); ///
                    redirect('posts');
                } else {
                    redirect('pages/error');
                }
            } else {
                //load view with errors
                $this->view('posts/add', $data);
            }
        } else {
            $data = [
                'title' => '',
                'image' => ''

            ];
            $this->view('posts/add', $data);
        }
    }

    public function delete($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Get existing post from model
            $post = $this->postModel->getPostById($id);
            // Check for owner
            if ($post->user_id != $_SESSION['user_id']) {
                redirect('posts');
            }

            if ($this->postModel->deletePost($id)) {
                redirect('posts');
            } else {
                redirect('posts');
            }
        } else {
            redirect('posts');
        }
    }

    
    public function show($id)
    {
        $post = $this->postModel->getPostById($id);
        $user = $this->userModel->getUserById($post->user_id);
        
        $data = [
            'post' => $post,
            'user' => $user
        ];
        $this->view('posts/show', $data);
    }
}
