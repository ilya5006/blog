<?
    session_start();
    require_once "connection.php";
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

    <div id="post">
        <?
        // $postId = $_POST['id_post'];
        $postId = 16;
        $postInfoQuery = "SELECT * FROM posts WHERE id_post = '$postId'";
        $postInfoResult = mysqli_query($link, $postInfoQuery);
        $postInfoResult = mysqli_fetch_assoc($postInfoResult);

        $postName = $postInfoResult['name'];
        $postTags = $postInfoResult['tags'];
        $postText = $postInfoResult['text'];
        $postDate = $postInfoResult['date'];
        $postImage = $postInfoResult['image'];

        echo "<h2 id='postName'>$postName</h2>";
        echo "<img id='postImage' src='post_images/$postImage'>";
        echo "<p id='postDate'>$postDate</p>";
        echo "<p id='postTags'>$postTags</p>";
        echo "<p id='postText'>$postText</p>";
        ?>
    </div>

</body>
</html>