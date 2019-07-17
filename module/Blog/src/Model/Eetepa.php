<?php

namespace Eetepa\Model;

use RuntimeException;
use Zend\Db\TableGateway\TableGatewayInterface;

#use Zend\Db\Adapter\Adapter;
#use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\ResultSet;
#use Zend\Db\ResultSet\ResultSetInterface;
#use Zend\Db\Sql;
#use Zend\Db\Sql\TableIdentifier;
#use Zend\Db\ResultSet\HydratingResultSet;
#use Zend\Hydrator\Reflection as ReflectionHydrator;

class Eetepa
{
    private $adapter;

    public function __construct(Adapter $adapter)
    {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll()
    {
        /*
        $res =  $this->tableGateway->select();
        
        foreach($res as $b){
            echo $b->title."<br>";
        }
        */
        return $this->tableGateway->select();
    }


    
    public function getBlog($id)
    {
        $id = (int) $id;
        
        $rowset = $this->tableGateway->select(['id' => $id]);
                        
        /*
        $adapter = $this->tableGateway->getAdapter();

        $statement = $adapter->query('select * from teste ');
        $result    = $statement->execute();
        if ($result->isQueryResult()) {  
            $resultSet = new ResultSet;
            $resultSet->initialize($result);
        }

        foreach ($resultSet as $row) {
            echo $row->nome."<br>";
        }    
        */  

        /*
        com copia classe
        if ($result->isQueryResult()) {        
            $resultSet = new HydratingResultSet(new ReflectionHydrator, new Blog);
            $resultSet->initialize($result);
        }
        */

        $row = $rowset->current();
        
        if (! $row) {
            throw new RuntimeException(sprintf(
                'Could not find row with identifier %d',
                $id
            ));
        }

        return $row;
    }

    public function saveBlog(Blog $blog)
    {
        #exit('das');
        $data = [
            'content' => $blog->content,
            'title'  => $blog->title,
        ];

        $id = (int) $blog->id;
        
        if ($id === 0) {
            $this->tableGateway->insert($data);
            return;
        }

        if (! $this->getblog($id)) {
            throw new RuntimeException(sprintf(
                'Cannot update blog with identifier %d; does not exist',
                $id
            ));
        }
        #echo $id; echo print_r($data); exit('das');
        $this->tableGateway->update($data, ['id' => $id]);
    }

    public function deleteBlog($id)
    {
        $this->tableGateway->delete(['id' => (int) $id]);
    }
}
