<?php

class Application_Model_DbTable_Albums extends Zend_Db_Table_Abstract
{

    protected $_name = 'album';

    public function getAlbum($id)
    {

        $id = (int)$id;
        $row = $this->fetchRow('id = ' . $id);
        if (!$row) {
            throw new Exception("Could not find row $id");
        }
        return $row->toArray();
    }
    public function addAlbum($artist_id, $title)
    {
        $data = array(
            'artist_id' => $artist_id,
            'title' => $title,
        );
        $this->insert($data);
    }
    public function updateAlbum($id, $artist_id, $title)
    {
        $data = array(
            'artist_id' => $artist_id,
            'title' => $title,
        );
        $this->update($data, 'id = '. (int)$id);
    }
    public function deleteAlbum($id)
    {
        $this->delete('id =' . (int)$id);
    }


}

