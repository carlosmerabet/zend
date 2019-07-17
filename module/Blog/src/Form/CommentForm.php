<?php
namespace Blog\Form;

use Zend\Form\Form;
use Zend\Form\Element;
#use Zend\Form\Element\TextArea;
class CommentForm extends Form
{
    public function __construct($name=null)
    {
        
        #print_r($name);

        parent::__construct('comment');
        
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
            'type' =>   Element\Submit::class,
            'attributes' => [
                'value'=> 'Go',
                'id'=>'submitbutton'
            ]
        ]);                

    }
}