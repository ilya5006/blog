<?php
    session_start();
    require_once "./model/php/database.php";

    $idUser = $_SESSION['id_user'];
    $isUserAdmin = $_SESSION['id_user'] == 1;

    if (!$isUserAdmin)
    {
        header("Location: index.php");
    }

    $username = Database::query("SELECT login FROM users WHERE id_user = '$idUser'")['login'];
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Создание поста</title>
    <link rel="stylesheet" href="css/postWriting.css">
</head>
<body>
    <?php require_once './view/top.php'; ?>

    <form action="./model/php/postSend.php" method="POST" enctype="multipart/form-data" id="post">
        <input id="post_name" type="text" name="post_name" placeholder="Введите навзание поста" required>
        <textarea id="post_text" name="post_text" placeholder="Введите текст" required></textarea>
        <input id="post_tags" type="text" name="post_tags" placeholder="Введите теги">
        <input id="post_image" type="file" name="post_image">
        <input id="post_submit" type="submit">
    </form>
</body>
</html>