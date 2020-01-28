<?php
class Posts extends Controller
{
    public function __construct()
    {
        $this->postModel = $this->model('Post');
        $this->userModel = $this->model('User');
    }
    /////index of posts
    public function index()
    {
        ///get posts
        $posts = $this->postModel->getPosts();
        $data = [
            'posts' => $posts
        ];
        $this->view('posts/index', $data);
    }
    public function me()
    {
        ///get posts
        $posts = $this->postModel->getmyposts();
        $data = [
            'posts' => $posts
        ];
        $this->view('posts/me', $data);
    }
    public function snitch($user_id)
    {
        // die("SNITCH WORKING");
        ///get posts
        $posts = $this->postModel->getsnitching($user_id);
        //die(var_dump($posts));
        $data = [
            'posts' => $posts
        ];
        $this->view('posts/snitch', $data);
    }
    //         if (!$success) {
    //             exit(json_encode(['success' => false, 'reason' => 'the server failed in creating the image']));
    //         }
    //         // $folder = "img";
    //         // Inform the browser about the path to the newly created image
    //     // }     exit(json_encode(['success' => true, 'path' => "$folder$filename"]));
    //     }
    // }
    public function add()
    {
        $var = 90;
        if (!isLoggedIn()) {
            redirect('users/login');
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            //sinatise the post arrray
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $destinationFolder = $folder = "./../../public/img/";
            $maxFileSize = 2 * 1024 * 1024;
            $postdata = file_get_contents("php://input");
            if (!isset($postdata) || empty($postdata)) {
                            exit(json_encode(["success" => false, "reason" => "Not a post data"]));
                        }
            $request = json_decode($postdata);
            
            // Validate
            if (trim($request->data) === "") {
                exit(json_encode(["success" => false, "reason" => "Not a post data"]));
            }
                    $file = $request->data;
            
            // getimagesize is used to get the file extension
            // Only png / jpg mime types are allowed
            $size = getimagesize($file);
            $ext = $size['mime'];
            if ($ext == 'image/jpeg') {
                $ext = '.jpg';
            } elseif ($ext == 'image/png') {
                $ext = '.png';
            } else {
                exit(json_encode(['success' => false, 'reason' => 'only png and jpg mime types are allowed']));
            }
            if (strlen(base64_decode($file)) > $maxFileSize) {
                            exit(json_encode(['success' => false, 'reason' => "file size exceeds {$maxFileSize} Mb"]));
                        }
                        $img = str_replace('data:image/png;base64,', '', $file);
                                $img = str_replace('data:image/jpeg;base64,', '', $img);
                                $img = str_replace(' ', '+', $img);
                                
                                $img = base64_decode($img);
                                $filename = date("d_m_Y_H_i_s") . "-" . time() . $ext;
                                $destinationPath = "$destinationFolder$filename";
                                $success = file_put_contents($destinationPath, $img);
            
                                if (!$success) {
                                                exit(json_encode(['success' => false, 'reason' => 'the server failed in creating the image']));
                                            }
                                    exit(json_encode(['success' => true, 'path' => "$folder . $filename"]));
            
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
            if (strlen($data['title']) > $var) {
                $data['title_err'] = 'Try a shorter title please';
            }
            if (empty($data['image'])) {
                $data['image_err'] = 'There is an error please try again';
            }
            //make sure there is no error
            if (empty($data['title_err']) && empty($data['image_err'])) {
                //validated posts
                if ($this->postModel->addPost($data)) {
                    redirect('posts');
                } else {
                    redirect('pages/about');
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

    public function delete($id){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
          // Get existing post from model
          $post = $this->postModel->getPostById($id);
          
          // Check for owner
          if($post->user_id != $_SESSION['user_id']){
            redirect('posts');
          }
  
          if($this->postModel->deletePost($id)){
            redirect('posts');
          } else {
            redirect('posts');
          }
        } else {
          redirect('posts');
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
    public function show($id){
        $post = $this->postModel->getPostById($id);
        $user = $this->userModel->getUserById($post->user_id);
  
        $data = [
          'post' => $post,
          'user' => $user
        ];
  
        $this->view('posts/show', $data);
      }
}
