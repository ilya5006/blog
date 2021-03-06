<?php
    session_start();
    require_once "./model/php/database.php";

    $idUser = $_SESSION['id_user'];
    $isUserAdmin = $idUser == 1;

    $username = Database::query("SELECT login FROM users WHERE id_user = '$idUser'")['login'];
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Пост</title>
    <link rel="stylesheet" href="css/post.css">
</head>
<body>
    <?php require_once './view/top.php'; ?>

    <div id="post">
        <?php
        $postId = $_GET['id_post'];
        $postInfoResult = Database::query("SELECT * FROM posts WHERE id_post = '$postId'");

        $postId = $postInfoResult['id_post'];
        $postTags = $postInfoResult['tags'];
        $postText = $postInfoResult['text'];
        $postDate = $postInfoResult['date'];
        $postImage = $postInfoResult['image'];

        echo "<h2 id='post_name'>$postName</h2>";
        if (isset($postImage))
        {
            echo "<img id='post_image' src='post_images/$postId/$postImage'>";
        }
        echo "<p id='post_date'>$postDate</p>";

        if ($postTags != "")
        {
            echo "<p id='post_tags'>$postTags</p>";
        }

        echo "<p id='post_text'>$postText</p>";
        ?>
    </div>

</body>
</html>