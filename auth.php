<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Вход</title>
    <link rel="stylesheet" href="css/auth.css">
</head>
<body>
    <form id="auth" action="./model/php/authorization.php" method="POST">
        <input id="login" type="text" name="login" placeholder="Введите логин" required>
        <input id="password" type="password" name="password" placeholder="Введите пароль" required>
        
        <input id="enter" name="enter" type="submit" value="ВОЙТИ">
    </form>
</body>
</html>