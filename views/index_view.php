<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Liste des foyers</title>
    <link rel="stylesheet" href="../public/media/style/main.css">
    <link rel="stylesheet" href="../public/media/style/index.css">
</head>
<body>
<header>
    <a href="../controllers/profile.php" class="user">
        <img src="../public/media/images/user.svg" alt="User" class="user">
    </a>
</header>
<main>

    <?php
    if (isset($error)) {
        echo "<p class=\"error\">" . $error . "</p>";
    }
    foreach ($homes as $home) {
    ?>
        <a href="../controllers/home.php?id=<?= $home["id"] ?>" class="home">
            <img src="../public/media/images/home.svg" alt="Home">
            <p class="home"><?= htmlspecialchars($home["name"]) ?></p>
        </a>
    <?php
    }
    ?>

    <a href="../controllers/new_house.php" class="add">
        <img src="../public/media/images/add-ellipse.svg" alt="Add" class="add">
    </a>
</main>
</body>
</html>