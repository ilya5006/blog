<?
    session_start();
    require_once "connection.php";
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Блог</title>
    <link rel="stylesheet" href="css/blog.css">
</head>
<body>
    <div id="top">
        <span id="title">Мой блог</span>
        <?
        if (isset($_SESSION['id_user']))
        {
            $username = $_SESSION['login'];
            
            if ($_SESSION['id_user'] == 1)
                echo "<a id='postWriting' href='postWriting.php'>Написать пост</a>";

            echo "<a id='authAndLogout' href='logout.php'>ВЫЙТИ</a>";
            echo "<span id='username'>Вы вошли как:<br> $username</span>";            
        }
        else
            echo "<a id='authAndLogout' href='auth.php'>ВОЙТИ</a>";
        ?>
    </div>

    <iframe id="posts" src="posts.php"></iframe>
</body>
</html>