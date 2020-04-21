<?php
/**
 * Funciones para que la app opere correctamente
 */

function view(string $name, $vars = []) {
    extract($vars);
    $file = "views/$name.tpl.php";
    if (file_exists($file)) {
        require $file;
    } else {
        http_response_code(404);
        exit("La vista $name no existe");
    }
}

function controller(array $url) {
    if (empty($url)) {
        require "controllers/home.php";
    } elseif (isset($url['url'])) {
        $file = "controllers/" . $url['url'] . ".php";
        if (file_exists($file)) {
            require $file;
        } else {
            http_response_code(404);
            exit("Pagina no encontrada");
        }
    }
}
