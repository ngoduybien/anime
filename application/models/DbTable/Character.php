<?php
class Application_Model_DbTable_Character extends Zend_Db_Table_Abstract
{
    protected $_name = 'character';
    
    
    public function addCharacter($values){
        $data = array(
        	'name' => isset($values['name']),
        	'jap_name' => isset($values['jap_name']),
        	'description' => isset($values['description']),);
        $this->insert($data);
    }
    
	public function updateCharacter($values){
    	$data = array(
        	'description' => $values['description']);
    	$where = $this->getAdapter()->quoteInto('character_id = ?',  $values['character_id']);
        $this->update($data, $where);
    }
    
    public function deleteCharacter($values){
    	$where = $this->getAdapter()->quoteInto('character_id = ?',  $values['character_id']);
    	$this->delete($where);
    }
    
    public function getCharacter($values){
    	$select = $this->select();
        $select->where('character_id = ?',  $values['character_id']);
        $row = $this->fetchRow($select);
        return $row;
    }
}    
