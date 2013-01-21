<?php

class Application_Form_EditUserList extends Zend_Form
{
    public function init()
    {
    	$auth = Zend_Auth::getInstance();
        $animelist = new Application_Model_DbTable_UserList();
        $user = new Application_Model_DbTable_User();
        $userlist = $animelist->getWatched(
        ($user->getUserID($auth->getIdentity())));
        
        $this->setMethod('post');
        
        foreach($userlist as $anime){
        	$this->addElement(
       		'hidden', 'title'.$anime['id'], array(
       			'label' => $anime['title'],
    		    'value' => $anime['title'],
       		));	
        	
        	$this->addElement(
             'select', 'status'.$anime['id'], array(
       					'label' => 'Status:',
                        'required' => true,
                        'multiOptions' => array(
                            '1' => 'Already Watched',
       						'2' => 'Currently Watching',
       						'3' => 'On Hold',
        					'4' => 'Stopped Watching',
        					'5' => 'Do Not Watch'
                        ), 
                        'value' => $anime['status'],
                    )
        );

        $this->addElement(
             'select', 'score'.$anime['id'], array(
       					'label' => 'Score:',
                        'required' => true,
                        'multiOptions' => array(
                            '1' => '1 - Unwatchable',
       						'2' => '2 - Awful',
       						'3' => '3 - Bad',
       						'4' => '4 - Mediocre',
       						'5' => '5 - Average',
       						'6' => '6 - Fair',
       						'7' => '7 - Good',
       						'8' => '8 - Great',
       						'9' => '9 - Excellent',
       						'10' => '10 - Masterpiece',
                        ), 
                        'value' => $anime['score'],
                    )
        );
        
        $this->addElement(
             'checkbox', 'delete'.$anime['id'], array(
       					'label' => 'Delete From Your List?',
                    )
        );
        }
        $this->addElement('submit', 'submit', array(
        	'ignore'=>true,
        	'label' => 'Submit Changes',));	
    }
}    	

