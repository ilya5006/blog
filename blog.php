<?php
    session_start();
    require_once "./model/php/database.php";

    $userId = $_SESSION['id_user'];
    $isUserAdmin = $_SESSION['id_user'] == 1;
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Блог</title>
    <link rel="stylesheet" href="css/blog.css">
    <script src="./model/js/postsSearchOutput.js" defer></script>
    <script src="./model/js/pagesPost.js" defer></script>

</head>
<body>
    <div id="top">
        <span id="title">Мой блог</span>
        
        <?php
        if (isset($_SESSION['id_user']))
        {
            $username = Database::query("SELECT login FROM users WHERE id_user = '$userId'")['login'];
            
            if ($isUserAdmin)
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

    <form id="search">
        <input type="text" id="searchText" placeholder="Поиск" name="searchText">
        <input type="submit" id="searchButton" value="Найти" name="searchButton">
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
                echo "<form method='POST' action='./post.php' class='postName'>";
                    echo "<input type='submit' class='postNameButton' name='postNameButton' value='$postName'>";
                    echo "<input type='text' value='$postId' name='post_id' style='display: none;'>";
                echo "</form>";
                
                if ($isUserAdmin)
                {
                    echo "<form method='POST' action='./model/php/deletePost.php' class='deletePostForm'>";
                        echo "<input type='submit' class='deletePostIcon' name='deletePost' value='$postId'>";
                    echo "</form>";
                }

                if (isset($postImage))
                {
                    echo "<img class='postImage' src='post_images/$postId/$postImage'>";
                }
                echo "<p class='postDate'>$postDate</p>";

                echo "<hr>";

                if ($postTags != "")
                {
                    echo "<p class='postTags'>$postTags</p>";
                }
                
                echo "<hr>";
                
                echo "<p class='postText'>$postText</p>";
            echo "</div>";
        }
        ?>
        <div id="pagination">
            <a href="">1</a>
            <a href="">2</a>
            <a href="">3</a>
            <a href="">4</a>
        </div>
    </div>

    
</body>
</html>