<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction ()
    {
        $auth = Zend_Auth::getInstance();
        if ($auth->hasIdentity()) {
            $this->view->username = $auth->getIdentity();
        }
        $anime = new Application_Model_DbTable_Anime();
        $this->view->topTen = $anime->getTopTen();
        $userlist = new Application_Model_DbTable_UserList();
        $this->view->recentWatch = $userlist->getRecentlyWatched();
        $user = new Application_Model_DbTable_User();
        $this->view->newusers = $user->getNewUsers();
        $comment = new Application_Model_DbTable_Comment();
        $this->view->comment = $comment->getRecentComments();
        $request = $this->getRequest();
        $userUrl = $request->getBaseURL() . '/user';
        $this->view->user = $userUrl;
        $listUrl = $request->getBaseURL() . '/anime/list';
        $this->view->list = $listUrl;
        $searchUrl = $request->getBaseURL() . '/anime/search';
        $this->view->search = $searchUrl;
    }
    
}







