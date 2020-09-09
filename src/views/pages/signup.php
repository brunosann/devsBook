<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <title>Cadastro - DevsBook</title>
  <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1" />
  <link rel="stylesheet" href="<?= $base . '/assets/css/login.css' ?>" />
</head>

<body>
  <header>
    <div class="container">
      <a href=""><img src="<?= $base . '/assets/images/devsbook_logo.png' ?>" /></a>
    </div>
  </header>
  <section class="container main">
    <form method="POST" action="<?= $base . '/cadastro' ?>">
      <?php if (!empty($flash)) : ?>
        <div class="flash"><?= $flash ?></div>
      <?php endif ?>

      <input placeholder="Digite seu nome completo" class="input" type="text" name="name" required />

      <input placeholder="Digite seu e-mail" class="input" type="email" name="email" required />

      <input placeholder="Digite sua senha" class="input" type="password" name="password" required />

      <input placeholder="Digite sua data de nascimento" class="input" type="date" name="birthdate" id="birthdate" required />

      <input class="button" type="submit" value="Criar cadastro" required />

      <a href="<?= $base . '/login' ?>">Ja tem cadastro? Faça login.</a>
    </form>
  </section>

  <script type="text/javascript" src="<?= $base . '/assets/js/msgFlash.js' ?>"></script>

</body>

</html>