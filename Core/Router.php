<?php namespace Core;


class Router
{
    protected $routes = [];
    protected $param;
    protected $namespace = 'App\Controllers\\';

    public function add($route, $params)
    {

        $route = $this->regix($route);
        is_string($params) ? list($allparams['controller'], $allparams['method']) = explode('@', $params) : false;
        $allparams = $this->isArray($params, $allparams);
        $this->routes[$route] = $allparams;
    }

    public function match($url)
    {
        foreach ($this->routes as $route => $params) {
            if (preg_match($route, $url, $matches)) {
                foreach ($matches as $key => $match) {
                    if (is_string($key)) {
                        $params['param'][$key] = $match;
                    }
                }
                $this->param = $params;
                return true;
            }
        }
        return false;
    }

    /**
     * @throws \Exception
     */
    public function dispatch($url)
    {
        $url = $this->removevariablequeristring($url);
        if (!$this->match($url)) {
            throw new \Exception("no rute match.", 404);
        }
        $controller = $this->param['controller'];
        $controller = $this->getnamespace() . $controller;
        if (!class_exists($controller)) {
            throw new \Exception("controller class {$controller} not found.");
        }
        $controller_object = new $controller();
        $methode = $this->param['method'];
        if (!is_callable([$controller_object, $methode])) {
            throw new \Exception("Method {$methode} incontroller {$controller} not found.");
        }
        if ($controller_object->before() == true) {
            $this->param['param'] = $this->param['param'] ?? [];
            echo call_user_func_array([$controller_object, $methode], $this->param['param']);
            $controller_object->after();
        }
    }

    public function getroute()
    {
        return $this->routes;
    }

    public function getparam()
    {
        return $this->param;
    }

    public function getnamespace()
    {
        $namespace = $this->namespace;
        if (array_key_exists('namespace', $this->param)) {
            $namespace .= $this->param['namespace'] . '\\';
        }
        return $namespace;
    }

    public function removevariablequeristring($url)
    {
        if ($url != '') {
            $parts = explode('&', $url, 2);
            if (strpos($parts[0], '=') === false) {
                $url = $parts[0];
            } else {
                $url = '';
            }
            return $url;
            //  var_dump($parts);die;
        }
    }

    /**
     * @param $route
     * @return array|string|string[]|null
     */
    private function regix($route)
    {
        $route = preg_replace('/^\//', '', $route);
        $route = preg_replace('/\//', '\\/', $route);
        $route = preg_replace('/\{([a-z]+)\}/', '(?<$1>[a-z0-9-]+)', $route);
        return '/^' . $route . '\/?$/i';
    }

    /**
     * @param $params
     * @param array $allparams
     * @return
     */
    private function isArray($params, $allparams)
    {
        if (is_array($params)) {
            list($allparams['controller'], $allparams['method']) = explode('@', $params['uses']);
            unset($params['uses']);
            $allparams = array_merge($allparams, $params);
        }
        return $allparams;
    }

}