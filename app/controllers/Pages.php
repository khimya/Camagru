<?php
class Pages extends Controller
{
  public function __construct()
  {

  }
  public function about()
  {
    $data = [
      'title' => 'About Us',
      'description' => 'Simple App to share posts of pictures with filters with others users'
    ];

    $this->view('pages/about', $data);
  }
  // public function error()
  // {
  //   $data = [
  //     'title' => 'Error',
  //     'description' => 'You cantt access this page or it doesnt exist'
  //   ];

  //   $this->view('pages/about', $data);
  // }
}
