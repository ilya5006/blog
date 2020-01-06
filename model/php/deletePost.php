<?php
require_once './database.php';

$postId = $_POST['deletePost'];
$postImage = $mysqli->query("SELECT image FROM posts WHERE id_post = '$postId'");
$postImage = $postImage->fetch_row()[0];

$imagePath = '../../post_images/' . $postId . '/' . $postImage;
$dirPath = '../../post_images/' . $postId; 
unlink($imagePath);
rmdir($dirPath);

$mysqli->query("DELETE FROM posts WHERE id_post = '$postId'");
header("Location: ../../blog.php");
?>