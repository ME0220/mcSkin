<?php
/**
 * KK-Framework
 * Author: kookxiang <r18@ikk.me>
 */

namespace Core;

class Router extends DefaultRouter
{

    function __construct()
    {
        if (!defined('KK_START')) {
            define('KK_START', microtime(true));
        }
    }

    public function handleRequest()
    {
        $requestPath = Request::getRequestPath();
        $requestPath = ltrim($requestPath, '/');
        if(stripos($requestPath, 'skin/') !== false) {
        	global $skin_user;
        	$skin_user = $requestPath;
        	$requestPath = 'Skin.json';
        }
        if (!$requestPath) {
            $requestPath = 'Index';
        }
        Filter::preRoute($requestPath);
        $this->findController($requestPath);
        if (!$this->foundController) {
            throw new Error('The request URL is not exists', 404);
        }
    }

    public static function execTime()
    {
        return round(microtime(true) - KK_START, 4);
    }
}
