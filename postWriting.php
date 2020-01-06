<?php
    session_start();
    require_once "./model/php/database.php";

    $idUser = $_SESSION['id_user'];
    if ($idUser != 1)
    {
        header("Location: index.php");
    }
        
    $username = Database::query("SELECT login FROM users WHERE id_user = '$idUser'")['login'];
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Написание поста</title>
    <link rel="stylesheet" href="css/postWriting.css">
</head>
<body>
    <div id="top">
        <span id="title">Мой блог</span>
        <a id="mainPage" href="blog.php">Вернуться на главную</a>
        <a id='authAndLogout' href='logout.php'>ВЫЙТИ</a>
        
        <span id='username'>Вы вошли как:<br> <?php echo $username; ?> </span>
    </div>

    <form action="./model/php/postSend.php" method="POST" enctype="multipart/form-data" id="post">
        <input id="postName" type="text" name="postName" placeholder="Введите навзание поста" required>
        <textarea id="postText" name="postText" placeholder="Введите текст" required></textarea>
        <input id="postTags" type="text" name="postTags" placeholder="Введите теги">
        <input id="postImage" type="file" name="postImage">
        <input id="postSubmit" type="submit">
    </form>
</body>
</html>