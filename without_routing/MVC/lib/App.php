<?php

namespace lib;

class App
{
    public $request;
    protected $db;

    public function __construct()
    {
        $this->request = $_REQUEST;
    }

    public function run()
    {

        $class = '\\controller\\' . $this->getController() . 'Controller';
        $action = $this->getAction() . 'Action';

        $command = new $class($this);
        $command->$action();
    }

    public function getController()
    {
        if (array_key_exists('controller', $this->request)) {
            return ucfirst($this->request['controller']);
        }
        return 'Index';
    }

    public function getAction()
    {
        if (array_key_exists('action', $this->request)) {
            return $this->request['action'];
        }

        return 'index';
    }

    public function getDBConnection()
    {
        if(!$this->db){
            $config = $this->getConfig();
            $this->db = mysqli_connect($config['host'],$config['user'],$config['password']);
        }

        return $this->db;
    }
    public function getConfig()
    {
        parse_ini_file(__DIR__ . '/../config/config.ini');

    }

    public function getModel($name)
    {
        $class = '\\model\\' . ucfirst($name) . 'Model';
        return new $class($this->getDBConnection());
    }
}