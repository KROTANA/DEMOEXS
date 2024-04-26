

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
        РЕГИСТРАЦИЯ<br><br>
        Введите логин
        <input type="text" name="login" class="blockfirm"><br>
        Введите пароль
        <input type="password" name="password" class="blockfirm">
        <br>
        <button type="submit" class="otp"><b>Отправить</b></button>
        <div class="change" id="change"></div>

    </form>

    <?
    //В ПХП МАЙ АДМИН СТАВИЬ A_I
    //Это страница с регистрацией
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Тут компиляция по факту всех работ которые были сданы с изменениями 
        $username = $_POST['login'];
        $password = $_POST['password'];
        try{
            //как обычно подключение к бд
            $pdo = new PDO("mysql:host=127.0.0.1; dbname=bis4",'root','');
            //Это строка указывает атрибут ошибки. тоесть атрибут обработки ошибок и оббработка их как исключений
            $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            //Проверка логина из базы данных
            $checkuser = $pdo->prepare("SELECT * FROM users WHERE login = ?");
            //это подготовленный запрос к бд
            $checkuser->execute([$username]);
            //тут проверка на наличие строчки в бд
            if($checkuser->fetch()){
                //Если есть стриочка с логином то выводит просто js скрипт в html элемеент с соответствующим тегом
               echo "
                <script>
                let vs = document.getElementById('change').textContent =
                 'пользователь с таким логином уже существует'
                </script>";
               //в ином случае происходит добавление в бд 
            }else{
                //тут делаеться SQL запрос
                $dbn = $pdo->prepare("INSERT INTO users (id,login,password,isAdmin) VALUES (?,?,?,?)");
                //Хэширование паролья
                $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                //Сюда вставляються данные для sql запроса. Вставил null потому что в бд ID автоматически указывыаеться. я там поставил A_I Тоесть Auto Increment но пустой оставлять нельзя.  ошибка
                $dbn->execute([NULL,$username,$passwordHash,0]);
                //после всегог этого дела происходит переадресация на старнциу с авторизацией
                header("Location: /authorization.php");
    
            }
            //обнуление бд на всякий чтобы закрыть ее
            $pdo = null;
    
        }catch(PDOExcption $e){
            echo 'Ошибка';
        }
        //exit оставил на всякий хотя по факту он не нужен потому что скрипт завершиться после перенаправления.
        exit();
    }
    
    
    
    
    ?>

</body>
</html>