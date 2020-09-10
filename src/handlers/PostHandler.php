<?php

namespace src\handlers;

setlocale(LC_TIME, 'pt_BR.utf-8', 'pt_BR', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');

use \src\models\Post;

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
}
