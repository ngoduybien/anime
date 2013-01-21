<?php
class RegistrationController extends Zend_Controller_Action
{
	public function indexAction()
    {
    	 // generate a login form
        $form = new Application_Form_Registration();
        $this->view->form = $form;
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($this->getRequest()->getPost())) {
            	$values = $form->getValues(); 
            	if($values['password'] == $values['re_password']){
            		$user = new Application_Model_DbTable_User();
            		$user->createUser($values);
            		$this->_helper->getHelper('FlashMessenger')->addMessage(
                        'You signed up successfully');
            		$this->_redirect('/login');            		
            	}
            }
        }  
    }
	
}