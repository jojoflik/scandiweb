<?php
namespace Docky\Router;
class Router {
    public $route,$config;
    public function __construct ($route){
        $this->route = $route;
    }
    public function add ($route, $tpl){
        array_push($this->route, "$route:$tpl");
    }
    public function execute () {
        $this->public_route = $_SERVER['REQUEST_URI'];
    }
    public function run (){
        $this->execute();
        $found = 0;
        foreach ($this->route as $tunnel){
            $tnl = explode(":", $tunnel);
            if ($this->public_route == $tnl[0]){
                $found = 1;
                return $tnl[1];
            }
        }
        if ($found == 0){
            return "TplError";
        }
    }
}
