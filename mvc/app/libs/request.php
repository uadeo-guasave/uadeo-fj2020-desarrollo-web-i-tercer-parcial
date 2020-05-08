<?php
namespace App\Libs;
use Controllers;

class Request {
    protected string $url;
    protected string $controller_name;
    protected ?string $controller_action;
    protected string $controller_file;

    public function __construct($url) {
        // mvcfriends.com/user/edit/1
        if (empty($url)) {
            $this->url = "home";
        } else {
            $this->url = $url["url"];
        }

        // segmentar la url
        $seg = explode("/", $this->url);

        $this->getControllerNameAndAction($seg);
        // $this->url = ["1"]
        $this->getControllerFile();
        // var_dump($this->controller_file);
        // exit();
        // Controllers\HomeController::index();
        // var_dump($this->controller_name); // home
        // var_dump($this->controller_action); // index
        // exit();
        $classname =
            "Controllers\\" . ucfirst($this->controller_name) . "Controller";
        // $classname = "Controllers\HomeController";
        $controller = new $classname;
        // TODO: como obtener los parametros
        // TODO: como manipular los métodos de las peticiones
        // TODO: como definir y utilizar rutas de la app
        var_dump($seg);
        exit();
        call_user_func_array([$controller, $this->controller_action], [1]);
    }

    protected function getControllerNameAndAction(&$seg) {
        // segmentar la url
        // mvcfriends.com
        // mvcfriends.com/user/all
        // mvcfriends.com/user/edit/1
        // mvcfriends.com/user/save
        // mydomain.com/controller/action/param
        
        // user/all = ["user", "all"]
        $this->controller_name = array_shift($seg);
        // ["all"]
        if (!($this->controller_action = array_shift($seg))) {
            $this->controller_action = "index";
        }
    }

    protected function getControllerFile() {
        $this->controller_file =
            CONTROLLERS_DIR . $this->controller_name . "Controller.php";
    }

    public function call($url) {
        if (is_readable($this->controller_file)) {
            require_once $this->controller_file;
        } else {
            http_response_code(404);
            exit("Pagina no encontrada");
        }
    }
}
