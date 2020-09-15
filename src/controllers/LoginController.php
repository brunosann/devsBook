<?php

namespace src\controllers;

use \core\Controller;
use \src\handlers\UserHandler;

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
      $token = UserHandler::loginVerif($email, $password);

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
    $data = [];

    if (!empty($_SESSION['flash'])) {
      $data['flash'] = $_SESSION['flash'];
      $_SESSION['flash'] = '';
    }

    $this->render('signup', $data);
  }

  public function signupAction()
  {
    $name = filter_input(INPUT_POST, 'name');
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $password = filter_input(INPUT_POST, 'password');
    $birthdate = filter_input(INPUT_POST, 'birthdate');;

    if ($name && $email && $password && $birthdate) {
      $date = explode('-', $birthdate);
      if (count($date) != 3 || $date[0] > date('Y') || !strtotime($birthdate)) {
        $_SESSION['flash'] = 'Data invalida!';
        return $this->redirect('/cadastro');
      }
    }

    if (UserHandler::existEmail($email)) {
      $_SESSION['flash'] = 'Email já cadastrado!';
      return $this->redirect('/cadastro');
    }

    $token = UserHandler::addUser($name, $email, $password, $birthdate);
    $_SESSION['token'] = $token;
    return $this->redirect('/');
  }
}
