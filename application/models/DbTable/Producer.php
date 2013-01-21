<?php
class Application_Model_DbTable_Producer extends Zend_Db_Table_Abstract
{
    protected $_name = 'producer_names';
    
	public function getProducerNames()
    {
        $select = $this->select();
        $select->from($this, array('prod_name', 'prod_id'))->order('prod_name ASC');
        $rows = $this->fetchAll($select);
        return $rows;
    }
    
	public function insertProducer($values){
    	$data = array(
        	'prod_name' => $values['prod_name']);
        $this->insert($data);
    }
	public function getStats(){
		$select = $this->select();
        $select->from($this, array('count(prod_id) as amount'));
        $rows = $this->fetchRow($select);
        return $rows->amount;
    }
    
    public function updateProducer($values){
    	$data = array(
        	'prod_name' => $values['prod_name']);
    	$where = $this->getAdapter()->quoteInto('prod_id = ?',  $values['prod_id']);
        $this->update($data, $where);
    }
    
    public function deleteProducer($values){
    	$where = $this->getAdapter()->quoteInto('prod_id = ?',  $values['prod_id']);
    	$this->delete($where);
    }
}