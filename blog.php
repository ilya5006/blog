<?php
    session_start();
    require_once "./php/database.php";

    if (isset($_POST['postNameButton']))
    {
        header("Location: post.php");
    }
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
        
        <?php
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

    <form id="search" action="" method="POST">
        <input type="text" id="searchText" name="searchText">
        <input type="submit" id="searchButton" value="Найти" name="searchButton">
    </form>

    <div id="posts">
        <?php
        $postsInfoQueryResults = [];

        if (isset($_POST['searchButton']))
        {
            $tags = $_POST['searchText'];
            $tagsArray = explode(", ", $tags);
            
            for ($i = 0; $i < count($tagsArray); $i++)
            {
                $postsInfoQueryResult = Database::queryAll("SELECT * FROM posts WHERE tags LIKE '%$tagsArray[$i]%' ORDER BY id_post DESC");
                array_push($postsInfoQueryResults, $postsInfoQueryResult);
            }

            unset($_POST['searchButton']);
        }
        else
        {
            $postsInfoQueryResult = Database::queryAll("SELECT * FROM posts ORDER BY id_post DESC");
            array_push($postsInfoQueryResults, $postsInfoQueryResult);
        }

        for ($i = 0; $i < count($postsInfoQueryResults); $i++)
        {
            foreach ($postsInfoQueryResults[$i] as $data)
            {
                $postId = $data['id_post'];
                $postName = $data['name'];
                $postTags = $data['tags'];
                $postText = $data['text'];
                $postDate = $data['date'];
                $postImage = $data['image'];

                echo "<div class='post'>";
                    echo "<form method='POST' class='postName'>";
                        echo "<input type='submit' class='postNameButton' name='postNameButton' value='$postName'>";
                        if (isset($_POST['postNameButton']) && $postName == $_POST['postNameButton'])
                        {
                            $_SESSION['postName'] = $postName;
                        }
                    echo "</form>";
                    
                    if ($_SESSION['id_user'] == 1) // is user admin? 
                    {
                        echo "<form method='POST' class='deletePostForm'>";
                            echo "<input type='submit' class='deletePostIcon' name='deletePost' value='$postId'>";

                            if (isset($_POST['deletePost']) && $postId == $_POST['deletePost'])
                            {
                                $imagePath = __DIR__ . '/post_images/' . $postId . '/' . $postImage;
                                $dirPath = __DIR__ . '/post_images/' . $postId; 
                                unlink($imagePath);
                                rmdir($dirPath);

                                $deletePostQuery = Database::queryExecute("DELETE FROM posts WHERE id_post = '$postId'");
                                echo "<meta http-equiv='refresh' content='0'>";
                            }
                            
                        echo "</form>";
                    }

                    echo "<img class='postImage' src='post_images/$postId/$postImage'>";
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
        }
        ?>
    </div>
</body>
</html>