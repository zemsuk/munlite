<?php
class View
{
    protected $view;
    protected $data;

    public function __construct($view, $data = [])
    {
        // $this->view = str_replace('.', '/', $view);
        $this->view = str_replace('Controllers/view', 'Controllers/view', $view);
        $this->data = $data;
    }

    public function render()
    {
        extract($this->data);
        ob_start();
        // $viewPath = str_replace('Controllers/view', 'Views', $view);
        include "../App/{$this->view}.php";
        return ob_get_clean();
    }

    public function __toString()
    {
        return $this->render();
    }
}

// The helper function
function view($view, $data = [])
{
    $viewFile = new View($view, $data);
    echo $viewFile;
}