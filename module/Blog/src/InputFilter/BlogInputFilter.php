<?php
namespace Blog\InputFilter;
use Zend\Filter\StringTrim;
use Zend\Filter\StripTags;
use Zend\InputFilter\InputFilter;
use Zend\Validator\NotEmpty;
class BlogInputFilter extends InputFilter
{
    public function __construct()
    {
        
        $this->add([
            'name' => 'id',
            'required' => true,
            'allow_empty' => true
        ]);
        
        $this->add([
            'name' => 'title',
            'required' => true,
            'filters' => [
                #remove espaço
                ['name' => StringTrim::class],
                #remove tag html
                ['name' => StripTags::class] 
            ],            
            'validators' => [
                [
                    'name' => NotEmpty::class,
                    'options' => [
                        'messages' => [
                            NotEmpty::IS_EMPTY => 'O campo é requerido!',
                            #NotEmpty::INVALID => 'O campo é requerido!',
                        ]
                    ]
                ]
            ]            
        ]);
        $this->add([
            'name' => 'content',
            'required' => true,            
            'validators' => [
                [
                    'name' => NotEmpty::class,
                    'options' => [
                        'messages' => [
                            NotEmpty::IS_EMPTY => 'O campo é requerido!'
                        ]
                    ]
                ]
            ]
            
        ]);
    }
}