<?php
/**
 * Created by PhpStorm.
 * User: iceman5508
 * Date: 10/26/2017
 * Time: 9:51 PM
 */

namespace IRadian\ibase;


use IEngine\iExtends\iMigration;

abstract class iTables
{
    protected $table;
    private $imigrate;

    /**
     * iTables constructor.
     * @param $table
     */
    final function __construct($table){
        $this->table = $table;

        $this->imigrate = new iMigration(\iConfig::$database['host'],
            \iConfig::$database['username'], \iConfig::$database['password']);

        $this->imigrate->connectToDB(\iConfig::$database['database']);

        $this->imigrate->createTable($table);

    }

    /**
     * close off the table
     */
    function __destruct(){
      unset($this->table);
      $this->imigrate->closeConnection();
      unset($this->imigrate);
    }

    /**
     * Migrate up
     * @return mixed
     */
    public abstract function up();


    /**
     * @return mixed
     * migrate down
     */
    public abstract function down();

    /**
     * Add char - To the table
     * @param $name - The name of the column being added
     * @param int $length - The length
     */
    public final function char($name, $length = NULL){
        if(isset($length))
        {
            $this->imigrate->addColumn($this->table, $name,'char', $length);

        }else{
            $this->imigrate->addColumn($this->table, $name,'char');
        }

    }

    /**
     * Add varchar- To the table
     * @param $name - The name of the column being added
     * @param int $length - The length
     */
    public final function varchar($name, $length = NULL){
        if(isset($length)){
            $this->imigrate->addColumn($this->table, $name,'varchar', $length);
        }else{
            $this->imigrate->addColumn($this->table, $name,'varchar');
        }

    }

    /**
     * Add tinytext To the table
     * @param $name - The name of the column being added
     * @param int $length - The length
     */
    public final function tinytext($name, $length = NULL){
        if(isset($length)){
            $this->imigrate->addColumn($this->table, $name,'tinytext', $length);
        }else{
            $this->imigrate->addColumn($this->table, $name,'tinytext');
        }
    }



    /**
     * Add text - To the table
     * @param $name - The name of the column being added
     * @param int $length - The length
     */
    public final function text($name, $length = NULL){
        if(isset($length)){
            $this->imigrate->addColumn($this->table, $name,'text', $length);
        }else{
            $this->imigrate->addColumn($this->table, $name,'text');
        }

    }

    /**
     * Add blob - To the table
     * @param $name - The name of the column being added
     * @param int $length - The length
     */
    public final function blob($name, $length = NULL){
        if(isset($length)){
            $this->imigrate->addColumn($this->table, $name,'blob', $length);
        }else{
            $this->imigrate->addColumn($this->table, $name,'blob');
        }

    }

    /**
     * Add mediumtext - To the table
     * @param $name - The name of the column being added
     * @param int $length - The length
     */
    public final function mediumtext($name, $length = NULL){
        if(isset($length)){
            $this->imigrate->addColumn($this->table, $name,'mediumtext', $length);
        }else{
            $this->imigrate->addColumn($this->table, $name,'mediumtext');
        }
    }

    /**
     * Add MEDIUMBLOB - To the table
     * @param $name - The name of the column being added
     * @param int $length - The length
     */
    public final function mediumblob($name, $length = NULL){
        if(isset($length)){
            $this->imigrate->addColumn($this->table, $name,'mediumblob', $length);
        }else{
            $this->imigrate->addColumn($this->table, $name,'mediumblob');
        }

    }

    /**
     * Add longtext - To the table
     * @param $name - The name of the column being added
     * @param int $length - The length
     */
    public final function longtext($name, $length = NULL){
        if(isset($length)){
            $this->imigrate->addColumn($this->table, $name,'longtext', $length);
        }else{
            $this->imigrate->addColumn($this->table, $name,'longtext');
        }

    }

    /**
     * Add longblob - To the table
     * @param $name - The name of the column being added
     * @param int $length - The length
     */
    public final function longblob($name, $length = NULL){
        if(isset($length)){
            $this->imigrate->addColumn($this->table, $name,'longblob', $length);
        }else{
            $this->imigrate->addColumn($this->table, $name,'longblob');
        }

    }

    /**
     * Add enum - To the table
     * @param $name - The name of the column being added
     * @param int $length - The length
     */
    public final function enum($name, $length = NULL){
        if(isset($length)){
            $this->imigrate->addColumn($this->table, $name,'enum', $length);
        }else{
            $this->imigrate->addColumn($this->table, $name,'enum');
        }

    }

    /**
    * Add tinyint- To the table
    * @param $name - The name of the column being added
    * @param int $length - The length
    */
    public final function tinyint($name, $length = NULL){
        if(isset($length)){
            $this->imigrate->addColumn($this->table, $name,'tinyint', $length);
        }else{
            $this->imigrate->addColumn($this->table, $name,'tinyint');
        }

    }

    /**
     * Add smallint- To the table
     * @param $name - The name of the column being added
     * @param int $length - The length
     */
    public final function smallint($name, $length = NULL){
        if(isset($length)){
            $this->imigrate->addColumn($this->table, $name,'smallint', $length);
        }else{
            $this->imigrate->addColumn($this->table, $name,'smallint');
        }

    }
    /**
     * Add mediumint- To the table
     * @param $name - The name of the column being added
     * @param int $length - The length
     */
    public final function mediumint($name, $length = NULL){
        if(isset($length)){
            $this->imigrate->addColumn($this->table, $name,'mediumint', $length);
        }else{
            $this->imigrate->addColumn($this->table, $name,'mediumint');
        }

    }

