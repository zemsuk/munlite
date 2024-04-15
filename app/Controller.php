<?php
namespace App;
class Controller
{
    protected function view($view, $data = [])
    {
        extract($data);
        include "$view.php";
        // include "Views/$view.php";
    }
}
