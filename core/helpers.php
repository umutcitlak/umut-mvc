<?php
if (!function_exists('dd')) {
    function dd($data)
    {
        echo '<pre>';
        print_r($data);
        echo '</pre>';
        die();
    }
}

// sesion açılmışmı kullanıcı olup olmadığını kontrol edin
function isLoggedIn()
{
    if( isset($_SESSION['user']));
}