<?php

class Application_Form_Anime extends Zend_Form
{
	public $elementDecorators = array(
        'ViewHelper',
        'Errors',
        'label',
        array(array('row' => 'HtmlTag'), array('tag' => 'p')),
    );
    
    public $buttonDecorators = array(
        'ViewHelper',
        array(array('data' => 'HtmlTag'), array('tag' => 'td', 'class' => 'element')),
        array(array('label' => 'HtmlTag'), array('tag' => 'td', 'placement' => 'prepend')),
        array(array('row' => 'HtmlTag'), array('tag' => 'tr')),
    );
	
    public function init()
    {
       $this->setMethod('post');
       
       $this->addElement(
       		'text', 'title', array(
       			'label' => 'Title:',
       			'required' =>true,
       			'filters' => array('StringTrim'),
       			'validators' => array('NotEmpty'),
       			//'decorators' => $this->elementDecorators,
       			'class' => 'text-input medium-input',
       			'size' => '83',
       ));	
       
       $this->addElement(
       		'text', 'jap_title', array(
       			'label' => 'Japanese Title:',
       			'filters' => array('StringTrim'),
       			//'decorators' => $this->elementDecorators,
       			'class' => 'text-input medium-input',
       			'size' => '83',
       ));
       
       $this->addElement(
       		'text', 'eng_title', array(
       			'label' => 'English Title:',
       			'filters' => array('StringTrim'),
       			//'decorators' => $this->elementDecorators,
       			'class' => 'text-input medium-input',
       			'size' => '83',
       ));
       
       $this->addElement(
       		'text', 'other_titles', array(
       			'label' => 'Other Titles:',
       			'filters' => array('StringTrim'),       
       			//'decorators' => $this->elementDecorators,
       			'class' => 'text-input medium-input',
       			'size' => '83',
       ));
       
       $this->addElement(
       		'textarea', 'summary', array(
       			//'decorators' => $this->elementDecorators,
       			'required' =>true,
       			'label' => 'Summary:',
       			'filters' => array('StringTrim'),
       			'rows' => '8',
       
       ));
       
       $this->addElement(
             'select', 'type', array(
       					'label' => 'Type:',
                        'required' => true,
       					//'decorators' => $this->elementDecorators,
                        'multiOptions' => array(
                            '1' => 'TV',
       						'2' => 'OVA',
       						'3' => 'Movie',
       						'4' => 'Special',
       						'5' => 'ONA',
       						'6' => 'Music',
                        ), 
                    )
        );
        
        $this->addElement(
             'select', 'status', array(
       					'label' => 'Status:',
                        'required' => true,
        				//'decorators' => $this->elementDecorators,
                        'multiOptions' => array(
                            '1' => 'Finished Airing',
       						'2' => 'Currently Airing',
       						'3' => 'Not yet aired',
                        ), 
                    )
        );
        
        $this->addElement(
             'select', 'rating', array(
       					'label' => 'Rating:',
                        'required' => true,
        				//'decorators' => $this->elementDecorators,
                        'multiOptions' => array(
        					'0' => 'None',
                            '1' => 'G - All Ages',
       						'2' => 'PG - Children',
       						'3' => 'PG-13 - Teens 13 or older',
       						'4' => 'R - 17+ (violence & profanity)',
       						'5' => 'R+ - Mild Nudity',
       						'6' => 'Rx - Hentai',
                        ), 
                    )
        );
        
        
        $this->addElement(
       		'text', 'episodes', array(
        		'required' =>true,
       			'label' => 'Episodes:',
       			'filters' => array('StringTrim','Int'),       
       			//'decorators' => $this->elementDecorators,
       			'class' => 'text-input small-input',
        ));
        
        
        $this->addElement(
       		'text', 'duration', array(
        		'required' =>true,
       			'label' => 'Duration:',
       			'filters' => array('StringTrim'),       
       			//'decorators' => $this->elementDecorators,
       			'class' => 'text-input small-input',
        ));
        
        $this->addElement(
       		'text', 'aired_date', array(
       			'label' => 'Aired Date:',
       			'filters' => array('StringTrim'),
       			//'decorators' => $this->elementDecorators,
       			'class' => 'text-input small-input',
        ));
        
    	 
        
        $this->addElement(
       		'text', 'picture', array(
       			'label' => 'Picture:',
       			'filters' => array('StringTrim'),       
       			//'decorators' => $this->elementDecorators,
       			'class' => 'text-input medium-input',
        ));
        
        
       $this->addElement(
       		'textarea', 'open_theme', array(
       			//'decorators' => $this->elementDecorators,
       			'label' => 'Opening theme:',
       			'filters' => array('StringTrim'),
       			'rows' => '8',
       ));
       
       $this->addElement(
       		'textarea', 'end_theme', array(
       			//'decorators' => $this->elementDecorators,
       			'label' => 'Ending Theme:',
       			'filters' => array('StringTrim'),
       			'rows' => '8',
       ));
        
       $genres = new Zend_Form_Element_Multiselect('genres');
		 $genres->setLabel('Genres:');
		 $genres->setSeparator(' ');
		 //$genres->addDecorators($this->elementDecorators);
		 $genretype = new Application_Model_DbTable_Genre();
		 $genrenames = $genretype->getGenreTypes();
		 foreach ($genrenames as $genre) {
		 	$genres->addMultiOption($genre ->genre_id,$genre ->genre_name);
		 }
		 
		 $this->addElement($genres);
		 
		 
 	    $producer = new Zend_Form_Element_Multiselect('producer');
        $producer->setLabel('Producer:');
       // $producer->addDecorators($this->elementDecorators);
		$producerdb = new Application_Model_DbTable_Producer();
		$producers = $producerdb->getProducerNames();
		foreach ($producers as $prod) {
		 	$producer->addMultiOption($prod ->prod_id,$prod ->prod_name);
		}
		
		$this->addElement($producer);
     
        
        $this->addElement('submit', 'submit', array(
        	'ignore'=>true,
        	'label' => 'Submit',));	
    }
}