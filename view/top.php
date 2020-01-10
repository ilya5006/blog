<div id="top">
    <span id="title">Мой блог</span>
    
    <?php
    if (isset($_SESSION['id_user']))
    {            
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