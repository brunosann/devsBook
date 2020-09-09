<?php

namespace src\controllers;

use \core\Controller;
use \src\handlers\LoginHandler;

class LoginController extends Controller
{
  public function signin()
  {
    $data = [];

    if (!empty($_SESSION['flash'])) {
      $data['flash'] = $_SESSION['flash'];
      $_SESSION['flash'] = '';
    }

    $this->render('signin', $data);
  }

  public function signinAction()
  {
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $password = filter_input(INPUT_POST, 'password');

    if ($email && $password) {
      $token = LoginHandler::loginVerif($email, $password);

      if ($token) {
        $_SESSION['token'] = $token;
        return $this->redirect('/');
      } else {
        $_SESSION['flash'] = 'E-mail e/ou senha não conferem.';
        return $this->redirect('/login');
      }
    } else {
      $_SESSION['flash'] = 'Preencha corretamente os campos.';
      return $this->redirect('/login');
    }
  }

  public function signup()
  {
    echo 'cadastro';
  }
}
