<?php

class Application_Form_UserList extends Zend_Form
{
	public $elementDecorators = array(
        'ViewHelper',
        'Errors',
        'label',
        array(array('row' => 'HtmlTag'), array('tag' => 'p')),
    );

    public $buttonDecorators = array(
        'ViewHelper',
        array(array('data' => 'HtmlTag'), array('tag' => 'td', 'class' => 'element')),
        array(array('label' => 'HtmlTag'), array('tag' => 'td', 'placement' => 'prepend')),
        array(array('row' => 'HtmlTag'), array('tag' => 'tr')),
    );
	
    public function init()
    {
       $this->setMethod('post');
       
      
        
       $this->addElement(
             'select', 'status', array(
       					'label' => 'Status:',
                        'required' => true,
                        'multiOptions' => array(
                            '1' => 'Already Watched',
       						'2' => 'Currently Watching',
       						'3' => 'On Hold',
        					'4' => 'Stopped Watching',
        					'5' => 'Do Not Watch'
                        ), 
                    )
        );
        
        
        $this->addElement(
             'select', 'score', array(
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
                    )
        );
        
       
        
       
        $this->addElement('submit', 'submit', array(
        	'ignore'=>true,
        	'label' => 'Submit',));	
    }
}