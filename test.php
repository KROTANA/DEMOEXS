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
    echo $_COOKIE['isAdmin'];
    echo"<button type='button'><a href='/delcook.php'>1</a></button>";
    echo '<br>';
    $cookchage = $_COOKIE['isAdmin'];
    if($_COOKIE['isAdmin'] == '1'){
        echo 'Это админ';
    }else{
        echo 'Это не админ';
    }
    
    
    
    
    ?>
</body>
</html>