<?php

namespace app\core\controller\base;

class Controller{

    protected $view, $scripts;

    public function __construct($scripts = [])
    {
        $this->view = "";
        $this->scripts = $scripts;
    }
}