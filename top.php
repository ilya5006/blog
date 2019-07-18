<div id="top">
    <span id="title">Мой блог</span> 
    <a id="mainPage" href="blog.php">Вернуться на главную</a>
    
    <?
    if (isset($_SESSION['id_user']))
    {
        $username = $_SESSION['login'];
        
        echo "<a id='authAndLogout' href='logout.php'>ВЫЙТИ</a>";
        echo "<span id='username'>Вы вошли как:<br> $username</span>";
    }
    else
        echo "<a id='authAndLogout' href='auth.php'>ВОЙТИ</a>";
    ?>
</div>