<?php

class Application_Form_Album extends Zend_Form
{

    public function init()
    {
        $artist = new Application_Model_DbTable_Artist();
        $a = $artist->fetchAll();
        $options = array();

 foreach($a as $artists) :
         $options[] =  $artists->name;
 endforeach;

        $this->setName('album');
        $id = new Zend_Form_Element_Hidden('id');
$id->setAttrib('id', 'idofalbum');
        $id->addFilter('Int');
        $artist = new Zend_Form_Element_Select('artist');
        $artist->setLabel('Artist')
            ->addMultiOptions($options)
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty')
            ->setAttrib('style', 'width:195px;')
            ->setAttrib('id', 'artistlistid')
          ->setAttrib('class', 'form-control ');

        $title = new Zend_Form_Element_Text('title');
        $title->setLabel('Title')
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty')
            ->setAttrib('id', 'titleid')
            ->setAttrib('class', 'form-control ');
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('id', 'submitbutton')
            ->setAttrib('style', 'Display: none;');

        $this->addElements(array($id, $artist, $title, $submit));
    }


}

