<?

//тут просто удаление куки
if (isset($_COOKIE['login'])) {
    setcookie("login",$_COOKIE['login'], time()-3600);
    setcookie("isAdmin",$_COOKIE['isAdmin'], time()-3600);
    }
    //Обязательно замениь на userpage
    header("Location: /userpage.php");







?>