<?
    require_once "connection.php";
    session_start();

    unset($_SESSION['id_user']);
    unset($_SESSION['login']);

    header("Location: index.php");
?>