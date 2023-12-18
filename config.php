<?php

    $config = json_decode(file_get_contents('app.json'), true);

    define("ROOT_PATH","/PHP/breaktime/");

    $requstURI = str_replace(ROOT_PATH,"", $_SERVER['REQUEST_URI']);

    if($config['maintenanceMode'] === true){
        header("Location: maintan.html");
    }   

    if($requstURI=='/'){
        header("Location: index.php");
    }

    if($requstURI=='/sevices.php'){
        header("Location: sevices.php");
    }

    if($requstURI=='/about'){
        header("Location: about.html");
    }

    if($requstURI=='/home'){
        header("Location: home.html");
    }

?>