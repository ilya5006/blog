<?
    session_start();
    require_once "connection.php";

    if ($_SESSION['id_user'] != 1)
    {
        header("Location: index.php");
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Блог</title>
</head>
<body>
    <form id="logout" action="logout.php" method="POST">
        <input type="submit" value="ВЫЙТИ">
    </form>
</body>
</html>