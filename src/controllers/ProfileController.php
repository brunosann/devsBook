<?php

namespace src\controllers;

use \core\Controller;
use \src\handlers\UserHandler;
use \src\handlers\PostHandler;

class ProfileController extends Controller
{
  private $loggedUser;

  public function __construct()
  {
    $this->loggedUser = UserHandler::checkLogin();
    if (!$this->loggedUser) return $this->redirect('/login');
  }

  public function index($params = [])
  {
    $id = $this->loggedUser->id;

    if (!empty($params['id'])) $id = $params['id'];

    $user = UserHandler::getUser($id);

    if (!$user) return $this->redirect('/');

    $this->render('profile', ['loggedUser' => $this->loggedUser, 'user' => $user]);
  }
}
