<?
    session_start();
    require_once "connection.php";

    if (isset($_POST['postNameButton']) && $postName == $_POST['postNameButton'])
    {
        $_SESSION['postName'] = $_POST['postNameButton'];
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

    <form id="search" action="" method="POST">
        <input type="text" id="searchText" name="searchText">
        <input type="submit" id="searchButton" value="Найти" name="searchButton">
    </form>

    <div id="posts">
        <?
        $searchTags = "";
        $postsInfoQueryResults = [];

        if (isset($_POST['searchButton']))
        {
            $tags = $_POST['searchText'];
            $tags = htmlentities(mysqli_real_escape_string($link, $tags));
            $tagsArray = explode(", ", $tags);
            
            for ($i = 0; $i < count($tagsArray); $i++)
            {
                $postsInfoQuery = "SELECT * FROM posts WHERE tags LIKE '%$tagsArray[$i]%' ORDER BY id_post DESC";
                $postsInfoQueryResult = mysqli_query($link, $postsInfoQuery);
                array_push($postsInfoQueryResults, $postsInfoQueryResult);
            }

            unset($_POST['searchButton']);
        }
        else
        {
            $postsInfoQuery = "SELECT * FROM posts ORDER BY id_post DESC";
            $postsInfoQueryResult = mysqli_query($link, $postsInfoQuery);
            array_push($postsInfoQueryResults, $postsInfoQueryResult);
        }

        for ($i = 0; $i < count($postsInfoQueryResults); $i++)
        {
            while ($postsInfoResult = mysqli_fetch_assoc($postsInfoQueryResults[$i]))
            {
                $postId = $postsInfoResult['id_post'];
                $postName = $postsInfoResult['name'];
                $postTags = $postsInfoResult['tags'];
                $postText = $postsInfoResult['text'];
                $postDate = $postsInfoResult['date'];
                $postImage = $postsInfoResult['image'];

                echo "<div id='post'>";
                    echo "<form method='POST' id='postName'>";
                        echo "<input type='submit' id='postNameButton' name='postNameButton' value='$postName'>";
                    echo "</form>";
                    if ($_SESSION['id_user'] == 1)
                    {
                        echo "<form method='POST' id='deletePostForm'>";
                            echo "<input type='submit' id='deletePostIcon' name='deletePost' value='$postId'>";
                            $deletePostButton = $_POST['deletePost'];

                            if (isset($deletePostButton) && $postId == $deletePostButton)
                            {
                                $imagePath = __DIR__ . "/post_images/" . $postImage;
                                unlink($imagePath);

                                $deletePostQuery = "DELETE FROM posts WHERE id_post = '$postId'";
                                mysqli_query($link, $deletePostQuery);
                                echo "<meta http-equiv='refresh' content='0'>";
                            }
                        echo "</form>";
                    }

                    echo "<img id='postImage' src='post_images/$postImage'>";
                    echo "<p id='postDate'>$postDate</p>";

                    echo "<hr>";

                    if ($postTags != "")
                        echo "<p id='postTags'>$postTags</p>";
                    else
                        echo "<p id='postTags'>Теги отсутствуют</p>";

                    echo "<hr>";
                    
                    echo "<p id='postText'>$postText</p>";
                echo "</div>";
            }
        }
        // if (isset($_POST['searchButton']))
        // {
        //     $tags = $_POST['searchText'];

        //     $tagsArray = explode(", ", $tags);

        //     for ($i = 0; $i < count($tagsArray); $i++)
        //     {
        //         echo "<div id='post'>";
        //         $tag = $tagsArray[$i];
        //         $postsInfoQuery = "SELECT * FROM posts WHERE tags LIKE '%$tag%' ORDER BY id_post DESC";
        //         $postsInfoResultQuery = mysqli_query($link, $postsInfoQuery);

        //         while($postsInfoResult = mysqli_fetch_assoc($postsInfoResultQuery))
        //         {
        //             $postId = $postsInfoResult['id_post'];
        //             $postName = $postsInfoResult['name'];
        //             $postTags = $postsInfoResult['tags'];
        //             $postText = $postsInfoResult['text'];
        //             $postDate = $postsInfoResult['date'];
        //             $postImage = $postsInfoResult['image'];

        //             echo "<form method='POST' id='postName'>";
        //                 echo "<input type='submit' id='postNameButton' name='postNameButton' value='$postName'>";
        //             echo "</form>";

        //             if ($_SESSION['id_user'] == 1)
        //             {
        //                 echo "<form method='POST' id='deletePostForm'>";
        //                     echo "<input type='submit' id='deletePostIcon' name='deletePost' value='$postId'>";
        //                     $deletePostButton = $_POST['deletePost'];

        //                     if (isset($deletePostButton) && $postId == $deletePostButton)
        //                     {
        //                         $imagePath = __DIR__ . "/post_images/" . $postImage;
        //                         unlink($imagePath);

        //                         $deletePostQuery = "DELETE FROM posts WHERE id_post = '$postId'";
        //                         mysqli_query($link, $deletePostQuery);
        //                         echo "<meta http-equiv='refresh' content='0'>";
        //                     }
        //                 echo "</form>";
        //             }
                    
        //             echo "<img id='postImage' src='post_images/$postImage'>";
        //             echo "<p id='postDate'>$postDate</p>";

        //             echo "<hr>";

        //             echo "<p id='postTags'>$postTags</p>";

        //             echo "<hr>";
                    
        //             echo "<p id='postText'>$postText</p>";
                    
        //         }
        //         echo "</div>";
        //     }

        //     unset($_POST['searchButton']);
        // }
        // else
        // {
        //     $postsInfoQuery = "SELECT * FROM posts ORDER BY id_post DESC";
        //     $postsInfoResultQuery = mysqli_query($link, $postsInfoQuery);

        //     while($postsInfoResult = mysqli_fetch_assoc($postsInfoResultQuery))
        //     {
        //         $postId = $postsInfoResult['id_post'];
        //         $postName = $postsInfoResult['name'];
        //         $postTags = $postsInfoResult['tags'];
        //         $postText = $postsInfoResult['text'];
        //         $postDate = $postsInfoResult['date'];
        //         $postImage = $postsInfoResult['image'];

        //         echo "<div id='post'>";
        //             echo "<form method='POST' id='postName'>";
        //                 echo "<input type='submit' id='postNameButton' name='postNameButton' value='$postName'>";
        //             echo "</form>";

        //             if ($_SESSION['id_user'] == 1)
        //             {
        //                 echo "<form method='POST' id='deletePostForm'>";
        //                     echo "<input type='submit' id='deletePostIcon' name='deletePost' value='$postId'>";
        //                     $deletePostButton = $_POST['deletePost'];

        //                     if (isset($deletePostButton) && $postId == $deletePostButton)
        //                     {
        //                         $imagePath = __DIR__ . "/post_images/" . $postImage;
        //                         unlink($imagePath);

        //                         $deletePostQuery = "DELETE FROM posts WHERE id_post = '$postId'";
        //                         mysqli_query($link, $deletePostQuery);
        //                         echo "<meta http-equiv='refresh' content='0'>";
        //                     }
        //                 echo "</form>";
        //             }
                    
        //             echo "<img id='postImage' src='post_images/$postImage'>";
        //             echo "<p id='postDate'>$postDate</p>";

        //             echo "<hr>";

        //             if ($postTags != "")
        //                 echo "<p id='postTags'>$postTags</p>";
        //             else
        //                 echo "<p id='postTags'>Теги отсутствуют</p>";

        //             echo "<hr>";
                    
        //             echo "<p id='postText'>$postText</p>";
        //         echo "</div>";
        //     }
        // }
        ?>
    </div>
</body>
</html>