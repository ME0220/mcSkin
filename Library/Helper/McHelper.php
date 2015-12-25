<?php
/**
 * mc Skin
 * minecraft skin server panel
 * Author: Sendya <18x@loacg.com>
 */

namespace Helper;


class McHelper {

    public static function getSaltedHash($str, $salt) {
        return "\$SHA\$" . $salt . "$" . McHelper::getSHA256(McHelper::getSHA256($str) . $salt);
    }

    public static function getSHA256($str) {
        return hash("sha256", $str);
    }

}