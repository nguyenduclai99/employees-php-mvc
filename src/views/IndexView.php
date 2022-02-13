<?php

class IndexView
{

    private $content;


    public function __construct()
    {
        $tmp = \debug_backtrace();
        $this->controller = \str_replace("controller", "", \strtolower($tmp[1]['class']));
        $this->action = \str_replace("action", "", \strtolower($tmp[1]['function']));
    }


    public function __destruct()
    {
        include '../src/views/layout/layout.phtml';
    }


    public function renderView($variables = null, $message = "", $type = "success")
    {
        \ob_start();
        require "../src/views/{$this->controller}/{$this->action}.phtml";
        $this->content = \ob_get_clean();
    }


    public function indexView()
    {
        $this->content = "Blog sample.
        Click <a href ='/about'>here</a> to see";
    }


}