<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="csis.css">
</head>
<body>
    <form method="post" class="firma">
        <br>
        АВТОРИЗАЦИЯ<br><br>
        Введите логин
        <input type="text" name="login" class="blockfirm"><br>
        Введите пароль
        <input type="password" name="password" class="blockfirm">
        <br>
        <button type="submit" class="otp"><b>Отправить</b></button>
        <br>
        <?echo"<button type='button' class='otp'><a href='/registration.php'style='color: #000; text-decoration:none;color:white'><b>Регистрация</b></a></button>"?>
        <div class="change" id="change"></div>
        <br>
        
        
        
        

    </form>

    

    <?
    function registr(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //тут по факту все то же самое что и на странице с авторизацией просто поменял
    
            $username = $_POST['login'];
            $password = $_POST['password'];
            try{
                $pdo = new PDO("mysql:host=127.0.0.1; dbname=bis4",'root','');
                $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                //тут делаю  запрос уже к двум обьктам из бд
                $sty = $pdo->prepare("SELECT * FROM users WHERE login = ?");
                $sty->execute([$username]);
                //просто fetch как в прошлый раз вставить не получилось долго голову ломал была ошибка запихнул это в отдельную переменную и получилось
                $prov = $sty->fetch();
                //Проверка хэша пароля
                if($prov && password_verify($password,$prov['password'])){
                    //устанавливаются логина
                    setcookie('login',$_POST['login'],time() + (300 * 400),"/");
                    //и статуса
                    setcookie('isAdmin',$prov['isAdmin'],time() + (300*400),"/");
                    //переход на мост 
                    header("Location: /trafer.php");
                    exit();
                   
                }
                else{
                    //в проивном случае просто выведиться через js скрипт сообщение что что то не правильно
                    echo "
                    <script>
                    let vs = document.getElementById('change').textContent =
                     'Неправильные логин или пароль'
                    </script>";
                }
               
            }catch(PDOExeption $e){
                echo 'Ошибка подключения к бд';
            }
            
            
        
            
        }
    }
    
    //а тут просто на мост сразу переидывает если куки есть
    //ИСПОЛЬЗОВАТЬ ДЛЯ PAGE
    if (!isset($_COOKIE['login'])) {
        registr();
        } else {
        header("Location: /trafer.php");
      }
    
    
    
    
    ?>

</body>
</html>