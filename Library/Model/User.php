<?php
/**
 * MineCraft Skin web server
 * A simple minecraft character management system.
 * Author: kookxiang <r18@ikk.me>
 */
namespace Model;

use Core\Database as DB;
use Core\Model;

/**
 * Class User
 * @table mc_user
 * @package Model
 */
class User extends Model {

    public $id;
    public $username;
    private $password = 'FAKE-PASSWORD';
    public $ip;
    public $lastlogin;
    public $x;
    public $y;
    public $z;
    public $world;
    public $email;
    public $isLogged;

    /** @ignore */
    public $lastActive = TIMESTAMP;

    /**
     * @return User
     */
    public static function getCurrent()
    {
        /** @var User $user */
        $user = $_SESSION['currentUser'];
        if ($user && TIMESTAMP - $user->lastActive > 600) {
            $userObj = self::getUserById($user->id);
            if (!$userObj) {
                $user = null;
            } elseif ($user->password != $userObj->password) {
                // Password changed
                $user = null;
            } else {
                $userObj->lastActive = TIMESTAMP;
                $user = $userObj;
            }
        }
        $_SESSION['currentUser'] = $user;
        return $user;
    }

    /**
     * get user by id
     * @param $id
     * @return User
     */
    public static function getUserById($id)
    {
        $stn = db::sql('SELECT * FROM mc_user WHERE id=?');
        $stn->bindValue(1, $id, DB::PARAM_INT);
        $stn->execute();
        return $stn->fetchObject(__CLASS__);
    }

    

}
