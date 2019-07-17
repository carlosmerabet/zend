<?php

namespace Blog;

use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
#use Blog\Controller\BlogController;

return[
	 'controllers' => [
	 	'factories' => [
	 		#controller\BlogController::class => InvokableFactory::class,
	 	],
	 ],
	'router' => [
		'routes' => [

			#/*
            'admin-blog' => [
                'type' => Literal::class,
                'options' => [
                    'route' => '/admin'
				],
				
				//se usuario acessar somente admin nao vai controller
				'may_terminate' => false,
				
                'child_routes' => [
					'blog' => [
						'type' => 'Segment',
							'options' => [
								'route' => '/blog[/:action[/:id]]',
								'contraints' => [
									'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
									'id' => '[0-9]+',
								],
								'defaults' => [
									'controller' => Controller\BlogController::class,
									//'controller' => BlogController::class,
									'action' => 'index',
								],
							],
					],
                ]
			],
			
            'site-post' => [
                'type' => 'segment',
                'options' => [
                    'route' => '/post[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\PostController::class,
                        'action' => 'index'
                    ]
                ]
            ],

			#*/

			/*
			'blog' => [
				'type' => 'Segment',
					'options' => [
						'route' => '/blog[/:action[/:id]]',
						'contraints' => [
							'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
							'id' => '[0-9]+',
						],
						'defaults' => [
							'controller' => Controller\BlogController::class,
							//'controller' => BlogController::class,
							'action' => 'index',
						],
					],
			],
			*/
		],
	],

	'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
		'exception_template'       => 'error/index',
				
		'template_path_stack' => [
			'blog' =>__DIR__."/../view",
		],
		'template_map' => [
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ],
	],

    'doctrine' => [
        'driver' => [
            'Blog_driver' => [
                'class' => AnnotationDriver::class,
                'cache' => 'array',
                'paths' => [
                    __DIR__ . '/../src/Entity'
                ]
            ],
            'orm_default' => [
                'drivers' => [
                    'Blog\Entity' => 'Blog_driver'
                ]
            ]
		],	
        'fixture' => [
            'BlogFixture' => __DIR__ . '/../src/Fixture'
        ]		
	]
];