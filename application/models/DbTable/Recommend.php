<?php
class Application_Model_DbTable_Recommend extends Zend_Db_Table_Abstract
{
    protected $_name = 'recommended';
    
    
    public function addRecommedation($animeID, $recommendedBy_id, $user_id, $description){
        $data = array(
        	'anime_id1' => $animeID,
            'anime_id2' => $recommendedBy_id,
        	'user_id' => $user_id,
        	'description' => $description);
        $this->insert($data);
    }
    
	public function getRecommendedList($user, $currentAime)
	{
		$db = Zend_Db_Table_Abstract::getDefaultAdapter();
		$stmt = $db->query("SELECT anime_id2, title FROM recommended, anime a where anime_id1={$currentAime} and user_id={$user} and anime_id2=a.id");
        $rows = $stmt->fetchAll();         
        return $rows;
	}
	
	public function getRecommendingList($user, $currentAime)
	{	
		$recommended = $this->getRecommendedList($user, $currentAime);
		$db = Zend_Db_Table_Abstract::getDefaultAdapter();
		if (count($recommended)>0){
			$str = "";
			for ($i=0;$i<count($recommended)-1;$i++){
				$str = $str.$recommended[$i]['anime_id2'].",";
			}
			$str = $str.$recommended[count($recommended)-1]['anime_id2'];
			$stmt = $db->query("SELECT ul.anime_id, ul.user_id, a.title FROM user_list ul, anime a where user_id={$user} and a.id=ul.anime_id and a.id<>{$currentAime} and a.id not in ({$str}) ORDER BY a.title ASC");
		} else{
			$stmt = $db->query("SELECT ul.anime_id, ul.user_id, a.title FROM user_list ul, anime a where user_id={$user} and a.id=ul.anime_id and a.id<>{$currentAime} ORDER BY a.title ASC");
		}
		
		
        $rows = $stmt->fetchAll();         
        return $rows;
	}
	
    public function getUserRecs($user)
    {
    	$db = Zend_Db_Table_Abstract::getDefaultAdapter();
		$stmt = $db->query("SELECT r.id, anime_id1, anime_id2, description FROM recommended r JOIN anime a ON r.anime_id1 = a.id WHERE user_id = ? ORDER BY a.title ASC", $user);
        $rows = $stmt->fetchAll();         
        return $rows;
    }
    
    public function getRec($id)
    {
    	$db = Zend_Db_Table_Abstract::getDefaultAdapter();
		$stmt = $db->query("SELECT * FROM recommended WHERE id = ?", $id);
        $row = $stmt->fetch();         
        return $row;
    }
    public function deleteRec($id)
    {
    	$db = Zend_Db_Table_Abstract::getDefaultAdapter();
        $db->delete('recommended', "id = '{$id}'");         
    }
    
    public function updateRec($id, $desc)
    {
    	$data = array("description" => $desc);
    	$where = $this->getAdapter()->quoteInto('id = ?',  $id);
        $this->update($data, $where);
    }
	
}    