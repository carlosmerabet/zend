<?
return [
    'doctrine' => [
        'connection' => [
            // default connection name
            'orm_default' => [
                'driverClass' =>\Doctrine\DBAL\Driver\PDOMySql\Driver::class,
                #'driverClass' => \Doctrine\DBAL\Driver\PDOSqlite\Driver::class,
                'params' => [
                    #'path' => sprintf('%s/data/zftutorial.db', realpath(getcwd()))
                    'host'     => 'localhost',
                    'port'     => '3306',
                    #'user'     => 'username',
                    #'password' => 'password',
                    #'dbname'   => 'database',
                    'driverOptions' => [
                        \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"
                    ]                    
                ],
            ],
        ],
    ],
];