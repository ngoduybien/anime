<?php

class Application_Form_EditRecList extends Zend_Form
{
    public function init()
    {
    	$auth = Zend_Auth::getInstance();
        $recTable = new Application_Model_DbTable_Recommend();
        $user = new Application_Model_DbTable_User();
        $recList = $recTable->getUserRecs(
        ($user->getUserID($auth->getIdentity())));
        
        $this->setMethod('post');
        
        
        $animeTable = new Application_Model_DbTable_Anime();
        
        $recommednations = new Zend_Form_Element_Select('recommended');
     	$recommednations->setLabel('You suggested:');
     	$recommednations->setRequired(true);
     	
     	foreach($recList as $rec)
     	{
     		$sugRow = $animeTable->getAnime($rec['anime_id2']);
     		$sugTitle = $sugRow['title'];
     		$forRow = $animeTable->getAnime($rec['anime_id1']);
     		$forTitle = $forRow['title'];
     		
     		$recommednations->addMultiOption($rec['id'], $sugTitle." for ".$forTitle);
     	}
      	
     	// Try to make text area update on selectbox change
     	//$recommednations->setAttrib('onChange', 'changed()');
    	$this->addElement($recommednations);
    	
    	$this->edit = new Zend_Form_Element_Submit('edit');
    	$this->edit->setAttrib('id', 'edit')
                 ->setAttrib('type', 'edit')
                 ->setValue("edit");
    	$this->edit->setLabel("Edit Description");  
        
      	$this->addElement(
       		'textarea', 'description', array(
       			'label' => 'Edit Description:',
       			'required' =>false,
       			'filters' => array('StringTrim'),
      			'wrap' => 'hard',
      			'rows' => 8
          ));	 
       	/*
       	$this->addElement(
             'checkbox', 'updateDesc', array(
       					'label' => 'Update Description?',
                    ));
       	*/
       	$this->addElement(
             'checkbox', 'delete', array(
       					'label' => 'Remove Recomendation?',
                    ));
        
        $this->addElement('submit', 'submit', array(
        	'ignore'=>true,
        	'label' => 'Submit Changes',));	
    }
}    	

