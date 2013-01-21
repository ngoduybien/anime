<?php

class Admin_IndexController extends Zend_Controller_Action
{

	public function preDispatch() {
		$this->_helper->layout->setLayout('admin');
	}

    public function indexAction()
    {
    	
    }
    
}







