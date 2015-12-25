<?php
namespace Model;

class Skin {
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
    public static function GetSkinByUserId($userId) {
        $statement = Database::prepare("SELECT * FROM skin WHERE uid=?");
        $statement->bindValue(1, $userId, \PDO::PARAM_INT);
        $statement->execute();
        $statement->setFetchMode(\PDO::FETCH_CLASS, '\\Model\\Skin');
        return $statement->fetch(\PDO::FETCH_CLASS);
    }

    /**
     * Get a skin by payer name
     * @param $playerName String
     * @return Skin
     */
    public static function GetSkinByPlayerName($playerName) {
        $statement = Database::prepare("SELECT * FROM skin WHERE player_name=?");
        $statement->bindValue(1, $playerName, \PDO::PARAM_STR);
        $statement->execute();
        $statement->setFetchMode(\PDO::FETCH_CLASS, '\\Model\\Skin');
        return $statement->fetch(\PDO::FETCH_CLASS);
    }

    /**
     * Insert current user into database
     * @return int Auto-generated UserID for this user
     */
    public function insertToDB() {
        $inTransaction = Database::inTransaction();
        if (!$inTransaction) {
            Database::beginTransaction();
        }
        $statement = Database::prepare("INSERT INTO skin SET uid=:uid, `player_name`=:player_name, last_update=:last_update, preference=:preference, alex=:alex, steve=:steve, cape=:cape");
        $statement->bindValue(':uid', $this->uid, \PDO::PARAM_INT);
        $statement->bindValue(':player_name', $this->player_name, \PDO::PARAM_STR);
        $statement->bindValue(':last_update', $this->last_update, \PDO::PARAM_INT);
        $statement->bindValue(':preference', $this->preference, \PDO::PARAM_STR);
        $statement->bindValue(':alex', $this->alex, \PDO::PARAM_STR);
        $statement->bindValue(':steve', $this->steve, \PDO::PARAM_STR);
        $statement->bindValue(':cape', $this->cape, \PDO::PARAM_STR);
        $statement->execute();
        if (!$inTransaction) {
            Database::commit();
        }
    }

    public function update() {
        $inTransaction = Database::inTransaction();
        if (!$inTransaction) {
            Database::beginTransaction();
        }
        $statement = Database::prepare("UPDATE skin SET uid=:uid, `player_name`=:player_name, last_update=:last_update, preference=:preference, alex=:alex, steve=:steve, cape=:cape");
        $statement->bindValue(':uid', $this->uid, \PDO::PARAM_INT);
        $statement->bindValue(':player_name', $this->player_name, \PDO::PARAM_STR);
        $statement->bindValue(':last_update', $this->last_update, \PDO::PARAM_INT);
        $statement->bindValue(':preference', $this->preference, \PDO::PARAM_STR);
        $statement->bindValue(':alex', $this->alex, \PDO::PARAM_STR);
        $statement->bindValue(':steve', $this->steve, \PDO::PARAM_STR);
        $statement->bindValue(':cape', $this->cape, \PDO::PARAM_STR);
        $statement->execute();
        if (!$inTransaction) {
            Database::commit();
        }
    }

}