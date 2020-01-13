<?php
    session_start();
    require_once "./model/php/database.php";

    $idUser = $_SESSION['id_user'];
    $isUserAdmin = $_SESSION['id_user'] == 1;

    $username = Database::query("SELECT login FROM users WHERE id_user = '$idUser'")['login'];
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Блог</title>
    <link rel="stylesheet" href="css/blog.css">
    <script src="./model/js/blog.js" defer></script>
    <script src="./model/js/pagesPost.js" defer></script>
    <script src="./model/js/postsSearchOutput.js" defer></script>
</head>
<body>
    <?php require_once './view/top.php'?>

    <form id="search">
        <input type="text" id="search_text" placeholder="Поиск" name="search_text">
        <input type="submit" id="search_button" value="Найти" name="search_button">
    </form>

    <div id="posts">
        <?php
        $posts = Database::queryAll("SELECT * FROM posts ORDER BY id_post DESC");

        foreach ($posts as $postInfo)
        {
            $postId = $postInfo['id_post'];
            $postName = $postInfo['name'];
            $postTags = $postInfo['tags'];
            $postText = $postInfo['text'];
            $postDate = $postInfo['date'];
            $postImage = $postInfo['image'];

            echo "<div class='post'>";
                echo "<a href='./post.php?id_post=$postId' class='post_name'>$postName</a>";
                if ($isUserAdmin)
                {
                    echo "<form method='POST' action='./model/php/deletePost.php' class='delete_post_form'>";
                        echo "<input type='submit' class='delete_post_icon' name='delete_post' value='$postId'>";
                    echo "</form>";
                }

                if (isset($postImage))
                {
                    echo "<img class='post_image' src='./post_images/$postId/$postImage'>";
                }
                echo "<p class='post_date'>$postDate</p>";

                echo "<hr>";

                if ($postTags != "")
                {
                    echo "<p class='post_tags'>$postTags</p>";
                }
                else
                {
                    echo "<p class='post_tags'>Тэги отсутствуют</p>";
                }
                
                echo "<hr>";
                
                echo "<p class='post_text'>$postText</p>";
            echo "</div>";
        }
        ?>
        <div id="pagination">
            
        </div>
    </div>
</body>
</html>