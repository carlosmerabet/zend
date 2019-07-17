<?php
namespace User\Form;

use Zend\Form\Form;
use Zend\Form\Element;
#use Zend\Form\Element\TextArea;
class LoginForm extends Form
{
    public function __construct($name=null)
    {
        
        #print_r($name);

        parent::__construct('login');
        

        $this->add([
            'name' => 'username',
            'type' => Element\Text::class,
            'options' => [
                'label'=> 'Usuário'
            ],
       
        ]);
        $this->add([
            'name' => 'password',
            'type' =>Element\Password::class,
            'options' => [
                'label'=> 'Senha'
            ],         
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