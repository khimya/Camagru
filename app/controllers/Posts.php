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
    public function like($id)
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!isLoggedIn()) {
                return (redirect('users/login'));
            } else if (isLoggedIn()) {

                if ($this->postModel->checkLikes($id)) {

                    $this->postModel->removeLike($id);
                    $this->postModel->removeLikecount($id);
                } else {
                    $this->postModel->addLike($id);
                    $this->postModel->addLikecount($id);
                }
                redirect('posts');
            }
        }
    }
    public function cmnt($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!isLoggedIn()) {
                return (redirect('users/login'));
            } else if (isLoggedIn()) {
                if (isset($_POST['blabla']) && !empty($_POST['blabla']) && !is_array($_POST['blabla'])) {
                    $data['blabla'] = $_POST['blabla'];
                    if ($this->postModel->checkCmnt($data)) {
                        if ($this->postModel->addCmnt($data, $id)) {

                            if ($this->postModel->addCmntcount($id))
                                return (redirect('posts'));
                        } else
                            return (redirect('pages/error'));
                    } else
                        return (redirect('posts'));
                } else {
                    return (redirect('posts'));
                }
            }
        }
    }

    public function me()
    {
        $posts = $this->postModel->getmyposts();
        $data = [
            'posts' => $posts
        ];
        $data['posts'] =  array_reverse($data['posts']);
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
            return (redirect('users/login'));
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = ['title' => trim($_POST['title']), 'image' => $_POST['image'], 'user_id' => $_SESSION['user_id'], 'title_err' => '', 'image_err' => ''];
            if (empty($data['title']))
                $data['title_err'] = 'Please enter a title';
            if (empty($data['image']))
                $data['image_err'] = 'There is an error please try again';
            if (empty($data['title_err']) && empty($data['image_err'])) {
                $imgthing = $this->postModel->saveImage($data, $_POST["num-fil"]);
                if ($this->postModel->addPost($data, $imgthing)) {
                    redirect('posts');
                } else {
                    redirect('pages/error');
                }
            } else {
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
        if (!isLoggedIn()) {
            return (redirect('users/login'));
        } else {

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if (!is_numeric(($id)))
                    redirect('posts');
                $post = $this->postModel->getPostById($id);
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
    }

    public function show($id)
    {
        $post = $this->postModel->getPostById($id);
        $cmnt = $this->postModel->getCmntById($id);

        $user = $this->userModel->getUserById($post->user_id);

        $data = [
            'post' => $post,
            'user' => $user,
            'cmnt' => $cmnt
        ];
        $this->view('posts/show', $data);
    }
}
