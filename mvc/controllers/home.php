<?php
namespace MVC\Controllers;
use App\Libs\View;

function index() {
    View::make("home", ["title" => "Vista Home"]);
}

index();