<?php
/*
 * App core class
 * Creates URL & loads core controller
 * URL FORMAT - /controller/method/params
 * */

class Core{
    protected $currentController='Pages';
    protected $currentMethod='index';
    protected $params=[];

    public function __construct()
    {
        print_r($this->getURL());
        $url=$this->getURL();
        // look in controllers for first value
        if(!is_null($url)){
            if(file_exists('../app/controllers/'.ucwords($url[0]).'.php')){
//            if exists, set as controller
                $this->currentController=ucwords($url[0]);
//            unset 0 index
                unset($url[0]);
            }
        }

//        require the controller
        require_once "../app/controllers/".$this->currentController . '.php';

//        instantiate controller class
        $this->currentController=new $this->currentController;

    }

    protected function getURL(){
        if(isset($_GET['url'])){
            $url=$_GET['url'];
            $url=rtrim($url,'/');
            $url=filter_var($url,FILTER_SANITIZE_URL);
            $url=explode("/",$url);
            return $url;
        }
    }
}

// implode is array to string, and explode is string to array