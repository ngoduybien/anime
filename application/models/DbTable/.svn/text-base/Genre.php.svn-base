<?php
class Application_Model_DbTable_Genre extends Zend_Db_Table_Abstract
{
    protected $_name = 'genre_type';
    
	public function getGenreTypes ()
    {
        $select = $this->select();
        $select->from($this, array('genre_name', 'genre_id'))->order('genre_name ASC');
        $rows = $this->fetchAll($select);
        return $rows;
    }
    
	public function insertGenre($values){
    	$data = array(
        	'genre_name' => $values['genre_name']);
        $this->insert($data);
    }
    
    public function updateGenre($values){
    	$data = array(
        	'genre_name' => $values['genre_name']);
    	$where = $this->getAdapter()->quoteInto('genre_id = ?',  $values['genre_id']);
        $this->update($data, $where);
    }
    
    public function deleteGenre($values){
    	$where = $this->getAdapter()->quoteInto('genre_id = ?',  $values['genre_id']);
    	$this->delete($where);
    }
}