<?php

class Application_Form_Search extends Zend_Form
{
    public function init()
    {
       $this->setMethod('get');
       
       $this->addElement(
       		'text', 'title', array(
       			'label' => 'Title:',
       			'required' =>false,
       			'filters' => array('StringTrim'),
       ));	

        // create selection list for rating
        $type = new Zend_Form_Element_Select('type');
        $type->setLabel('Type:')->setMultiOptions(
        array('-1' => 'Any', '0' => 'Other', '1' => 'TV', '2' => 'OVA', '3' => 'Movie', 
        '4' => 'Special', '5' => 'ONA', '6' => 'Music'));
        
        // create selection list for status
        $status = new Zend_Form_Element_Select('status');
        $status->setLabel('Status:')->setMultiOptions(
        array('0' => 'Any', '1' => 'Finished Airing', '2' => 'Currently Airing', '3' => 'Not yet aired' ));
        		
        // create selection list for rating
        $rating = new Zend_Form_Element_Select('rating');
        $rating->setLabel('Rating:')->setMultiOptions(
        array('-1' => 'Any', '0' => 'None', '1' => 'G - All Ages', '2' => 'PG - Children', 
        '3' => 'PG-13 - Teens 13 or older', 
        '4' => 'R - 17+ (violence & profanity)', '5' => 'R+ - Mild Nudity', 
        '6' => 'Rx - Hentai'));	 

        // create checkbox for newsletter subscription
		 $genres = new Zend_Form_Element_MultiCheckbox('genre');
		 $genres->setLabel('Genre:');
		 $genres->setSeparator(' ');
		 $genretype = new Application_Model_DbTable_Genre();
		 $genrenames = $genretype->getGenreTypes();
		 foreach ($genrenames as $genre) {
		 	$genres->addMultiOption($genre ->genre_id,$genre ->genre_name);
		 }
		  
        $this->addElement($type);
        $this->addElement($rating);
        $this->addElement($status);
        $this->addElement($genres);
        
        $this->addElement('submit', 'submit', array(
        	'ignore'=>true,
        	'label' => 'Search',));	
    }
}