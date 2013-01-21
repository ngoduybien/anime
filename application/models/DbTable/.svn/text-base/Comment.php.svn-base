<?php
class Application_Model_DbTable_Comment extends Zend_Db_Table_Abstract
{
    protected $_name = 'comments';
    public function addComment ($values, $user_id, $animeID)
    {
        $data = array('anime_id' => $animeID, 'user_id' => $user_id, 
        'content' => $values['comment']);
        $this->insert($data);
    }
    public function getRecentComments ()
    {
        $db = Zend_Db_Table_Abstract::getDefaultAdapter();
        $stmt = $db->query(
        "SELECT Distinct u.username,a.id,a.title,a.picture FROM anime AS a INNER JOIN comments as c on c.anime_id=a.id INNER JOIN user as u on c.user_id=u.user_id ORDER BY c.id DESC limit 10");
        $rows = $stmt->fetchAll();
        return $rows;
    }
    public function getStats ()
    {
        $select = $this->select();
        $select->from($this, array('count(id) as amount'));
        $rows = $this->fetchRow($select);
        return $rows->amount;
    }
    public function updateComment ($values)
    {
        $data = array('content' => $values['content']);
        $where = $this->getAdapter()->quoteInto('id = ?', $values['id']);
        $this->update($data, $where);
    }
    public function deleteComment ($values)
    {
        $where = $this->getAdapter()->quoteInto('id = ?', $values['id']);
        $this->delete($where);
    }
    public function getComment ($user)
    {
        $db = Zend_Db_Table_Abstract::getDefaultAdapter();
        $stmt = $db->query(
        "SELECT Distinct a.* FROM anime AS a INNER JOIN comments as c on c.anime_id=a.id WHERE (user_id = {$user})");
        $rows = $stmt->fetchAll();
        return $rows;
    }
}    