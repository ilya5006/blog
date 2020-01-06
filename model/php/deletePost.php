<?php
require_once './database.php';

$postId = $_POST['deletePost'];
$postImage = Database::query("SELECT image FROM posts WHERE id_post = '$postId'")['image'];

$imagePath = '../../post_images/' . $postId . '/' . $postImage;
$dirPath = '../../post_images/' . $postId; 
@unlink($imagePath);
@rmdir($dirPath);

Database::queryExecute("DELETE FROM posts WHERE id_post = '$postId'");
header("Location: ../../blog.php");
?>