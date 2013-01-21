<?php
class StatsController extends Zend_Controller_Action
{
    public function init ()
    {
    }
    public function indexAction ()
    {
    	$anime = new Application_Model_DbTable_Anime();
        $this->view->anime = $anime->getStats();
        $this->view->topTen = $anime->getTopTen();
        $this->view->leastViewed = $anime->leastViewed();
        $comments = new Application_Model_DbTable_Comment();
        $this->view->comments = $comments->getStats();
        $producers = new Application_Model_DbTable_Producer();
        $this->view->producer = $producers->getStats();
        $user = new Application_Model_DbTable_User();
        $this->view->user = $user->getStats();
        $userlist = new Application_Model_DbTable_UserList();
        $this->view->userlist = $userlist->getStats();
    }
    
}