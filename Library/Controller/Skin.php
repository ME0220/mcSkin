<?php
/**
 * KK-Framework
 * Author: kookxiang <r18@ikk.me>
 */

namespace Controller;

use Core\Error;
use Core\Template;

class Skin
{
    /**
     * skin json 
     * @JSON
     */
    function index()
    {
        $skin_user = self::skinUser();
        return array('user' => $skin_user);
    }

    private static function skinUser()
    {
        global $skin_user;
        $skin_user = str_replace('skin/', '', $skin_user);
        $skin_user = str_replace('.json', '', $skin_user);
        return $skin_user;
    }
}