    /**
     * Add int- To the table
     * @param $name - The name of the column being added
     * @param int $length - The length
     */
    public final function int($name, $length = NULL ){
        if(isset($length))
        {
            $this->imigrate->addColumn($this->table, $name,'int', $length);

        }else{
            $this->imigrate->addColumn($this->table, $name,'int', $length);
        }

    }

    /**
     * Add bigint- To the table
     * @param $name - The name of the column being added
     * @param int $length - The length
     */
    public final function bigint($name, $length = NULL){
        if(isset($length)){
            $this->imigrate->addColumn($this->table, $name,'bigint', $length);
        }else{
            $this->imigrate->addColumn($this->table, $name,'bigint');
        }

    }

    /**
     * Add float- To the table
     * @param $name - The name of the column being added
     * @param int $length - The length
     */
    public final function float($name, $length = NULL){
        if(isset($length)){
            $this->imigrate->addColumn($this->table, $name,'float', $length);
        }else{
            $this->imigrate->addColumn($this->table, $name,'float');
        }

    }

    /**
     * Add double - To the table
     * @param $name - The name of the column being added
     * @param int $length - The length
     */
    public final function double($name, $length = NULL){
        if(isset($length)){
            $this->imigrate->addColumn($this->table, $name,'double', $length);
        }else{
            $this->imigrate->addColumn($this->table, $name,'double');
        }

    }
    /**
     * Add DECIMAL - To the table
     * @param $name - The name of the column being added
     * @param int $length - The length
     */
    public final function decimal($name, $length = NULL){
        if(isset($length)){
            $this->imigrate->addColumn($this->table, $name,'decimal', $length);
        }else{
            $this->imigrate->addColumn($this->table, $name,'decimal');
        }

    }

    /**
     * Add date - To the table
     * @param $name - The name of the column being added
     * @param int $length - The length
     */
    public final function date($name, $length = NULL ){
        $this->imigrate->addColumn($this->table, $name,'date', $length);
    }


    /**
     * Add datetime - To the table
     * @param $name - The name of the column being added
     * @param int $length - The length
     */
    public final function datetime($name, $length = NULL){
        if(isset($length)){
            $this->imigrate->addColumn($this->table, $name,'datetime', $length);
        }else{
            $this->imigrate->addColumn($this->table, $name,'datetime');
        }

    }


    /**
     * Add timestamp - To the table
     * @param $name - The name of the column being added
     * @param int $length - The length
     */
    public final function timestamp($name, $length = NULL){
        if(isset($length)){
            $this->imigrate->addColumn($this->table, $name,'timestamp', $length);
        }else{
            $this->imigrate->addColumn($this->table, $name,'timestamp');
        }

    }


    /**
     * Add time - To the table
     * @param $name - The name of the column being added
     * @param int $length - The length
     */
    public final function time($name, $length = NULL){
        if(isset($length)){
            $this->imigrate->addColumn($this->table, $name,'time', $length);
        }else{
            $this->imigrate->addColumn($this->table, $name,'time');
        }

    }


    /**
     * Add year - To the table
     * @param $name - The name of the column being added
     * @param int $length - The length
     */
    public final function year($name, $length = NULL){
        if(isset($length)){
            $this->imigrate->addColumn($this->table, $name,'year', $length);
        }else{
            $this->imigrate->addColumn($this->table, $name,'year');
        }

    }

    /**
     * Get data from table
     * @param array $where
     * @return array
     */
    public final function get($where=array()){
        if($this->imigrate->get($this->table, $where)){
            return $this->imigrate->getResults();
        }else{
            return $this->imigrate->getError();
        }
    }

    /**
     * Insert data into the table
     * @param array $fields
     * @return array
     */
    public final function insert($fields = array()){
        if($this->imigrate->insert($this->table,$fields)){
            return $this->imigrate->getResults();
        }else{
            return $this->imigrate->getError();
        }
    }

    /**Update database table
     * @param $whereField
     * @param $whereEqual
     * @param array $fields
     * @return array
     */
    public final function update($whereField, $whereEqual, $fields=array()){
        if($this->imigrate->update($this->table,$whereField, $whereEqual, $fields)){
            return $this->imigrate->getResults();
        }else{
            return $this->imigrate->getError();
        }
    }

    /**
     * delete data from the table
     * @param array $where
     * @return array
     */
    public final function delete($where = array()){
        if($this->imigrate->delete($this->table,$where)){
            return $this->imigrate->getResults();
        }else{
            return $this->imigrate->getError();
        }
    }

    /**
     * Clear the data from a table
     * @return \IEngine\iExtends\boool
     */
    public final function clearTableData(){
        return $this->imigrate->clearTable($this->table);
    }

    /**
     * Delete the table
     * @return bool
     */
    public final function deleteTable(){
        if($this->imigrate->deleteTable($this->table)){
            $this->__destruct();
        }else{
            return false;
        }
    }

    public final function removeColumn($columnName){
        return $this->imigrate->removeColumn($this->table, $columnName);
    }

}
