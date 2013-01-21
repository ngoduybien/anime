<?php
class LoginController extends Zend_Controller_Action
{
    public function indexAction ()
    {
    	$flashMessenger = $this->_helper->FlashMessenger;
        if ($flashMessenger->getMessages()) {
            $this->view->message = $flashMessenger->getMessages();
        }
        $auth = Zend_Auth::getInstance();
        if ($auth->hasIdentity()) {
            $this->_redirect('/user');
        } else {
            // generate a login form
            $form = new Application_Form_Login();
            $this->view->form = $form;
            $request = $this->getRequest();
            $registerUrl = $request->getBaseURL() . '/registration';
        	$this->view->register = $registerUrl;
            if ($this->getRequest()->isPost()) {
                if ($form->isValid($this->getRequest()
                    ->getPost())) {
                    // get credentials from user input
                    // initialize authentication adapter
                    // perform authentication and test result
                    $values = $form->getValues();
                    $db = Zend_Db_Table_Abstract::getDefaultAdapter();
                    $adapter = new Zend_Auth_Adapter_DbTable($db);
                    $adapter->setTableName('user')
                        ->setIdentityColumn('username')
                        ->setCredentialColumn('password');
                    $adapter->setIdentity($values['username'])->setCredential(
                    md5($values['password']));
                    $result = $auth->authenticate($adapter);
                    if ($result->isValid()) {
                        $this->_helper->getHelper('FlashMessenger')->addMessage(
                        'You were successfully logged in.');
                        $this->_redirect('/user');
                        echo $result->getIdentity() . "\n\n";
                        $auth->getStorage()->write(
                        $adapter->getResultRowObject('username', null));
                    } else {
                        $this->view->loginFail = 'You could not be logged in. Please try again.';
                    }
                }
            }
        }
    }
}










