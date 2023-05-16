<?php

use config\Config;

class Router {

    protected $uri;

    protected $controller;

    protected $action;

    protected $params;

    protected $route;

    protected $method_prefix;

    /**
     *
     * @return mixed
     */
    function getUri() {
        return $this->uri;
    }

    /**
     *
     * @return mixed
     */
    function getController() {
        return $this->controller;
    }

    /**
     *
     * @return mixed
     */
    function getAction() {
        return $this->action;
    }

    /**
     *
     * @return mixed
     */
    function getParams() {
        return $this->params;
    }

    function getRoute() {
        return $this->route;
    }

    function getMethodPrefix() {
        return $this->method_prefix;
    }

    public function __construct($uri) {
        $this->uri = urldecode(trim($uri, "/"));
        //defaults
        $routes = Config::$routes;
        $this->route = Config::get("default_route");
        $this->controller = Config::get("default_controller");
        $this->action = Config::get("default_action");
        $this->method_prefix= isset($routes[$this->route]) ? $routes[$this->route] : '';


        //get uri params
        $uri_parts = explode("?", $this->uri);
        $path = $uri_parts[0];
        $path_parts = explode("/", $path);

        if(count($path_parts)){
            //get route
            if(in_array(strtolower(current($path_parts)), array_keys($routes))){
                $this->route = strtolower(current($path_parts));
                $this->method_prefix = isset($routes[$this->route]) ? $routes[$this->route] : '';
                array_shift($path_parts);
            }

            //get controller
            if(current($path_parts)){
                $this->controller = strtolower(current($path_parts));
                array_shift($path_parts);
            }

            //get action
            if(current($path_parts)){
                $this->action = strtolower(current($path_parts));
                array_shift($path_parts);
            }

            //reset is for parameters
            //$this->params = $path_parts;
            //processing params from url to array
            $aParams = array();
            if(current($path_parts)){
                for($i=0; $i<count($path_parts); $i++){
                    $aParams[$path_parts[$i]] = isset($path_parts[$i+1]) ? $path_parts[$i+1] : null;
                    $i++;
                }
            }

            $this->params = (object)$aParams;
        }

    }
}