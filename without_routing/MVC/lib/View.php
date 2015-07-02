<?php
namespace lib;

class View{
    protected $file;
    public $vars = [];

    public function assign($name, $value)
    {
        $this->vars[$name] = $value;
    }

    public function setFile($file)
    {
        $this->file = $file;
    }

    public function show()
    {
        extract($this->vars);
        include_once $this->file;
    }
}