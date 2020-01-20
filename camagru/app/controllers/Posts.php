<?php
class Posts extends Controller
{
    public function __construct()
    {
        //////////////////////////
        //////////////////////////
        /////i must remove this//
        /////if i want to see////
        // post even if not//////
        ///// loged in//////////
        /////////////////////////
        ///post model and display video//


        $this->postModel = $this->model('Post');
        $this->userModel = $this->model('User');
    }
    public function index()
    {
        ///get posts
        $posts = $this->postModel->getPosts();
        $data = [
            'posts' => $posts
        ];
        $this->view('posts/index', $data);
    }

    public function add()
    {
        if (!isLoggedIn()) {
            redirect('users/login');
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            //sinatise the post arrray
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'title' => trim($_POST['title']),
                'image' => $_POST['image'],
                'user_id' => $_SESSION['user_id'],
                'title_err' => '',
                'image_err' => ''
            ];
            //validate data
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
                    flash('post_message', 'Post Added');///
                    redirect('posts');
                } else {
                    die('something went wrong');
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

    //edit function
    // public function edit($id)
    // {
    //     if (!isLoggedIn()) {
    //         redirect('users/login');
    //     }
    //     if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //         //sinatise the post arrray
    //         $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    //         $data = [
    //             'id' => $id,
    //             'title' => trim($_POST['title']),
    //             'body' => trim($_POST['body']),
    //             'user_id' => $_SESSION['user_id'],
    //             'title_err' => '',
    //             'body_err' => ''
    //         ];
    //         //validate data
    //         if (empty($data['title'])) {
    //             $data['title_err'] = 'Please enter a title';
    //         }
    //         if (empty($data['body'])) {
    //             $data['body_err'] = 'Please enter Body';
    //         }
    //         //make sure there is no error
    //         if (empty($data['title_err']) && empty($data['body_err'])) {
    //             //validated posts
    //             if ($this->postModel->updatePost($data)) {
    //                 redirect('posts');
    //             } else {
    //                 die('something went wrong');
    //             }
    //         } else {
    //             //load view with errors
    //             $this->view('posts/edit', $data);
    //         }
    //     } else {
    //         //get existant post from model
    //         $post = $this->postModel->getPostById($id);
    //         //check for owner
    //         if ($post->user_id != $_SESSION['user_id']) {
    //             redirect('posts');
    //         }
    //         $data = [
    //             'id' => $id,
    //             'title' => $post->title,
    //             'body' => $post->body
    //         ];
    //         $this->view('posts/edit', $data);
    //     }
    // }
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
