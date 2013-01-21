<?php
class Application_Model_DbTable_User extends Zend_Db_Table_Abstract
{
    protected $_name = 'user';
    
    public function getUserID($username){
    	$select = $this->select();
        $select->from($this, array('user_id'))
        	   ->where("username= ?", $username);
        $row = $this->fetchRow($select);
        return $row->user_id;
    }
    
    public function getUserDetails($id){
    	$select = $this->select();
        $select->where("user_id = ?", $id);
        $row = $this->fetchRow($select);
        return $row;	
    }
    
	public function getStats(){
		$select = $this->select();
        $select->from($this, array('count(user_id) as amount'));
        $rows = $this->fetchRow($select);
        return $rows->amount;
    }
    
	public function getNewUsers(){
    	$select = $this->select();
        $select->from($this, array('username', 'location'))
        	   ->order('user_id desc')
        	   ->limit(10,0);
        $row = $this->fetchAll($select);
        return $row;	
    }
    
    public function createUser($values){
        $data = array(
        	'username' => $values['username'],
            'password' => md5($values['password']),
        	'first_name' => $values['first_name'],
            'last_name' => $values['last_name'],
        	'email' => $values['email'],
            'location' => $values['location']); 
        $this->insert($data);
    }
    
 	public function updateUser($username, $values){
    	$data = array();
    	if(isset($values['first_name'])){
    		$data['first_name'] = $values['first_name'];
    	}
 		if(isset($values['last_name'])){
    		$data['last_name'] = $values['last_name'];
    	}
 		if(isset($values['email'])){
    		$data['email'] = $values['email'];
    	}
 		if(isset($values['location'])){
    		$data['location'] = $values['location'];
    	}
    	$where = $this->getAdapter()->quoteInto('username = ?',  $username);
        $this->update($data, $where);
    }
    
	public function deleteUser($values){
    	$where = $this->getAdapter()->quoteInto('username = ?',  $values['user_id']);
    	$this->delete($where);
    }
}    