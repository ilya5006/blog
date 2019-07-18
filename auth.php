<?
    session_start();
    require_once "connection.php";

    if (isset($_POST['enter']))
    {
        $login = $_POST['login'];
        $password = $_POST['password'];

        $queryAuth = "SELECT * FROM users WHERE login = '$login' AND password = '$password'";
        $resultAuth = mysqli_query($link, $queryAuth);
        $resultAuth = mysqli_fetch_assoc($resultAuth);

        if (isset($resultAuth))
        {
            $_SESSION['id_user'] = $resultAuth['id_user'];
            $_SESSION['login'] = $resultAuth['login'];

            if ($resultAuth['id_user'])
                header("Location: blog.php");
        }
        else
            echo "<p id='error'>НЕВЕРНЫЙ ЛОГИН ИЛИ ПАРОЛЬ</p>";

        unset($_POST['enter']);
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Вход</title>
    <link rel="stylesheet" href="css/auth.css">
</head>
<body>
    <form id="auth" action="" method="POST">
        <input id="login" type="text" name="login" placeholder="Введите логин" required>
        <input id="password" type="password" name="password" placeholder="Введите пароль" required>
        
        <input id="enter" name="enter" type="submit" value="ВОЙТИ">
    </form>
</body>
</html>