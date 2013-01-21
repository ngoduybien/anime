<?php
class AnimeController extends Zend_Controller_Action
{
    public function init ()
    {
        /* Initialize action controller here */
        $auth = Zend_Auth::getInstance();
        if ($auth->hasIdentity()) {
            $this->view->username = $auth->getIdentity();
        }
    }
    public function indexAction ()
    {
        $flashMessenger = $this->_helper->FlashMessenger;
        if ($flashMessenger->getMessages()) {
            $this->view->message = $flashMessenger->getMessages();
        }
        $animeID = $this->_getParam('id', 0);
        $anime = new Application_Model_DbTable_Anime();
        $this->view->anime = $anime->getAnime($animeID);
        $this->view->genres = $anime->getGenres($animeID);
        $this->view->producers = $anime->getProducers($animeID);
        $this->view->comments = $anime->getComments($animeID);
        $this->view->recommends = $anime->getRecommends($animeID);
        $this->view->animeID = $animeID;
        $anime->addView($animeID);
        $this->view->sysRecommends = $anime->makeSysRec($animeID);
        $animeRelation = $anime->getAnimeRelation($animeID);
        if ($animeRelation != null) {
            $this->view->animeRelation = $animeRelation;
        }
        $auth = Zend_Auth::getInstance();
        if ($auth->hasIdentity()) {
            $user = new Application_Model_DbTable_User();
            $userID = ($user->getUserID($auth->getIdentity()));
            $admin = new Application_Model_DbTable_Admin();
            if ($admin->checkAdmin($userID)) {
                $this->view->isAdmin = true;
            }
            $userList = new Application_Model_DbTable_UserList();
            $inList = $userList->isInList($userID, $animeID);
            if (! $inList) {
                // echo "not in list";
                $listForm = new Application_Form_UserList();
                $this->view->listForm = $listForm;
                if ($this->getRequest()->isPost()) {
                    if ($listForm->isValid(
                    $this->getRequest()
                        ->getPost())) {
                        // get credentials from user input
                        // initialize authentication adapter
                        // perform authentication and test result
                        $values = $listForm->getValues();
                        $userList->addToList($animeID, $userID, 
                        $values['status'], $values['score']);
                        $flashMessenger->addMessage(
                        'This anime has been added to your list.');
                        $this->_redirect('/anime/index/id/' . $animeID);
                    }
                }
            } else {
                $this->view->animeListInfo = $userList->getAnimeInListInfo(
                $userID, $animeID);
            }
            //Allow user to add reccomendations
            $addRecForm = new Application_Form_AddRec();
            $selectAnime = $addRecForm->getElement('anime');
            $recTable = new Application_Model_DbTable_Recommend();
            $watched = $recTable->getRecommendingList($userID, $animeID);
            foreach ($watched as $currAnime) {
                $selectAnime->addMultiOption($currAnime['anime_id'], 
                $currAnime['title']);
            }
            if (count($selectAnime->getMultiOptions()) > 0) {
                //$addRecForm->init($animeID);
                $this->view->addRecForm = $addRecForm;
                if ($this->getRequest()->isPost()) {
                    if ($addRecForm->isValid(
                    $this->getRequest()
                        ->getPost())) {
                        // get credentials from user input
                        // initialize authentication adapter
                        // perform authentication and test result
                        $values = $addRecForm->getValues();
                        $reccomended = new Application_Model_DbTable_Recommend();
                        $reccomended->addRecommedation($animeID, 
                        $values['anime'], $userID, $values['description']);
                        $flashMessenger->addMessage(
                        'Your recommendation was added.');
                        $this->_redirect('/anime/index/id/' . $animeID);
                    }
                }
            }
            $form = new Application_Form_Comments();
            $this->view->form = $form;
            if ($this->getRequest()->isPost()) {
                if ($form->isValid(
                $this->getRequest()
                    ->getPost())) {
                    $values = $form->getValues();
                    $comment = new Application_Model_DbTable_Comment();
                    $comment->addComment($values, $userID, $animeID);
                    $this->view->comments = $anime->getComments($animeID);
                    $flashMessenger->addMessage('Your comment was added.');
                    $form->reset();
                    $this->_redirect('/anime/index/id/' . $animeID);
                }
            }
        }
    }
    public function listAction ()
    {
        Zend_View_Helper_PaginationControl::setDefaultViewPartial(
        'controls.phtml');
        $animeList = new Application_Model_DbTable_Anime();
        $list = $animeList->getAnimeList();
        $newList = array();
        $label = strtoupper($this->_getParam('label', null));
        $this->view->label = $label;
        if ($label != null && $label != '0') {
            foreach ($list as $anime) {
                if ($anime->title[0] == $label) {
                    array_push($newList, $anime);
                }
            }
        } elseif ($label == '0') {
            foreach ($list as $anime) {
                if (strcmp($anime->title[0], 'A') < 0) {
                    array_push($newList, $anime);
                }
            }
        } else {
            $newList = $list;
        }
        $paginator = Zend_Paginator::factory($newList);
        $paginator->setCurrentPageNumber($this->_getParam('page', 1));
        $paginator->setItemCountPerPage(100);
        $this->view->animeList = $paginator;
    }
    public function searchAction ()
    {
        // generate a login form
        $form = new Application_Form_Search();
        $this->view->form = $form;
        Zend_View_Helper_PaginationControl::setDefaultViewPartial(
        'controls.phtml');
        if ($this->getRequest()->getParam('submit') != null) {
            if ($form->isValid(
            $this->getRequest()
                ->getParams())) {
                $values = $form->getValues();
                $animeList = new Application_Model_DbTable_Anime();
                $result = $animeList->advSearch($values);
                if ($result != null) {
                    $paginator = Zend_Paginator::factory($result);
                    $paginator->setItemCountPerPage(100);
                    $this->view->animeList = $paginator;
                }
            }
        }
    }
    public function recommendAction ()
    {
        //echo 'recommend page';
        $this->view->anime = new Application_Model_DbTable_Anime();
        $this->view->id = $this->_getParam('id', 0);
        $this->view->recommends = $this->view->anime->getRecommends(
        $this->view->id);
        $recTable = new Application_Model_DbTable_Recommend();
        $db = Zend_Db_Table_Abstract::getDefaultAdapter();
        $stmt = $db->query(
        "SELECT * FROM recommended r WHERE r.id = (SELECT MAX(r.id))");
        $this->view->lastTen = $stmt->fetchAll();
        $this->view->titles = array();
        $this->view->descriptions = array();
        /*foreach($this->view->recommends as $recommendation)
    	{
    		
    		$nextAnime = $anime->getAnime($recommendation['anime_id2']);
    		$nextTitle = $nextAnime['title'];
    		array_push($titles, $nextTitle);
    		array_push($descriptions, $recommendation['description']);
    		
    		//echo $recommendation['description'];
    		//echo $nextTitle;
    	}
    	*/
    }
}







