<?php
    session_start();
    require_once "./database.php";

    $login = $_POST['login'];
    $password = $_POST['password'];

    $authResult = Database::query("SELECT * FROM users WHERE login = '$login' AND password = '$password'");

    if (isset($authResult))
    {
        $_SESSION['id_user'] = $authResult;

        header("Location: ../../blog.php");
    }
    else
    {
        echo "<p id='error'>НЕВЕРНЫЙ ЛОГИН ИЛИ ПАРОЛЬ</p>";
    }
?>