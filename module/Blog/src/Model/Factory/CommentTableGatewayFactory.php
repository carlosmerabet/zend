<?

namespace Blog\Model\Factory;

use Blog\Model\Comment;
use Interop\Container\ContainerInterface;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

class CommentTableGatewayFactory
{
    public function __invoke(ContainerInterface $container)
    {

        $dbAdapter = $container->get('db1');
        $resultSetPrototype = new ResultSet();
        $resultSetPrototype->setArrayObjectPrototype(new Comment());
        return new TableGateway('comments', $dbAdapter, null, $resultSetPrototype);

    }
}