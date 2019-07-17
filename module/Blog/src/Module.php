<?php

namespace Blog;

// Add these import statements:
use Blog\Controller\BlogController;
use Blog\Controller\Factory\BlogControllerFactory;
use Blog\Controller\Factory\PostControllerFactory;
use Blog\Controller\PostController;
use Blog\Form\Factory\PostFormFactory;
use Blog\Form\BlogForm;
use Blog\Model\Factory\CommentTableFactory;
use Blog\Model\Factory\CommentTableGatewayFactory;
use Blog\Model\Factory\BlogTableFactory;
use Blog\Model\Factory\BlogTableGatewayFactory;



use Blog\Form\Factory\BlogFormFactory;
#use Zend\Router\Http\Segment;
#use Zend\Db\Adapter\AdapterInterface;
#use Zend\Db\ResultSet\ResultSet;
#use Zend\Db\TableGateway\TableGateway;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\ServiceProviderInterface;
use Zend\ModuleManager\Feature\ControllerProviderInterface;
/**
* 
*/
class Module implements ConfigProviderInterface, ServiceProviderInterface, ControllerProviderInterface
{
	
	public function getConfig()
	{
		return include __DIR__ ."/../config/module.config.php";
	}

	// getConfig() method is here

    // Add this method:
    public function getServiceConfig()
    {
        return [
            'factories' => [

                Model\BlogTable::class => BlogTableFactory::class,
                Model\BlogTableGateway::class => BlogTableGatewayFactory::class,
                BlogForm::class => BlogFormFactory::class, 
                Model\CommentTable::class => CommentTableFactory::class,
                Model\CommentTableGateway::class => CommentTableGatewayFactory::class                
                /*
                Model\BlogTable::class => function($container) {
                    $tableGateway = $container->get(Model\BlogTableGateway::class);
                    return new Model\BlogTable($tableGateway);
                },
                */
                                
                /*
                Model\BlogTableGateway::class => function ($container) {
                    $dbAdapter = $container->get('db1');
                    $dbAdapter2 = $container->get('db2');
                    #$albumTable = $serviceLocator->getServiceLocator()->get('Album\Model\AlbumTable');
                    #$db1Adapter = $serviceLocator->getServiceLocator()->get('db1');
                    
                    #return $dbAdapter;
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Model\Blog());
                    return new TableGateway('blog', $dbAdapter, null, $resultSetPrototype);
                },
                */

            ]
        ];
    }
    // Add this method:
    public function getControllerConfig()
    {
        return [
            'factories' => [

                Controller\BlogController::class => BlogControllerFactory::class,
                Controller\PostController::class => PostControllerFactory::class
                /*Controller\BlogController::class => function($container) {
                    return new Controller\BlogController(
                        $container->get(Model\BlogTable::class)
                    );
                },*/
            ],
        ];
    }
}