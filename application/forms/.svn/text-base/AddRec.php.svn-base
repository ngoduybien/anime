<?php
class Application_Form_AddRec extends Zend_Form
{
    
    public function init()
    {    	
    	
       $this->setMethod('post');
       
     	$animes = new Zend_Form_Element_Select('anime');
     	$animes->setLabel('If you like this anime, you may like anime:');
     	$animes->setRequired(true);
      
    	$this->addElement($animes);
        
      	$this->addElement(
       		'textarea', 'description', array(
       			'label' => 'Enter Description:',
       			'required' =>true,
       			'filters' => array('StringTrim'),
      			'wrap' => 'hard',
      			'rows' => '8',
       	));	 
        
        $this->addElement('submit', 'submit', array(
        	'ignore'=>true,
        	'label' => 'Recommend',));	
    }
}