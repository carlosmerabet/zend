<?php

namespace Blog\Controller;

use Blog\Form\BlogForm;
use Blog\Model\Blog;
use Blog\Model\BlogTable;

#use Blog\Model\Eetepa;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
#use Zend\Hydrator\ReflectionHydrator;
#use Zend\Hydrator\Reflection as ReflectionHydrator;
#use Zend\Form\Form;
#use Zend\Filter\StringTrim;
#use Zend\Filter\Digits;

use Zend\Validator\Digits as ValidatorDigits;

use Blog\InputFilter\BlogInputFilter;
/**
* 
*/
class BlogController extends AbstractActionController
{
    
	 // Add this property:
     private $table;
     private $form;

     // Add this constructor:
     public function __construct(BlogTable $table, BlogForm $form)
     {
         $this->table = $table;
         $this->form = $form;
     }    

	public function indexAction()
    {
        #$dbAdapter = $container->get('db1');
        #exit('aqui');
        return new ViewModel([
            'blogs' => $this->table->fetchAll(),
        ]);
    }


    public function addAction()
    {
       
        /*
        $data = [
            'title' => ' title teste ',
            'content' => '<a href="#">link</a>'
        ]; 

        $inputFilter = new BlogInputFilter();
        $inputFilter->setData($data);

        echo $inputFilter->isValid()? "válido" : "invalido";

        var_dump($inputFilter->getMessages());
        var_dump($inputFilter->getValues());
        
        
        $cpf = "   999.999.999-99   ";

        $filter = new StringTrim();
        $cpfFiltrado = $filter->filter($cpf);

        $filter = new Digits();
        $cpfFiltrado = $filter->filter($cpf);
        echo $cpfFiltrado;
        
        $validator = new ValidatorDigits();
        $validator->setMessage("Numero inválido", ValidatorDigits::NOT_DIGITS);
        echo $validator->isValid($cpf) ? "válido" : "invalido";

        var_dump($validator->getMessages());

        */

        $form = $this->form; #new BlogForm();

        #esta na factory
        #$form->setInputFilter(new BlogInputFilter());
        
        $form->get('submit')->setValue('Add Post');
        
        $request = $this->getRequest();
        
        if (!$request->isPost()) {
            return ['form' => $form];
        }
        #exit('as');
        $form->setData($request->getPost());
        if (!$form->isValid()) {
            return ['form' => $form];
        }


        $post = new Blog();
        $post->exchangeArray($form->getData());
        $this->table->saveBlog($post);
        
        #return $this->redirect()->toRoute('blog');
        return $this->redirect()->toRoute('admin-blog/blog');
    }
    

    public function editAction()
    {

        $id = (int)$this->params()->fromRoute('id', 0);

        if (!$id) {
            #$return $this->redirect()->toRoute('blog');
            return $this->redirect()->toRoute('admin-blog/blog');
        }

        $post = $this->table->getBlog($id);
                

        $form = $this->form; #new BlogForm($post);
        #$form = new BlogForm($post);
        #form = new BlogForm();
        #$hydrator = new ReflectionHydrator();

        #print_r($post);exit();

        $form->bind($post);
        #$form->setHydrator($blog);
        #$form = $hydrator->extract($post);

        $form->get('submit')->setAttribute('value', 'Edit Post');
        
        $request = $this->getRequest();

        # print_r($request); exit('ver');
        
         if (!$request->isPost()) {
            return [
                'id' => $id,
                'form' => $form
            ];
        }

        $form->setData($request->getPost());
        if (!$form->isValid()) {
            return [
                'id' => $id,
                'form' => $form
            ];
        }

        #$post = new Blog();
        #$post->exchangeArray($form->getData());
        #print_r($post);exit();
        $this->table->saveBlog($post);       

        #return $this->redirect()->toRoute('blog');        
        return $this->redirect()->toRoute('admin-blog/blog');
    }

    public function deleteAction()
    {
        $id = (int)$this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('admin-blog/blog');
        }
        $this->table->deleteBlog($id);
        
        #return $this->redirect()->toRoute('blog');
        return $this->redirect()->toRoute('admin-blog/blog');
        
    }

}