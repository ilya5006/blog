<?php
    session_start();
    require_once "./php/database.php";
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="css/post.css">
</head>
<body>
    <div id="top">
        <span id="title">Мой блог</span>
        <a id="mainPage" href="blog.php">Вернуться на главную</a>
        <?php
        if (isset($_SESSION['id_user']))
        {
            $username = $_SESSION['login'];
            
            if ($_SESSION['id_user'] == 1)
            {
                echo "<a id='postWriting' href='postWriting.php'>Написать пост</a>";
            }

            echo "<a id='authAndLogout' href='logout.php'>ВЫЙТИ</a>";
            
            echo "<span id='username'>Вы вошли как:<br> $username</span>";            
        }
        else
        {
            echo "<a id='authAndLogout' href='auth.php'>ВОЙТИ</a>";
        }
        ?>
    </div>

    <div id="post">
        <?php
        $postName = $_SESSION['postName'];

        $postInfoResult = $mysqli->query("SELECT * FROM posts WHERE name LIKE '%$postName%'");
        $postInfoResult = $postInfoResult->fetch_assoc();

        $postId = $postInfoResult['id_post'];
        $postTags = $postInfoResult['tags'];
        $postText = $postInfoResult['text'];
        $postDate = $postInfoResult['date'];
        $postImage = $postInfoResult['image'];

        echo "<h2 id='postName'>$postName</h2>";
        echo "<img id='postImage' src='post_images/$postId/$postImage'>";
        echo "<p id='postDate'>$postDate</p>";

        if ($postTags != "")
        {
            echo "<p id='postTags'>$postTags</p>";
        }

        echo "<p id='postText'>$postText</p>";
        ?>
    </div>

</body>
</html>