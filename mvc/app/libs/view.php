<?php
namespace App\Libs;

class View {
    static function make(string $name, $vars = []) {
        extract($vars);
        $file = VIEWS_DIR.$name.".tpl.php";
        if (file_exists($file)) {
            require $file;
        } else {
            http_response_code(404);
            exit("La vista $name no existe");
        }
    }
}