<?php
namespace Blog\Model\Factory;

use Blog\Model\CommentTable;
use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\Factory\FactoryInterface;
use Blog\Model;

class CommentTableFactory implements FactoryInterface
{

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        
        $tableGateway = $container->get(Model\CommentTableGateway::class);
        return new CommentTable($tableGateway);

    }
}