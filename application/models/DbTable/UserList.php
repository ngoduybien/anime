<?php
class Application_Model_DbTable_UserList extends Zend_Db_Table_Abstract
{
    protected $_name = 'user_list';
    //Returns the user's watched anime titles and ID
    public function getWatched ($user)
    {
        $db = Zend_Db_Table_Abstract::getDefaultAdapter();
        $stmt = $db->query(
        "SELECT ul.*,a.id,a.title,a.picture FROM anime AS a INNER JOIN user_list as ul on ul.anime_id=a.id WHERE (user_id = {$user}) ORDER BY a.title ASC");
        $rows = $stmt->fetchAll();
        return $rows;
    }
    public function getAnimeInListInfo ($userID, $animeID)
    {
        $select = $this->select();
        $select->from($this, array('status', 'score'))
            ->where("anime_id= ?", $animeID)
            ->where("user_id= ?", $userID);
        $row = $this->fetchRow($select);
        return $row;
    }
    public function getStats ()
    {
        $select = $this->select();
        $select->from($this, array('count(id) as amount'));
        $rows = $this->fetchRow($select);
        return $rows->amount;
    }
    public function getRecentlyWatched ()
    {
        $db = Zend_Db_Table_Abstract::getDefaultAdapter();
        $stmt = $db->query(
        "SELECT ul.*,a.title,a.picture FROM anime AS a INNER JOIN user_list as ul on ul.anime_id=a.id ORDER BY ul.id DESC limit 10");
        $rows = $stmt->fetchAll();
        return $rows;
    }
    //Adds a new anime to one of a user's lists
    public function addToList ($anime_ID, $user, $list_type, $score)
    {
        $data = array('anime_id' => $anime_ID, 'user_id' => $user, 
        'status' => $list_type, 'score' => $score);
        $this->insert($data);
    }
    //Adds a new anime to one of a user's lists
    public function updateList ($animeID, $user, $status, $score)
    {
        $db = Zend_Db_Table_Abstract::getDefaultAdapter();
        $stmt = $db->query(
        "Update user_list set status={$status},score={$score} where anime_id={$animeID} and user_id={$user} ");
    }
    //Changes the score of one of the user's favorite animes
    public function changeScore ($anime, $newScore, $user)
    {
        $data = array('score' => $newScore);
        $this->update($data, '$anime = {anime_id} AND user_id = {$user}');
    }
    //Remove an anime from a list
    public function removeAnime ($anime, $user)
    {
        $this->delete("anime_id = {$anime} AND user_id = {$user}");
    }
    public function isInList ($user, $anime)
    {
        $select = $this->select();
        $select->where('user_id = ?', $user)->where('anime_id = ?', $anime);
        $row = $this->fetchRow($select);
        if ($row == null)
            return false;
        return true;
    }
}
