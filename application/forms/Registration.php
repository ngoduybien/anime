<?php

class Application_Form_Registration extends Zend_Form
{
    public function init()
    {
      $userValidator = new Zend_Validate_Db_NoRecordExists(
					array('table' => 'user',
             			  'field' => 'username'	              
				         )
      );
    	$this->addElement(
       		'text', 'username', array(
       			'label' => 'Username:',
       			'required' =>true,
       			'filters' => array('StringTrim'),
    			'validators' => array(
                array('StringLength', false, array(3, 20)),
                	 $userValidator
            	),
       ));	
       
       $this->addElement(
       		'text', 'first_name', array(
       			'label' => 'First Name:',
       			'required' =>true,
       			'filters' => array('StringTrim'),
       ));	
       
       $this->addElement(
       		'text', 'last_name', array(
       			'label' => 'Last Name:',
       			'required' =>true,
       			'filters' => array('StringTrim'),
       ));	
       
       $emailValidator = new Zend_Validate_Db_NoRecordExists(
					array('table' => 'user',
             			  'field' => 'email'	              
				         )
      );
       $this->addElement(
       		'text', 'email', array(
       			'label' => 'Email:',
       			'required' =>true,
       			'validators' => array('EmailAddress', $emailValidator),
       			'filters' => array('StringTrim'),
       ));	
       
       $this->addElement(
       		'text', 'location', array(
       			'label' => 'Location:',
       			'required' =>true,
       			'filters' => array('StringTrim'),
       ));	
       
       $this->addElement(
       		'password', 'password', array(
       			'label' => 'Password:',
       			'required' =>true,
       			'filters' => array('StringTrim'),
       			'validators' => array(array('StringLength', false, array(6, 20))),
       ));	
       
       $this->addElement(
       		'password', 're_password', array(
       			'label' => 'Re-enter password:',
       			'required' =>true,
       			'filters' => array('StringTrim'),    	
				'validators' => array(
                array('StringLength', false, array(6, 20)),
                array('identical', false, array('token' => 'password', 'strict' => true))
            	),
       ));	
    	// create captcha
		$captcha = new Zend_Form_Element_Captcha('captcha', array(
			'captcha' => array(
			'captcha' => 'Figlet',
			'wordLen' => 5,
			'timeout' => 300,
			)
		));
		$captcha->setLabel('Verification:');
		
		$this->addElement($captcha); 
		
		$this->addElement('submit', 'submit', array(
        	'ignore'=>true,
        	'label' => 'Sumbit',));	
    }
}