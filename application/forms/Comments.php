<?php 

class Application_Form_Comments extends Zend_Form
{
    public function init()
    {
       $this->setMethod('post');
       
       $this->addElement(
       		'textarea', 'comment', array(
       			'label' => 'Enter Comment:',
       			'required' =>true,
       			'filters' => array('StringTrim'),
     		    'rows' => '8'
       ));	
       
        $this->addElement('submit', 'submit', array(
        	'ignore'=>true,
        	'label' => 'Submit',));	
    }
}	