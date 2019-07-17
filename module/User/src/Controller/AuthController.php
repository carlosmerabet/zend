<?php

namespace User\Controller;

use User\Form\LoginForm;
use Zend\Authentication\AuthenticationServiceInterface;
use Zend\Authentication\Adapter\DbTable\CallbackCheckAdapter;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;



/**
* 
*/
class AuthController extends AbstractActionController
{

    private $authService;

    public function __construct(AuthenticationServiceInterface $authService){
        $this->authService = $authService;
    }

    public function loginAction()
    {
        #exit('aqui');

        if($this->authService->hasIdentity() ){
            return $this->redirect()->toRoute('admin-blog/blog');
        }

        $form = new LoginForm();

        $messageError = null;
        
        //se nao for post
        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getPost();
            $form->setData($data);
        
            if ($form->isValid()) {
                $formData = $form->getData();
                /** @var CallbackCheckAdapter $authAdapter */
                $authAdapter = $this->authService->getAdapter();

                $authAdapter->setIdentity($formData['username']);
                $authAdapter->setCredential($formData['password']);
                
                $result = $this->authService->authenticate();
                
                if ($result->isValid()) {
                    #var_dump($this->authService->getIdentity()); 
                    return $this->redirect()->toRoute('admin-blog/blog');
                    #return $this->redirect()->toRoute('blog');
                } else {
                    $messageError = "Login Inválido!";
                }
                #echo $messageError;
            }

        }
        return new ViewModel([
            'form' => $form,
            'messageError' => $messageError,
            'messageLogout' => ''#"Logout realizado com sucesso!"
        ]);
    }

    public function logoutAction()
    {
        $this->authService->clearIdentity();
        $messageLogout = "Logout realizado com sucesso!";
        return $this->redirect()->toRoute('login');
        #return new ViewModel();
    }    

}