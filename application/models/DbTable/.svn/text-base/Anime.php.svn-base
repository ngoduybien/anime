<?php
class Application_Model_DbTable_Anime extends Zend_Db_Table_Abstract
{
    protected $_name = 'anime';
    
    public function getAnimeList ()
    {
        $select = $this->select();
        $select->from($this, array('id', 'title', 'picture'))->order('title ASC');
        $rows = $this->fetchAll($select);
        return $rows;
    }
    
	public function getStats(){
		$select = $this->select();
        $select->from($this, array('count(id) as amount'));
        $rows = $this->fetchRow($select);
        return $rows->amount;
    }
    
    public function leastViewed(){
    	$select = $this->select();
        $select->from($this, array('id', 'title', 'picture'))->order('views ASC');
        $rows = $this->fetchRow($select);
        return $rows;
    }
	public function getTopTen()
    {
        $select = $this->select();
        $select->from($this, array('id', 'title', 'picture'))->order('views DESC')
        	   ->limit(10,0);
        $rows = $this->fetchAll($select);
        return $rows;
    }
    
    public function getAnime ($id = 0)
    {
        $select = $this->select();
        $select->where("id={$id}");
        $row = $this->fetchRow($select);
        return $row;
    }
    
    public function addAnime($values){
    	$data = array(
        	'title' => $values['title'],
            'eng_title' => $values['eng_title'],
        	'jap_title' => $values['jap_title'],
            'other_titles' => $values['other_titles'],
    		'summary' => $values['summary'],
        	'type' => $values['type'],
            'status' => $values['type'],
    		'duration' => $values['duration'],
    		'rating' => $values['rating'],
    		'open_theme' => $values['open_theme'],
    		'end_theme' => $values['end_theme'],
    		'picture' => $values['picture'],
    		'aired_date' => $values['aired_date'],
    		'episodes' => $values['episodes']);
        return $this->insert($data);        
    }
    
    public function updateAnime($id, $values){
    	$data = array(
        	'title' => $values['title'],
            'eng_title' => $values['eng_title'],
        	'jap_title' => $values['jap_title'],
            'other_titles' => $values['other_titles'],
    		'summary' => $values['summary'],
        	'type' => $values['type'],
            'status' => $values['type'],
    		'duration' => $values['duration'],
    		'rating' => $values['rating'],
    		'open_theme' => $values['open_theme'],
    		'end_theme' => $values['end_theme'],
    		'picture' => $values['picture'],
    		'aired_date' => $values['aired_date'],
    		'episodes' => $values['episodes']);
    	$where = $this->getAdapter()->quoteInto('id = ?',  $id);
        $this->update($data, $where);
    }
    
 	public function deleteAnime($id){
    	$where = $this->getAdapter()->quoteInto('id = ?',  $id);
    	$this->delete($where);
    }
    
    public function getGenres ($id)
    {
        $db = Zend_Db_Table_Abstract::getDefaultAdapter();
		$stmt = $db->query("Select gt.genre_name, gt.genre_id From genre_type gt join genres g on g.genre_id=gt.genre_id where g.anime_id='{$id}'");
        $rows = $stmt->fetchAll();
        return $rows;
    }
    
    
	public function getProducers ($id)
    {
        $db = Zend_Db_Table_Abstract::getDefaultAdapter();
		$stmt = $db->query("Select pn.prod_name, pn.prod_id From producer_names pn join producers p on pn.prod_id=p.producer_id where p.anime_id='{$id}'");
        $rows = $stmt->fetchAll();
        return $rows;
    }
    
	public function getComments($id)
    {
        $db = Zend_Db_Table_Abstract::getDefaultAdapter();
		$stmt = $db->query("Select c.date,c.content,u.username From comments c join user u on c.user_id=u.user_id where c.anime_id='{$id}'");
        $rows = $stmt->fetchAll();
        return $rows;
    }
    
	public function getRecommends($id)
    {
        $db = Zend_Db_Table_Abstract::getDefaultAdapter();
		$stmt = $db->query("Select a.title,u.username,r.anime_id2, r.description From recommended r join user u on r.user_id=u.user_id join anime a on r.anime_id2=a.id where anime_id1='{$id}' limit 10");
        $rows = $stmt->fetchAll();
        return $rows;
    }
    
    public function search($values) 
    {
        $select = $this->select();
        $select->where('title like ?', "%{$values['title']}%");
        $rows = $this->fetchAll($select);
        return $rows;
    }
    
    public function advSearch($values){
    	$select = $this->select();
    	if($values['title']!=''){
        	$select->where('title like ?', "%{$values['title']}%");
    	}	
    	if($values['status'] > 0){
    		$select->where('status = ?', "{$values['status']}");
    	}
    	if($values['rating'] >= 0){
    		$select->where('rating = ?', "{$values['rating']}");
    	}
    	if($values['type'] >= 0){
    		$select->where('type = ?', "{$values['type']}");
    	}
    	if(isset($values['genre'])){
    		$genre = implode(",", $values['genre']);
    		$select->distinct();
 			$select->from($this)
 				   ->join(array('g' => 'genres'),
                    'anime.id = g.anime_id',
                    array() )
                   ->where("g.genre_id IN ({$genre})");              
    	}
    	
        $row = $this->fetchAll($select);
        return $row;
    }
    
	public function addView($id)
    {
        $db = Zend_Db_Table_Abstract::getDefaultAdapter();
		$stmt = $db->query("UPDATE anime SET views=views+1 WHERE id='{$id}'");        
    }
    
	public function makeSysRec($id){
    	$db = Zend_Db_Table_Abstract::getDefaultAdapter();
		$stmt = $db->query("Select g.genre_id as genre_id From genre_type gt join genres g on g.genre_id=gt.genre_id where g.anime_id='{$id}'");
        $rows = $stmt->fetchAll();
        foreach($rows as $g){
        	$genre[] = $g['genre_id'];
        }
        $select = $this->select();
        $select->where("id={$id}");
        $row = $this->fetchRow($select);
        $select = $this->select();
        $select->from($this)
               ->where('type = ?', $row['type'])
               ->where('status = ?', $row['status'])
               ->where('rating = ?', $row['rating'])
               ->order('views ASC')
               ->limit(5,0);   
        if(isset($genre)){
        	$select->join(array('g' => 'genres'),
                    'anime.id = g.anime_id',
                    array() )
                  ->where('g.genre_id IN (?)',$genre);
        }       
        if($row['eng_title'] == ''){
        	$select->where("eng_title = ''");
        }  
        else if($row['jap_title'] == ''){
        	$select->where("jap_title = ''");
        } else{
        	$select->where("jap_title != ''")
        	       ->where("eng_title != ''");
        }               	  
        $row = $this->fetchAll($select); 
        return $row;	   
    }
    
    public function getAnimeRelation($id){
    	$db = Zend_Db_Table_Abstract::getDefaultAdapter();
		$stmt = $db->query("SELECT ar.description, a.id, a.title
							FROM anime_relation ar, anime a
							WHERE ar.anime_id_2 = a.id
							AND anime_id_1 = {$id}");
        $rows = $stmt->fetchAll();
        return $rows;
    }

	
}

