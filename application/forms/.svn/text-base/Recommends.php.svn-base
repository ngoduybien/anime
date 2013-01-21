<?php 

class Application_Form_Recommends extends Zend_Form
{
    public function init()
    {
       $this->setMethod('post');
       
       $this->addElement(
       		'text', 'comment', array(
       			'label' => 'Enter Comment:',
       			'required' =>true,
       			'filters' => array('StringTrim'),
       ));	
       
        $this->addElement('submit', 'submit', array(
        	'ignore'=>true,
        	'label' => 'Recommend',));	
    }
}	
