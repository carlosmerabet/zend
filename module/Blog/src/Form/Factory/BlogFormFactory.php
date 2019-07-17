<?php
namespace Blog\Form\Factory;

use Blog\Form\BlogForm;
use Blog\InputFilter\BlogInputFilter;
use Interop\Container\ContainerInterface;

class BlogFormFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $inputFilter = new BlogInputFilter();
        $form = new BlogForm();
        $form->setInputFilter($inputFilter);
        return $form;
    }
}