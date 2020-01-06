<?php
    session_start();
    require_once "./database.php";

    $login = $_POST['login'];
    $password = $_POST['password'];

    $authResult = $mysqli->query("SELECT * FROM users WHERE login = '$login' AND password = '$password'");
    $authResult = $authResult->fetch_row();
    $authResult = $authResult[0];

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