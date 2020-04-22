<?php
require MODELS_DIR."users.php";

$users = getAllUsers();

view("users", ["title" => "Vista Users", "users" => $users]);