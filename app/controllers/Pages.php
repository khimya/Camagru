<?php
class Pages extends Controller
{
  public function __construct()
  {
  }

  // public function index()
  // {
  //   if (isLoggedIn()){
  //     redirect('posts');
  //   }
  //   $data = [
  //     'title' => 'camagru',
  //     'description' => 'Simple social picture sharing network built on the TraversyMVC PHP framework'
  //   ];

  //   $this->view('pages/index', $data);
  // }

  public function about()
  {
    $data = [
      'title' => 'About Us',
      'description' => 'Simple App to share posts of pictures with filters with others users'
    ];

    $this->view('pages/about', $data);
  }
}
