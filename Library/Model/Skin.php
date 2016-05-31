<?php
namespace Model;

use Core\Model;
use Core\Database as DB;
/**
 * Class Skin
 * @table mc_skin
 * @package Model
 */
class Skin extends Model {

    private $primaryKey = 'uid';// 定义主键

    public $uid;
    public $player_name;
    public $last_update;
    public $preference;
    public $alex;
    public $steve;
    public $cape;

    /**
     * Get a skin by UserId
     * @param $userId int UserID
     * @return Skin
     */
    public static function getSkinByUserId($userId) {
        $stn = DB::sql("SELECT * FROM mc_skin WHERE uid=?");
        $stn->bindValue(1, $userId, DB::PARAM_INT);
        $stn->execute();
        return $stn->fetchObject(__CLASS__);
    }

    /**
     * Get a skin by payer name
     * @param $playerName String
     * @return Skin
     */
    public static function getSkinByPlayerName($playerName) {
        $stn = DB::sql("SELECT * FROM mc_skin WHERE player_name=?");
        $stn->bindValue(1, $playerName, DB::PARAM_STR);
        $stn->execute();
        return $stn->fetchObject(__CLASS__);
    }

}