<?php
namespace Blog\Controller\Factory;

use Blog\Controller\PostController;
use Blog\Model\CommentTable;
use Blog\Model\BlogTable;
use Interop\Container\ContainerInterface;
class PostControllerFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $blogTable = $container->get(BlogTable::class);
        $commentTable = $container->get(CommentTable::class);
        return new PostController($blogTable, $commentTable);
    }
}
