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
        $page = (!empty($_GET['page']) ? $_GET['page'] : 1);
        $posts = $this->postModel->getPosts($page);
        $data = [
            'page' => $page,
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
                return (redirect('posts'));
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
                            if ($this->userModel->checkNotificationForCmnt($id) == 1) {
                                $email =  $this->postModel->getNotifiedEmail($id);
                                if ($email != NULL) {
                                    $this->userModel->notificationMessage($email);
                                }
                            }
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
        error_log(print_r("-------------------------", 1));
        // error_log(print_r("adddddd",1));
        if (!isLoggedIn()) {
            return (redirect('users/login'));
        }
        $posts = $this->postModel->getmyposts();
        $posts =  array_reverse($posts);
        $post_id = $this->postModel->galerietrick();
        $post_id =  array_reverse($post_id);

        $i = 0;
        foreach ($posts as $post) {
            $post->id = $post_id[$i++]->id;
        }
        $data = ['title' => '', 'image' => '', 'posts' => $posts, 'user_id' => $_SESSION['user_id']];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            error_log(print_r("ddddddddddddddddddd", 1));
            // die(var_dump($_POST));
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = $this->postModel->checkadd($data);
            $imgthing = $this->postModel->saveImage($data, $_POST["num-fil"]);
            if ($this->postModel->addPost($data, $imgthing)) {
                return (redirect('posts/add'));
            } else {
                return (redirect('pages/error'));
            }
        }
        $this->view('posts/add', $data);
    }

    public function upload()
    {
        if (!isLoggedIn()) {
            return (redirect('users/login'));
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = ['title' => '', 'image' => ''];
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = $this->postModel->checkUpload($data);

            $imgthing = $this->postModel->saveImage($data, $_POST["num-fill"]);
            if ($this->postModel->addUpload($data, $imgthing)) {
                return (redirect('posts/add'));
            } else {
                die("error in add upload");
                return (redirect('pages/error'));
            }
        }
        $this->view('posts/add', $data);
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
                $post = $post[0];
                // die(var_dump($post));
                if ($post->user_id != $_SESSION['user_id']) {
                    return (redirect('posts'));
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
        $post = $post[0];
        $user = $this->userModel->getUserById($post->user_id);
        $data = [
            'post' => $post,
            'user' => $user,
            'cmnt' => $cmnt,
        ];
        $this->view('posts/show', $data);
    }
}
