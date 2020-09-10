<div class="box feed-new">
  <div class="box-body">
    <div class="feed-new-editor m-10 row">
      <div class="feed-new-avatar">
        <img src="<?= $base . '/media/avatars/' . $user->avatar ?>" />
      </div>
      <div class="feed-new-input-placeholder">O que você está pensando, <?= $user->name ?></div>
      <div class="feed-new-input" contenteditable="true"></div>
      <div class="feed-new-send">
        <img src="<?= $base . '/assets/images/send.png' ?>" />
      </div>
      <form id="form-new-feed" action="<?= $base . '/post/new' ?>" method="POST">
        <input type="hidden" name="body" id="input-body-feed"></form>
    </div>
  </div>
</div>

<script type="text/javascript" src="<?= $base . '/assets/js/newPost.js' ?>">

</script>