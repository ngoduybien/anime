<?php
class Application_Model_DbTable_Admin extends Zend_Db_Table_Abstract
{
    protected $_name = 'admin';
    
    
    public function checkAdmin($userID){
    	$select = $this->select();
        $select->where('user_id = ?', $userID);
        $row = $this->fetchRow($select);
        if($row['right'] == 1){
        	return true;
        } else{
        	return false;
        }
    }
    
}