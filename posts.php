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
        $postsInfoQuery = "SELECT * FROM posts";
        $postsInfoResultQuery = mysqli_query($link, $postsInfoQuery);

        while($postsInfoResult = mysqli_fetch_assoc($postsInfoResultQuery))
        {
            $postName = $postsInfoResult['name'];
            $postTags = $postsInfoResult['tags'];
            $postText = $postsInfoResult['text'];
            $postDate = $postsInfoResult['date'];
            $postImage = $postsInfoResult['image'];

            echo "<div id='post'>";
                echo "<h2 id='postName'>$postName</h2>";
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