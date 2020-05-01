<?php
namespace Controllers;

class AboutController {
    public static function index() {
        view("about", ["title" => "Vista About"]);
    }

}
