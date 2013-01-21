<?php

class Application_Form_Login extends Zend_Form
{
	public $elementDecorators = array(
        'ViewHelper',
        'Errors',
		'Description',
        'HtmlTag',
        'Label'
    );

    public $buttonDecorators = array(
        'ViewHelper',
        'HtmlTag',
    );
	
    public function init()
    {
       $this->setMethod('post');
       
//	   $this->addElementPrefixPaths(array(
//			'decorator' => array('My_Decorator' => APPLICATION_PATH . "/plugins"),
//        	));
       
       $this->addElement(
       		'text', 'username', array(
       			'label' => 'Username:',
       			'required' =>true,
       			'filters' => array('StringTrim'),
       			'decorators' => $this->elementDecorators,
       ));	
       
      
		$this->addElement('password', 'password', array(
            'label' => 'Password:',
            'required' => true,
       		'decorators' => $this->elementDecorators,
        ));
        
        $this->addElement('submit', 'submit', array(
        	'ignore'=>true,
        	'label' => 'Login',
        	'decorators' => $this->buttonDecorators,
        ));	
        
//        $this->setDecorators(array(
//  		  'FormElements',
//  		  array('HtmlTag', array('tag' => 'table')),
//   		  'Form',
//		));
        
    }
}

