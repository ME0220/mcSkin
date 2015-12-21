<?php
namespace Controller;

class Update
{
    public function index()
    {
        echo "最新启动器： ver 1.0.1111.3</br>";
        echo "下载地址：http://download.loacg.com/minecraft/launcher/mclauncher.exe";
    }
    public function check()
    {
        $data['version'] = "1.0.1111.3";
        $data['error'] = "0";
        echo json_encode($data);
        exit();
    }
}