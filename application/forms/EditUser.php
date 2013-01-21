<?php

class Application_Form_EditUser extends Zend_Form
{
    public function init()
    {
    	$auth = Zend_Auth::getInstance();
    	$editUser = new Application_Model_DbTable_User(); 
    	$userDetail = $editUser->getUserDetails(($editUser->getUserID($auth->getIdentity())));
    	       
       $this->addElement(
       		'text', 'first_name', array(
       			'label' => 'First Name:',
       			'required' =>true,
       			'filters' => array('StringTrim'),
       			'value' => $userDetail['first_name'],
       ));	
       
       $this->addElement(
       		'text', 'last_name', array(
       			'label' => 'Last Name:',
       			'required' =>true,
       			'filters' => array('StringTrim'),
       			'value' => $userDetail['last_name'],
       ));	
       
       $this->addElement(
       		'text', 'email', array(
       			'label' => 'Email:',
       			'required' =>true,
       			'filters' => array('StringTrim'),
       			'value' => $userDetail['email'],
       ));	
       
       $this->addElement(
       		'text', 'location', array(
       			'label' => 'Location:',
       			'required' =>true,
       			'filters' => array('StringTrim'),
       			'value' => $userDetail['location'],
       ));	
       
//       $this->addElement(
//       		'password', 'password', array(
//       			'label' => 'Password:',
//       			'required' =>true,
//       			'filters' => array('StringTrim'),
//       ));	
//       
//       $this->addElement(
//       		'password', 're_password', array(
//       			'label' => 'Re-enter password:',
//       			'required' =>true,
//       			'filters' => array('StringTrim'),
//       ));	
       
		$this->addElement('submit', 'submit', array(
        	'ignore'=>true,
        	'label' => 'Change Details',));	
    }
}
