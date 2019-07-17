<?php
/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */

return [
    // ...
    /*
    'dbs' => [
        'driver' => 'Pdo',
        'dsn'    => sprintf('sqlite:%s/data/zftutorial.db', realpath(getcwd())),
    ],	
    */
    'abstract_factories' => [
        \Zend\Db\Adapter\AdapterAbstractServiceFactory::class,
    ],
    'db' => array(
        'driver' => 'Pdo',
        'adapters'=>array(
            'db1' => array(
                'driver' => 'Pdo',
                'dsn'    => sprintf('sqlite:%s/data/zftutorial.db', realpath(getcwd())),
            ),
            'db2' => array(
                'driver'    => 'Pdo',
                'dsn'       => "pgsql:host=192.168.200.41;dbname=seduc_teste",
                'username'  => 'carlos',
                'password'  => 'seduc@123',
            ),
        )
    
    ),

    'dbEetepa' => array(
        'driver'    => 'Pdo',
        'dsn'       => "pgsql:host=192.168.200.41;dbname=seduc_teste",
        'username'  => 'carlos',
        'password'  => 'seduc@123',
    ),    
];
