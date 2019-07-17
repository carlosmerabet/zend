<?php

namespace Blog\Controller;

use Blog\Form\CommentForm;
use Blog\Model\Comment;
use Blog\Model\CommentTable;

use Blog\Model\Blog;
use Blog\Model\BlogTable;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Zend\Validator\Digits as ValidatorDigits;
use Blog\InputFilter\BlogInputFilter;
/**
* 
*/
class PostController extends AbstractActionController
{
    
	 // Add this property:
     private $table;
     private $commentTable;

     public function __construct(BlogTable $table, CommentTable $commentTable)
     {
         $this->table = $table;
         $this->commentTable = $commentTable;
     }  

	public function indexAction()
    {
        return new ViewModel([
            'posts' => $this->table->fetchAll(),
        ]);
    }
    

    public function showAction()
    {
        #exit('teste');
        $id = (int)$this->params()->fromRoute('id', 0);

        $commentForm = new CommentForm();
        
        if (!$id) {
            return $this->redirect()->toRoute('post');
        }

        try{
            $post = $this->table->getBlog($id);
        }catch(\Exception $e){
            return $this->redirect()->toRoute('post'); 
        }
        
        return new ViewModel([
            'post' => $post,
            'commentForm' => $commentForm,            
        ]);
    }

    public function addCommentAction()
    {
        $id = (int)$this->params()->fromRoute('id', 0);
        
        if (!$id) {
            return $this->redirect()->toRoute('site-post');
        }

        $request = $this->getRequest();
        if (!$request->isPost()) {
            return $this->redirect()->toRoute('site-post');
        } else {
            try {
                $post = $this->table->getBlog($id);
            } catch (\Exception $e) {
                return $this->redirect()->toRoute('site-post');
            }

            $commentForm = new CommentForm();
            $commentForm->setData($request->getPost());
            if (!$commentForm->isValid()) {
                return $this->redirect()->toRoute('site-post', ['action' => 'show', 'id' => $post->id]);
            }

            $data = $commentForm->getData();
            $data['post_id'] = $post->id;
            $comment = new Comment();
            $comment->exchangeArray($data);
            $this->commentTable->saveBlog($comment);
            return $this->redirect()->toRoute('site-post', ['action' => 'show', 'id' => $post->id]);
        }
    }

}