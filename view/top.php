<div id="top">
    <span id="title">Мой блог</span>
    
    <?php
    if (isset($_SESSION['id_user']))
    {            
        if ($isUserAdmin)
        {
            echo "<a id='post_writing' href='postWriting.php'>Написать пост</a>";
        }

        echo "<a id='auth_and_logout' href='logout.php'>ВЫЙТИ</a>";
        echo "<span id='username'>Вы вошли как:<br> $username</span>";            
    }
    else
    {
        echo "<a id='auth_and_logout' href='auth.php'>ВОЙТИ</a>";
    }
    ?>
</div>