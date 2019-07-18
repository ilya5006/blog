<?
    session_start();
    require_once "connection.php";
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="css/posts.css">
</head>
<body>
    <form id="search" action="" methd="POST">
        <input type="text" id="searchText" name="searchText">
        <input type="submit" id="searchButton" value="Найти" name="searchButton">
    </form>

    <div id="posts">
        <?
        $postsInfoQuery = "SELECT * FROM posts ORDER BY id_post DESC";
        $postsInfoResultQuery = mysqli_query($link, $postsInfoQuery);

        while($postsInfoResult = mysqli_fetch_assoc($postsInfoResultQuery))
        {
            $postId = $postsInfoResult['id_post'];
            $postName = $postsInfoResult['name'];
            $postTags = $postsInfoResult['tags'];
            $postText = $postsInfoResult['text'];
            $postDate = $postsInfoResult['date'];
            $postImage = $postsInfoResult['image'];

            echo "<div id='post'>";
                echo "<h2 id='postName'><a id='postNameLink' href=''>$postName</a></h2>";
                ?>
                <script>
                    let postName = document.querySelector("#postNameLink");
                    postName.addEventListener("click", function(event)
                    {
                        event.preventDefault();
                    });
                </script>
                <?
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
                echo "<p id='postTags'>$postTags</p>";
                echo "<p id='postText'>$postText</p>";
            echo "</div>";
        }
        ?>
    </div>
</body>
</html>