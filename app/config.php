<?php

    $maintenanceMode = json_decode(file_get_contents('assets/app.json'), true)['maintenanceMode'];

    define("ROOT_PATH","/My-Github/breaktime/");

    $requstURI = str_replace(ROOT_PATH,"", $_SERVER['REQUEST_URI']);

    if($maintenanceMode === true){
        header("Location: pages/maintan.html");
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