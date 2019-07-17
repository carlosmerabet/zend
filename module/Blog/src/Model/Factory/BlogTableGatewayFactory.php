<?

namespace Blog\Model\Factory;

use Blog\Model\Blog;
use Interop\Container\ContainerInterface;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

class BlogTableGatewayFactory
{
    public function __invoke(ContainerInterface $container)
    {
		#exit('teste');
        $dbAdapter = $container->get('db1');
        $dbAdapter2 = $container->get('db2');
        #$albumTable = $serviceLocator->getServiceLocator()->get('Album\Model\AlbumTable');
        #$db1Adapter = $serviceLocator->getServiceLocator()->get('db1');
        
        #return $dbAdapter;
        $resultSetPrototype = new ResultSet();
        $resultSetPrototype->setArrayObjectPrototype(new Blog());
        return new TableGateway('blog', $dbAdapter, null, $resultSetPrototype);

        $dbAdapter = $container->get(AdapterInterface::class);
        $resultSetPrototype = new ResultSet();
        $resultSetPrototype->setArrayObjectPrototype(new Post());
        return new TableGateway('post', $dbAdapter, null, $resultSetPrototype);
    }
}