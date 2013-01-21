<?php
class UserController extends Zend_Controller_Action
{
    public function indexAction ()
    {
        $flashMessenger = $this->_helper->FlashMessenger;
        if ($flashMessenger->getMessages()) {
            $this->view->message = $flashMessenger->getMessages();
        }
        $auth = Zend_Auth::getInstance();
        $request = $this->getRequest();
        if (! $auth->hasIdentity()) {
            //$this->view->username = 'not login yet';
        } else {
            $this->view->username = $auth->getIdentity();
            $userlist = new Application_Model_DbTable_UserList();
            $user = new Application_Model_DbTable_User();
            $userID = ($user->getUserID($auth->getIdentity()));
            $this->view->userlist = $userlist->getWatched($userID);
            
            $rec = new Application_Model_DbTable_Recommend();
            $this->view->recs = $rec->getUserRecs($userID);
            
            $comments = new Application_Model_DbTable_Comment();
            $this->view->comment = $comments->getComment($userID);
            $admin = new Application_Model_DbTable_Admin();
            if ($admin->checkAdmin($userID)) {
                $adminUrl = $request->getBaseURL() . '/admin';
                $this->view->admin = $adminUrl;
            }
            $editUrl = $request->getBaseURL() . '/user/edit';
            $this->view->edituser = $editUrl;
            $editlistUrl = $request->getBaseURL() . '/user/editlist';
            $this->view->edituserlist = $editlistUrl;
        }
        $logoutUrl = $request->getBaseURL() . '/user/logout';
        $this->view->urllogout = $logoutUrl;
    }
    
    
    public function editAction ()
    {    
    	$flashMessenger = $this->_helper->FlashMessenger;	
    	if ($flashMessenger->getMessages()) {
            $this->view->message = $flashMessenger->getMessages();
        }
        $auth = Zend_Auth::getInstance();
        $request = $this->getRequest();
        if (! $auth->hasIdentity()) {
            //$this->view->username = 'not login yet';
        } else {
        	
        	$username = $auth->getIdentity();
        	$this->view->username = $username;
            $form = new Application_Form_EditUser();
            $this->view->form = $form;
            if ($this->getRequest()->isPost()) {
                if ($form->isValid($this->getRequest()
                    ->getPost())) {
                    $values = $form->getValues();
                    $user = new Application_Model_DbTable_User();
                    $user->updateUser($username, $values);
                    $flashMessenger->addMessage('Your profile is updated successfully.');
                    $this->_redirect('/user/edit');
                }
            }
        }        
    }
    public function editlistAction ()
    {
        $auth = Zend_Auth::getInstance();
        if (! $auth->hasIdentity()) {
            //$this->view->username = 'not login yet';
        } else {
            $this->view->username = $auth->getIdentity();
            $userlist = new Application_Model_DbTable_UserList();
            $listForm = new Application_Form_EditUserList();
            $user = new Application_Model_DbTable_User();
            $userID = $user->getUserID($auth->getIdentity());
            $this->view->userlist = $userlist->getWatched($userID);
            $this->view->listForm = $listForm;
            $request = $this->getRequest();
            $userUrl = $request->getBaseURL() . '/user';
            $this->view->user = $userUrl;
            if ($this->getRequest()->isPost()) {
                if ($listForm->isValid($this->getRequest()
                    ->getPost())) {
                    $values = $listForm->getValues();
                    foreach ($this->view->userlist as $anime) {
                        if ($values['delete' . $anime['id']] == 1) {
                            $userlist->removeAnime($anime['id'], $userID);
                        } else {
                            $userlist->updateList($anime['id'], $userID, 
                            $values['status' . $anime['id']], 
                            $values['score' . $anime['id']]);
                        }
                        $listForm = new Application_Form_EditUserList();
                        $this->view->listForm = $listForm;
                    }
                }
            }
        }
    }
    public function logoutAction ()
    {
        $auth = Zend_Auth::getInstance();
        $auth->clearIdentity();
        $this->_redirect('/login');
    }
    
    public function editrecsAction()
    {
    	$auth = Zend_Auth::getInstance();
        if (! $auth->hasIdentity())
        {
            //$this->view->username = 'not login yet';
        } 
    	else{
    		
    	
    		
    	$this->view->username = $auth->getIdentity();
    	
    	$recTable = new Application_Model_DbTable_Recommend();
    	$this->view->list = $recTable->getUserRecs($this->view->username);
    	$this->view->form = new Application_Form_EditRecList();
    	
    	$user = new Application_Model_DbTable_User();
    	$recList = $recTable->getUserRecs(($user->getUserID($auth->getIdentity())));
    	$this->view->entries = count($recList);
    	//echo $this->view->count;
    	
    	$auth = Zend_Auth::getInstance();
    	//$user = new Application_Model_DbTable_User();
        $userID = $user->getUserID($auth->getIdentity());
    	
   		if ($this->getRequest()->isPost())
   		{
   			if ($this->view->form->isValid($this->getRequest()
                    ->getPost()))
                {
                    $values = $this->view->form->getValues();
                }
   			
   			
   			if($this->getRequest()->getParam('edit', false))
   			{
   				echo "clicked";
   				
   				$id = $values['recommended'];
   				echo $id;
   				$row = $recTable->getRec($id);
   				$desc = $row['description'];
   				echo $desc;
   				
   				
   				$form = new Application_Form_EditRecList();
   				$select = $form->getElement('recommended');
   				$select->setValue($values['recommended']);
   				$textArea = $form->getElement('description');
   				$textArea->setValue($desc);
   				$this->view->form = $form;
   			}
   			
   			else{
   			
   			
                if ($this->view->form->isValid($this->getRequest()
                    ->getPost()))
                {
                    $values = $this->view->form->getValues();
                                        
                    if ($values['delete'] == 1)
                    {
                        $recTable->deleteRec($values['recommended']);
                    } 
                    else
                    {
                     	$desc = $values['description'];
                     	if($desc == "")
                       	{
                        	$row = $recTable->getRec($values['recommended']);
                        	$desc = $row['description'];
                        }
                        $recTable->updateRec($values['recommended'], $desc);
                    }
                        //$listForm = new Application_Form_EditUserList();
                        //$this->view->listForm = $listForm;
                    
                    $form = new Application_Form_EditRecList();
                    $this->view->form = $form;
                    
                    $recList = $recTable->getUserRecs(($user->getUserID($auth->getIdentity())));
    				$this->view->entries = count($recList);
        		}//if
   			}
   	 	}//if
      }
	}//editrecsAction()
}//class






