<?php
class Admin_AnimeController extends Zend_Controller_Action
{
    public function preDispatch ()
    {
        $this->_helper->layout->setLayout('admin');
    }
    
    public function indexAction ()
    {
        $flashMessenger = $this->_helper->FlashMessenger;
        if ($flashMessenger->getMessages()) {
            $this->view->message = $flashMessenger->getMessages();
        }
        $auth = Zend_Auth::getInstance();
        if ($auth->hasIdentity()) {
            $this->view->username = $auth->getIdentity();
            $user = new Application_Model_DbTable_User();
            $userID = ($user->getUserID($auth->getIdentity()));
            $admin = new Application_Model_DbTable_Admin();
            if ($admin->checkAdmin($userID)) {
                $this->view->isAdmin = true;
            }
        }
    }
    public function addAction ()
    {
        $auth = Zend_Auth::getInstance();
        if ($auth->hasIdentity()) {
            $this->view->username = $auth->getIdentity();
            $user = new Application_Model_DbTable_User();
            $userID = ($user->getUserID($auth->getIdentity()));
            $admin = new Application_Model_DbTable_Admin();
            if ($admin->checkAdmin($userID)) {
                $this->view->isAdmin = true;
                $form = new Application_Form_Anime();
                $this->view->form = $form;
                if ($this->getRequest()->isPost()) {
                    if ($form->isValid(
                    $this->getRequest()
                        ->getPost())) {
                        $values = $form->getValues();
                        $anime = new Application_Model_DbTable_Anime();
                        $animeID = $anime->addAnime($values);
                        $genres = new Application_Model_DbTable_GenreRelation();
                        $genres->insertGenre($animeID, $values);
                        $producers = new Application_Model_DbTable_ProducerRelation();
                        $producers->insertProducer($animeID, $values);
                        $this->_helper->getHelper('FlashMessenger')->addMessage(
                        "Anime '{$values['title']}' is added.");
                        $this->_redirect('/admin/anime/success');
                    }
                }
            }
        }
    }
    public function editAction ()
    {
        $auth = Zend_Auth::getInstance();
        if ($auth->hasIdentity()) {
            $this->view->username = $auth->getIdentity();
            $user = new Application_Model_DbTable_User();
            $userID = ($user->getUserID($auth->getIdentity()));
            $admin = new Application_Model_DbTable_Admin();
            if ($admin->checkAdmin($userID)) {
                $this->view->isAdmin = true;
                $animeID = $this->_request->getParam('id');
                $anime = new Application_Model_DbTable_Anime();
                $form = new Application_Form_Anime();
                if ($this->getRequest()->isPost()) {
                    if ($form->isValid(
                    $this->getRequest()
                        ->getPost())) {
                        $values = $form->getValues();
                        $anime->updateAnime($animeID, $values);
                        $genres = new Application_Model_DbTable_GenreRelation();
                        $genres->deleteGenre($animeID);
                        $genres->insertGenre($animeID, $values);
                        $producers = new Application_Model_DbTable_ProducerRelation();
                        $producers->deleteProducer($animeID);
                        $producers->insertProducer($animeID, $values);
                        $this->_helper->getHelper('FlashMessenger')->addMessage(
                        "Anime '{$values['title']}' is updated.");
                        $this->_redirect('/admin/anime/success');
                    }
                }
                $animeInfo = $anime->getAnime($animeID);
                $genres = $anime->getGenres($animeID);
                $producers = $anime->getProducers($animeID);
                $form->populate($animeInfo->toArray());
                if ($genres != null) {
                    $genre = array();
                    foreach ($genres as $g) {
                        array_push($genre, $g['genre_id']);
                    }
                    $form->getElement('genres')->setValue($genre);
                }
                if ($producers != null) {
                    $producer = array();
                    foreach ($producers as $p) {
                        array_push($producer, $p['prod_id']);
                    }
                    $form->getElement('producer')->setValue($producer);
                }
                $this->view->form = $form;
            }
        }
    }
    public function deleteAction ()
    {
        $auth = Zend_Auth::getInstance();
        if ($auth->hasIdentity()) {
            $this->view->username = $auth->getIdentity();
            $user = new Application_Model_DbTable_User();
            $userID = ($user->getUserID($auth->getIdentity()));
            $admin = new Application_Model_DbTable_Admin();
            if ($admin->checkAdmin($userID)) {
                $this->view->isAdmin = true;
                $animeID = $this->_request->getParam('id');
                $anime = new Application_Model_DbTable_Anime();
                $animeInfo = $anime->getAnime($animeID);
                $anime->deleteAnime($animeID);
                $genres = new Application_Model_DbTable_GenreRelation();
                $genres->deleteGenre($animeID);
                $producers = new Application_Model_DbTable_ProducerRelation();
                $producers->deleteProducer($animeID);
                $this->_helper->getHelper('FlashMessenger')->addMessage(
                "Anime '{$animeInfo->title}' is deleted.");
                $this->_redirect('/admin/anime/success');
            }
        }
    }
    
    
    public function successAction ()
    {
        if ($this->_helper->getHelper('FlashMessenger')->getMessages()) {
            $this->view->message = $this->_helper->getHelper('FlashMessenger')->getMessages();
        } else {
            $this->_redirect('/');
        }
    }
}







