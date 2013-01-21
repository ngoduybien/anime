<?php
class Application_Model_DbTable_Actor extends Zend_Db_Table_Abstract
{
    protected $_name = 'actor';
    
    
    public function addActor($values){
        $data = array(
        	'first_name' => isset($values['first_name']),
            'last_name' => isset($values['last_name']),
        	'jap_first_name' => isset($values['jap_first_name']),
        	'jap_last_name' => isset($values['jap_last_name']),
        	'birthday' => isset($values['birthday']),
        	'description' => isset($values['description']),);
        $this->insert($data);
    }
    
	public function updateActor($values){
    	$data = array(
        	'description' => $values['description']);
    	$where = $this->getAdapter()->quoteInto('actor_id = ?',  $values['actor_id']);
        $this->update($data, $where);
    }
    
    public function deleteActor($values){
    	$where = $this->getAdapter()->quoteInto('actor_id = ?',  $values['actor_id']);
    	$this->delete($where);
    }
    
    public function getActor($values){
    	$select = $this->select();
        $select->where('actor_id = ?',  $values['actor_id']);
        $row = $this->fetchRow($select);
        return $row;
    }
}    
