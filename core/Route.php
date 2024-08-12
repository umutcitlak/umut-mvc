<?php

namespace Core;

class Route
{

    public function router()
    {

        $controller = "App\\Controllers\\HomeController";
        $method = "index";
        $param = "";

        $url = $_SERVER['REQUEST_URI'];

        $url = strtolower(filter_var($url, FILTER_SANITIZE_URL));
        $url = trim($url, "/");

        $url = explode("/", $url);
        if (count($url) > 0 && $url[0] != "") {
            $controller = "App\\Controllers\\" . ucfirst($url[0]) . "Controller";
            if (isset($url[1]) && $url[1] != "") {
                $method = $url[1];
            }
            if (isset($url[2])) {
                $param = $url[2];
            }

            $controller = new $controller();

            $controller->$method($param);
        } else {
            $controller = new $controller("Home");
            $controller->$method($param);
        }
    }
}
