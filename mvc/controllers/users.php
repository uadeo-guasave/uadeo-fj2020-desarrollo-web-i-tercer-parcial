<?php
require "models/users.php";

$users = getAllUsers();

view("users", ["title" => "Vista Users", "users" => $users]);