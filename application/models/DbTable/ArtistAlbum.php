<?php

class Application_Model_DbTable_ArtistAlbum extends Zend_Db_Table_Abstract
{

    protected $_name = 'artist_album';
    protected $_primary = 'id'; // primary column name

    public function get_Artist_Album($id)
    {
        $id = (int)$id;
        $row = $this->fetchRow('id = ' . $id);
        if (!$row) {
            throw new Exception("Could not find row $id");
        }
        return $row->toArray();
    }


}

