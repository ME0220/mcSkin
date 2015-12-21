<?php

namespace Controller;

use \Model\Server as ServerInfo;

class Server
{
    public function index()
    {
        $host = $_REQUEST['host'];
        if($host == null || $host == '') $host = '119.29.99.138';
        $info = ServerInfo::GetServerInfo($host);
        echo json_encode($info);
        exit();
    }
}