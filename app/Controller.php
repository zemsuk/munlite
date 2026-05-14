<?php
namespace App;
class Controller
{
    protected function view($view, $data = [])
    {
        extract($data);
        $viewPath = str_replace('Controllers/view', 'Views', $view);
        if (file_exists("$viewPath.php")) {
            include "$viewPath.php";
        } else {
            include "$view.php";
        }
    }
}
