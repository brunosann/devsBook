<?php

namespace src\handlers;

setlocale(LC_TIME, 'pt_BR.utf-8', 'pt_BR', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');

use \src\models\Post;
use \src\models\UserRelation;
use \src\models\User;

class PostHandler
{
  public static function addPost($id, $type, $body)
  {
    $body = trim($body);
    if (!empty($body) && !empty($id)) {
      Post::insert([
        'id_user' => $id,
        'type' => $type,
        'created_at' => date('Y-m-d H:i:s'),
        'body' => $body
      ])->execute();
    }
  }

  public static function getHomeFeed($id, $page)
  {
    $perPage = 2;

    // pegar lista de usuarios que eu sigo
    $userList = UserRelation::select()->where('user_from', $id)->get();
    $users = [];
    foreach ($userList as $user) {
      $users[] = $user['user_to'];
    }
    $users[] = $id;

    // pegar os posts desses usuarios pela data
    $postsList = Post::select()->where('id_user', 'in', $users)->orderBy('created_at', 'desc')->page($page, $perPage)->get();

    $total = Post::select()->where('id_user', 'in', $users)->count();
    $pageCount = ceil($total / $perPage);

    //transformar o resultado em objetos dos models
    $posts = [];
    foreach ($postsList as $post) {
      $newPost = new Post();
      $newPost->id = $post['id'];
      $newPost->type = $post['type'];
      $newPost->created_at = $post['created_at'];
      $newPost->body = $post['body'];
      $newPost->mine = false;

      if ($post['id_user'] === $id) {
        $newPost->mine = true;
      }

      // preencher as informações adicionais no post
      $newUser = User::select()->where('id', $post['id_user'])->one();
      $newPost->user = new User();
      $newPost->user->id = $newUser['id'];
      $newPost->user->name = $newUser['name'];
      $newPost->user->avatar = $newUser['avatar'];

      //preencher informações de LIKE
      $newPost->likeCount = 0;
      $newPost->liked = false;
      //preencher informações de COMMENTS
      $newPost->comments = [];

      $posts[] = $newPost;
    }

    return [
      'posts' => $posts,
      'pageCount' => $pageCount,
      'currentPage' => $page
    ];
  }
}
