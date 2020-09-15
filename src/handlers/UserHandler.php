<?php

namespace src\handlers;

use \src\models\User;

class UserHandler
{
  public static function checkLogin()
  {
    if (!empty($_SESSION['token'])) {
      $token = $_SESSION['token'];
      $data = User::select()->where('token', $token)->one();

      if ($data) {
        $loggedUser = new User();
        $loggedUser->id = $data['id'];
        $loggedUser->avatar = ($data['avatar']);
        $loggedUser->name = ($data['name']);

        return $loggedUser;
      }
    }
    return false;
  }

  public static function loginVerif($email, $password)
  {
    $user = User::select()->where('email', $email)->one();

    if ($user) {
      if (password_verify($password, $user['password'])) {
        $token = md5(time() . rand(0, 9999) . time());

        User::update()->set('token', $token)->where('email', $email)->execute();

        return $token;
      }
    }
    return false;
  }

  public static function existEmail($email)
  {
    $user = User::select()->where('email', $email)->one();
    return $user ? true : false;
  }

  public static function getUser($id)
  {
    $data = User::select()->where('id', $id)->one();

    if ($data) {
      $user = new User();
      $user->id = $data['id'];
      $user->name = $data['name'];
      $user->birthdate = $data['birthdate'];
      $user->city = $data['city'];
      $user->work = $data['work'];
      $user->avatar = $data['avatar'];
      $user->cover = $data['cover'];

      return $user;
    }

    return false;
  }

  public static function addUser($name, $email, $password, $birthdate)
  {
    $hash = password_hash($password, PASSWORD_DEFAULT);

    $token = md5(time() . rand(0, 9999) . time());

    User::insert([
      'name' => $name,
      'email' => $email,
      'password' => $hash,
      'birthdate' => $birthdate,
      'token' => $token
    ])->execute();

    return $token;
  }
}
