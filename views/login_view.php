<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../public/media/style/main.css">
    <link rel="stylesheet" href="../public/media/style/login.css">
    <link rel="stylesheet" href="../public/media/style/animation.css">
    <title>Connexion</title>
</head>
<body>
<?php
if (isset($error)) {
?>
<section class="error"><?= $error; ?></section>
<?php } ?>
<section class="login">
    <form method="post" action="">
        <img src="../public/media/images/user.svg" alt="User" class="user">
        <input type="text" name="login_username" placeholder="Nom d'utilisateur" required>
        <input type="password" name="login_password" placeholder="Mot de passe" required>
        <div class="buttons">
            <button type="button" class="register">Je n'ai pas de compte</button>
            <button type="submit" name="login">Connexion</button>
        </div>
    </form>
</section>
<section class="register hide">
    <form method="post" action="">
        <img src="../public/media/images/user.svg" alt="User" class="user">
        <input type="text" name="register_username" placeholder="Nom d'utilisateur" required>
        <input type="password" name="register_password" placeholder="Mot de passe" required>
        <div class="buttons">
            <button type="button" class="login">J'ai déjà un compte</button>
            <button type="submit" name="login">Créer</button>
        </div>
    </form>
</section>

<script type="text/javascript" src="../public/media/script/login.js"></script>
</body>
</html>