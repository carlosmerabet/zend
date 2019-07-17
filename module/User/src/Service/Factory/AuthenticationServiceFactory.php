<?

namespace User\Service\Factory;

use Interop\Container\ContainerInterface;
#use Zend\Authentication\Adapter\CallbackAdapter;
use Zend\Authentication\Adapter\DbTable\CallbackCheckAdapter;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Authentication\Storage\Session;
use Zend\Authentication\AuthenticationService;

class AuthenticationServiceFactory
{
    //pegar adaptador do banco de dados
    //configurar um pegar adaptador para administrar a autenticação do usuário
    //criar a seção para guardarmos o usuário
    //criar o servio de autenticação
    public function __invoke(ContainerInterface $container)
    {
        #exit('s');
        $passwordCallbackVerify  = function($passwordInDatabase, $passwordSent){
            return password_verify($passwordSent, $passwordInDatabase);
        };

        $dbAdapter = $container->get(AdapterInterface::class);

        $dbAdapter = $container->get('db1');
        //adaptador, tabela, username e password
        $authAdapter = new CallbackCheckAdapter($dbAdapter, 'users', 'username', 'password', $passwordCallbackVerify);
        
        $storage = new Session();
        return new AuthenticationService($storage , $authAdapter);

    }
}