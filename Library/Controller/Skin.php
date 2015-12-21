<?php
namespace Controller;

use Model\Skins;

class Skin
{
    
    public function index()
    {
        global $char;
        $char = str_replace(".json", "", $char);
        $skin = new Skins();
        $skin->player_name = "16dark";
        $skin->last_update = time();
        $skin->model_preference = array("default", "slim");
        $skin->skins = array(
            "slim" => "67cbc70720c4666e9a12384d041313c7bb9154630d7647eb1e8fba0c461275c6",
            "default"=> "6d342582972c5465b5771033ccc19f847a340b76d6131129666299eb2d6ce66e"
          );
        $skin->cape = "970a71c6a4fc81e83ae22c181703558d9346e0566390f06fb93d09fcc9783799";
        echo json_encode($skin);
        exit();
    }
    
    public function getSkin() 
    {
        global $char;
        //.json
        $char = str_replace(".json", "", $char);
        header('Content-type: image/png');
        $image = file_get_contents(ROOT_PATH."Resource/Skin/".$char.".png");
        echo $image;
    }
    
    
    
}
