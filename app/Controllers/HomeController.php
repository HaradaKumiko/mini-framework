<?php

class HomeController extends Controller{

  // public function index(){
  //   return $this->view('home');
  // }

  public function index(){
    $user = $this->model('User');
    return $this->view('home', [ 'nama' => $user->name]);  }

}

 ?>
