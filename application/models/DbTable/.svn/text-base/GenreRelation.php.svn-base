<?php
class Application_Model_DbTable_GenreRelation extends Zend_Db_Table_Abstract
{
    protected $_name = 'genres';
    
	public function insertGenre($id, $values){
        $db = Zend_Db_Table_Abstract::getDefaultAdapter();
        if (isset($values['genres'])){
      	  foreach($values['genres'] as $genre){
			$stmt = $db->query("Insert INTO genres (genre_id, anime_id) VALUES ({$genre}, {$id})");
      	  }	
        }
    }
    
    public function deleteGenre($id){
    	$db = Zend_Db_Table_Abstract::getDefaultAdapter();
    	$stmt = $db->query("Delete FROM genres where anime_id = {$id}");
    }
}    