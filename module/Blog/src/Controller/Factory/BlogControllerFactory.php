<?php
namespace Blog\Controller\Factory;

use Blog\Controller\BlogController;
use Blog\Form\BlogForm;
use Blog\Model\BlogTable;
use Interop\Container\ContainerInterface;

class BlogControllerFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $blogTable = $container->get(BlogTable::class);
        $blogForm = $container->get(BlogForm::class);
        return new BlogController($blogTable,$blogForm);


        $postForm = $container->get(BlogForm::class);
        return new BlogController($postTable, $postForm);
    }
}