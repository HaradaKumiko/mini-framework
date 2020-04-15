<?php

class HomeController extends Controller{

  // public function index(){
  //   return $this->view('home');
  // }

  public function index(){
    return $this->view('home');
  }

  public function getusers(){
   $user = $this->model('User')->index();
   return $this->view('users', ['users' => $user]);
  }

}

 ?>
