<?php

function diePage($msg) {
    echo "<div style='padding: 30px;width:80%;margin:50px auto; background: #f9dede; border:1px solid #cca4a4;color: #521717;border-radius:5px;font-family:sans-serif;'>$msg</div>";
    die();
}

function message($msg,$cssClass = 'info') {
    echo "<div class='$cssClass' style='padding: 20px;width:80%;margin:10px auto; background: #f9dede; border:1px solid #cca4a4;color: #521717;border-radius:5px;font-family:sans-serif;'>$msg</div>";
} 

function site_url($uri = '') {
    return SITE_URL . $uri;
}

function isAjaxRequest() {
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' ) {
        return true;
    }
    return false;
}

function dd($var) {
    echo "<pre style='color:#9c4100; position:relative; z-index:999;background:#fff;padding:10px;margin:10px;border-radius:10px;border-left:3px solid #9c4100;'>";
    var_dump($var);
    echo "</pre>";
}

function redirect($url) {
    header("Location: $url");
    die();
}