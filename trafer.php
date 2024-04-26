<?

    //тут проверка значения из куки если он равно 1 то переводит на страницу админа а если 0 то на пользовательскую
    if($_COOKIE['isAdmin'] == '1'){
        header("Location: /adminpage.php");
    }else{
        header("Location: /userpage.php");
    }
    
    
    
    
    ?>