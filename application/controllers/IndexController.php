<?php

class IndexController extends Zend_Controller_Action
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

        $form = new Application_Form_Album();
        $form->submit->setLabel('Add');
        $this->view->form = $form;
        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                $listNameOptions = $form->getElement('artist')->getMultiOptions();
                $label = $listNameOptions[$form->getValue('artist')];
                $db = Zend_Db_Table_Abstract::getDefaultAdapter();
                $select = $db->select()
                    ->from('artist', 'id')
                    ->where('name =?', $label);

                $stmt = $db->query($select);
                $row = $stmt->fetch();
                $artist_id = $row['id'];
                $title = $form->getValue('title');
                $albums = new Application_Model_DbTable_Albums();
                $albums->addAlbum($artist_id, $title);
                $this->_helper->redirector('index');

            } else {
                $form->populate($formData);
            }
        }

    }

    public function editAction()
    {
        $this->_helper->layout()->disableLayout();

        $form = new Application_Form_Album();
        $form->submit->setLabel('Save');
        $this->view->form = $form;
        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                $id = (int)$form->getValue('id');
                $listNameOptions = $form->getElement('artist')->getMultiOptions();
                $label = $listNameOptions[$form->getValue('artist')];
                $db = Zend_Db_Table_Abstract::getDefaultAdapter();
                $select = $db->select()
                    ->from('artist', 'id')
                    ->where('name =?', $label);
                $stmt = $db->query($select);
                $row = $stmt->fetch();
                $artist_id = $row['id'];
                $title = $form->getValue('title');
                $albums = new Application_Model_DbTable_Albums();
                $albums->updateAlbum($id, $artist_id, $title);
                $this->_helper->redirector('index');
            } else {
                $form->populate($formData);
            }
        } else {

            $id = $this->_getParam('id', 0);
            if ($id > 0) {
                $db = Zend_Db_Table_Abstract::getDefaultAdapter();
                $select = $db->select()
                    ->from('album')
                    ->where('id=?', $id);
                $stmt = $db->query($select);
                $row1 = $stmt->fetch();
                $artist_id = $row1['artist_id'];
if( $artist_id==null){
    $artist_id=0;

}
                $select2 = $db->select()
                    ->from('artist', 'name')
                    ->where('id=?', $artist_id);
                $stmt2 = $db->query($select2);
                $row2 = $stmt2->fetch();
                $artist_name = $row2['name'];
                $title=$row1['title'];

                $select3 = $db->select()
                    ->from('artist', 'name');
                $stmt3 = $db->query($select3);
                 $n=0;
                while ($row3= $stmt3->fetch()) {
                    if($artist_name== $row3['name'] ){
                      break;
                    }
                    else{
                        $n++;
                    }
                }

                $date=array('id'=>$id ,'artist'=>$n,'title'=>$title);
                $form->populate($date);
            }


        }
    }

    public function deleteAction()
    {
        $this->_helper->layout()->disableLayout();

        if ($this->getRequest()->isPost()) {
            $del = $this->getRequest()->getPost('del');
            if ($del == 'Yes') {
                $id = $this->getRequest()->getPost('id');
                $albums = new Application_Model_DbTable_Albums();
                $albums->deleteAlbum($id);
            }
            $this->_helper->redirector('index');
        } else {
            $id = $this->_getParam('id', 0);
            $albums = new Application_Model_DbTable_Albums();
            $this->view->album = $albums->getAlbum($id);
        }
    }

    public function viewalbumsAction()
    {
        $db = Zend_Db_Table_Abstract::getDefaultAdapter();

        $albumsDB = new Application_Model_DbTable_Albums();
        $albums = $albumsDB->fetchAll();

        $posts = array();
        foreach ($albums as $albmss):
            $id = $albmss->id;
            $title = $albmss->title;
            $artist_id = $albmss->artist_id;
            $select = $db->select()
                ->from('artist', 'name')
                ->where('id=?', $artist_id);
            $stmt = $db->query($select);
            $row = $stmt->fetch();
            $artist_name = $row['name'];


            $posts[] = array('id' => $id, 'artist_id' => $artist_id,'artist_name'=>$artist_name ,'title' => $title);
        endforeach;
        $this->_helper->json->sendJson(array('data' => $posts));


    }


}















