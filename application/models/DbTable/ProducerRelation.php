<?php
class Application_Model_DbTable_ProducerRelation extends Zend_Db_Table_Abstract
{
    protected $_name = 'producers';
    
	public function insertProducer($id, $values){
    	$db = Zend_Db_Table_Abstract::getDefaultAdapter();
    	if (isset($values['producer'])){
    		foreach($values['producer'] as $prod){
				$stmt = $db->query("Insert INTO producers (producer_id, anime_id) VALUES ({$prod}, {$id})");
    		}	
    	}
    }
    
    public function deleteProducer($id){
    	$db = Zend_Db_Table_Abstract::getDefaultAdapter();
    	$stmt = $db->query("Delete FROM producers where anime_id = {$id}");
    }
}   
