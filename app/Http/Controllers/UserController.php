<?php

namespace App\Http\Controllers;

class UserController extends Controller {
    public function index() {
        echo json_encode(["name" => "孫悟空"]);
    }
}
