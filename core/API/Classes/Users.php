<?php
/**
 * Created by PhpStorm.
 * User: iceman5508
 * Date: 10/27/2017
 * Time: 12:07 AM
 * Demo user model
 */



use IRadian\ibase\iModel;
use IRadian\ibase\iTables;


class Users extends iModel
{

    private $table,$data;

    /**
     * Users constructor.
     * @param iTables $table - The table this user model will use
     */
    public function __construct(iTables $table, $request){
        $this->table = $table;
         parent::__construct($request);
    }

    public  function __destruct(){
        unset($this->table);
        unset($this->data);
     }

    /**
     * Create a new user in the table
     * @param array $fields - associative array example
     * ('fieldname' => 'value')
     * @return array
     */
     public function create($fields=array()){
        $this->data =  $this->table->insert($fields);
         return $this->getData();
     }

    /**
     * Get user information
     * @param $where array - form array('id','=',1)
     */
     public function getUser($where=array()){
        $this->data = $this->table->get($where);
         return $this->getData();
     }

    /**
     * Delete the user from the database
     * @param array $where - array('id', '=', '1')
     */
     public function delete($where=array()){
         $this->data = $this->table->delete($where);
         return $this->getData();
     }


    /**
     * Update a member info in the database
     * @param $whereField
     * @param $whereEqual
     * @param array $fieldData
     */
     public function update($whereField,$whereEqual, $fieldData = array()){
         $this->data = $this->table->update($whereField, $whereEqual, $fieldData);
         return $this->getData();
     }


    /**
     * Return the value of the last query
     * @return mixed
     */
     public function getData(){
         return $this->data;
     }
}