<?php
namespace App\Libs;

class Request {
    protected string $url;
    protected string $controller_name;
    protected string $controller_action;
    protected string $controller_file;

    public function __construct($url)
    {
        if (empty($url)) {
            $this->url = "home";
        } else {
            $this->url = $url["url"];
        }
        $this->getControllerAndAction();
        $this->getControllerFile();
        // call
    }

    protected function getControllerAndAction() {
        // segmentar la url
        // mvcfriends.com
        // mvcfriends.com/user/all
        // mvcfriends.com/user/edit/1
        // mvcfriends.com/user/save
        // mydomain.com/controller/action/param1/param2/param3
        $seg = explode("/", $this->url);
        $this->controller_name = $seg[0];
        if (count($seg) > 1) {
            $this->controller_action = $seg[1];
        } else {
            $this->controller_action = "index";
        }
    }

    protected function getControllerFile() {
        $this->controller_file = CONTROLLERS_DIR . $this->controller_name . ".php";
        // var_dump($this->controller_file);
        // exit();
    }

    public static function call($url) {
        $req = new Request($url);
        if (is_readable($req->controller_file)) {
            require_once $req->controller_file;
        } else {
            http_response_code(404);
            exit("Pagina no encontrada");
        }
    }
}