<?
    session_start();
    require_once "connection.php";

    if ($_SESSION['id_user'] != 1)
        header("Location: index.php");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="css/postWriting.css">
</head>
<body>
    <div id="top">
        <span id="title">Мой блог</span>
        <a id="mainPage" href="blog.php">Вернуться на главную</a>
        
        <?
        if (isset($_SESSION['id_user']))
        {
            $username = $_SESSION['login'];
            
            echo "<a id='authAndLogout' href='logout.php'>ВЫЙТИ</a>";
            echo "<span id='username'>Вы вошли как:<br> $username</span>";            
        }
        else
            echo "<a id='authAndLogout' href='auth.php'>ВОЙТИ</a>";
        ?>
    </div>

    <form action="postSend.php" method="POST" enctype="multipart/form-data" id="post">
        <input id="postName" type="text" name="postName" placeholder="Введите навзание поста" required>
        <textarea id="postText" name="postText" placeholder="Введите текст" required></textarea>
        <input id="postTags" type="text" name="postTags" placeholder="Введите теги">
        <input id="postImage" type="file" name="postImage" required>
        <input id="postSubmit" type="submit">
    </form>
</body>
</html>