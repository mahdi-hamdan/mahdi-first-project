<?php

class ArtistController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {



    }

    public function addAction()
    {
        $this->_helper->layout()->disableLayout();

        $form = new Application_Form_Artist();
        $form->submit->setLabel('Add');
        $this->view->form = $form;
        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                $name = $form->getValue('name');
                $address = $form->getValue('address');
                $artist = new Application_Model_DbTable_Artist();
                $artist->addArtist($name, $address);
                $this->_helper->redirector('index');
            } else {
                $form->populate($formData);
            }

        
    }}

    /**
     *
     */
    public function deleteAction()
    {
        $this->_helper->layout()->disableLayout();

        if ($this->getRequest()->isPost()) {
        $del = $this->getRequest()->getPost('del');
        if ($del == 'Yes') {
            $id = $this->getRequest()->getPost('id');
            $artist= new Application_Model_DbTable_Artist();
            $artist->deleteArtist($id);
        }
        $this->_helper->redirector('index');
    } else {
        $id = $this->_getParam('id', 0);
        $artist = new Application_Model_DbTable_Artist();
        $this->view->artist = $artist->getArtist($id);



    
    }}

    public function editAction()
    {
        $this->_helper->layout()->disableLayout();

        $form = new Application_Form_Artist();
        $form->submit->setLabel('Save');
        $this->view->form = $form;
        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                $id = (int)$form->getValue('id');
                $name = $form->getValue('name');
                $address = $form->getValue('address');
                $artist = new Application_Model_DbTable_Artist();
                $artist->updateArtist($id, $name, $address);
                $this->_helper->redirector('index');
            } else {
                $form->populate($formData);
            }
        } else {
            $id = $this->_getParam('id', 0);
            if ($id > 0) {
                $artist = new Application_Model_DbTable_Artist();
                $form->populate($artist->getArtist($id));
            }



        }


    }

    public function viewartistAction()
    {
        $art_alb_DB = new Application_Model_DbTable_ArtistAlbum();
 $art_alb=$art_alb_DB->fetchAll();
        $posts = array();

        foreach ($art_alb as $artalb):
            $id = $artalb->id;
            $name = $artalb->name;
            $address = $artalb->address;
            $title =  $artalb->title;
            $posts[] = array('id' => $id, 'name' => $name, 'address' => $address,'title'=>$title);
        endforeach;

        $this->_helper->json->sendJson(array('data' => $posts));

    }


}









