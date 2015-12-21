<?php
/**
 * Router
 * Author: kookxiang <r18@ikk.me>
 */
namespace Core;

class Router extends DefaultRouter
{
    
    public function findController($requestPath, $subDir = '') {
        list($controller, $method) = explode('/', $requestPath, 2);

        $controller = ucfirst($controller);
        
        if(stristr($requestPath, "skin")) {
            global $char;
            $char = $method;
            $method= 'Index';
        }

        if (is_dir(LIBRARY_PATH . "Controller/{$subDir}{$controller}")) {
            if (!$method) {
                $method = 'Index';
            }
            $this->findController($method, $subDir . $controller . '/');
        } elseif (file_exists(LIBRARY_PATH . "Controller/{$subDir}{$controller}.php")) {
            if (!$method) {
                $method = 'index';
            } else {
                $method = lcfirst($method);
            }
            $classname = str_replace('/', '\\', "Controller/{$subDir}{$controller}");

            $controller = new $classname();

            if (method_exists($controller, $method)) {
                $controller->$method();
                $this->foundController = true;
            }
        }
    }
}