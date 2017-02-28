
<?php

class Application_Model_DbTable_Artist extends Zend_Db_Table_Abstract
{

    protected $_name = 'artist';
    public function getArtist($id)
    {

        $id = (int)$id;
        $row = $this->fetchRow('id = ' . $id);
        if (!$row) {
            throw new Exception("Could not find row $id");
        }
        return $row->toArray();
    }
    public function addArtist($name, $address)
    {
        $data = array(
            'name' => $name,
            'address' => $address,
        );
        $this->insert($data);
    }
    public function updateArtist($id, $name, $address)
    {
        $data = array(
            'name' => $name,
            'address' => $address,
        );
        $this->update($data, 'id = '. (int)$id);
    }
    public function deleteArtist($id)
    {
        $this->delete('id =' . (int)$id);
    }

    public function getartistalbom($id)
    {
        $this->delete('id =' . (int)$id);
    }

}

