<?php

class Application_Form_Artist extends Zend_Form
{

    public function init()
    {


        
        $this->setName('artist');
        $id = new Zend_Form_Element_Hidden('id');
          $id->setAttrib('id', 'artist_id');
        $id->addFilter('Int');
        $name = new Zend_Form_Element_Text('name');
        $name->setLabel('Name')
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty')
            ->setAttrib('id', 'artist_name')
            ->setAttrib('class', 'form-control row');
        $address = new Zend_Form_Element_Text('address');
        $address ->setLabel('Address')
            ->setRequired(true)
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty')
            ->setAttrib('id', 'artist_address')
            ->setAttrib('class', 'form-control row ');
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('id', 'submitbuttonArtist')
            ->setAttrib('style', 'Display: none;');

        $this->addElements(array($id,  $name, $address, $submit));
    }


}

