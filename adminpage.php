<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?
    echo $_COOKIE['login'];
    echo 'Это админ страница';
    echo"<button type='button'><a href='/delcook.php'>Выйти</a></button>";
    
    ?>
</body>
</html>