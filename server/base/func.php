<?php

require_once __DIR__ . './../config/Config.php';

/**
 * @return string
 */
function getRootUrl() {
    if(isset($_SERVER['HTTPS'])){
        $protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
    }
    else{
        $protocol = 'http';
    }
    return 
        $protocol . 
        '://' . 
        $_SERVER['SERVER_NAME'] . 
        (isset($_SERVER['SERVER_PORT']) && !empty($_SERVER['SERVER_PORT'])
            ? ':' . $_SERVER['SERVER_PORT']
            : '') .
        dirname($_SERVER["REQUEST_URI"] . '?') 
        . '/';
}

/**
 * @param $obj
 */
function jsConsoleLog($obj) {
    echo "<script>" .
            "console.log(" .
                "JSON.parse('" .
                    str_replace("'", "", json_encode($obj))
                . "')" .
            ")" .
        "</script>";
}
