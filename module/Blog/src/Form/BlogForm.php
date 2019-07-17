<?php
namespace Blog\Form;

use Zend\Form\Form;
use Zend\Form\Element;
#use Zend\Form\Element\TextArea;
class BlogForm extends Form
{
    public function __construct($name=null)
    {
        
        #print_r($name);

        parent::__construct('blog');
        
        $this->add([
           'name' => 'id',
            'type' => 'hidden',
            /*
            'attributes' => [
                'value'=> !empty($name->id) ? $name->id : null,
            ]     
            */       
        ]);
        $this->add([
            'name' => 'title',
            #'type' => 'text',
            #'type' => Element\Text::class,
            'type' => Element\Text::class,
            'options' => [
                'label'=> 'Title'
            ],
            /*
            'attributes' => [
                'value'=> !empty($name->title) ? $name->title : null,
            ] 
            */           
        ]);
        $this->add([
            'name' => 'content',
            'type' => 'Textarea',
            'options' => [
                'label'=> 'Content'
            ],
            /*
            'attributes' => [
                'value'=> !empty($name->content) ? $name->content : null,
            ] 
            */             
        ]);

        $this->add([
            'name' => 'submit',
            'type' => 'submit',
            'attributes' => [
                'value'=> 'Go',
                'id'=>'submitbutton'
            ]
        ]);                

    }
}