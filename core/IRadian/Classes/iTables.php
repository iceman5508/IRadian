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
    public final function char($name, $length = 254){
        $this->imigrate->addColumn($this->table, $name,'char', $length);
    }

    /**
     * Add varchar- To the table
     * @param $name - The name of the column being added
     * @param int $length - The length
     */
    public final function varchar($name, $length = 254){
        $this->imigrate->addColumn($this->table, $name,'varchar', $length);
    }

    /**
     * Add tinytext To the table
     * @param $name - The name of the column being added
     * @param int $length - The length
     */
    public final function tinytext($name, $length = 254){
        $this->imigrate->addColumn($this->table, $name,'tinytext', $length);
    }

    /**
     * Add text - To the table
     * @param $name - The name of the column being added
     * @param int $length - The length
     */
    public final function text($name, $length = 65534){
        $this->imigrate->addColumn($this->table, $name,'text', $length);
    }

    /**
     * Add blob - To the table
     * @param $name - The name of the column being added
     * @param int $length - The length
     */
    public final function blob($name, $length = 65534){
        $this->imigrate->addColumn($this->table, $name,'blob', $length);
    }

    /**
     * Add mediumtext - To the table
     * @param $name - The name of the column being added
     * @param int $length - The length
     */
    public final function mediumtext($name, $length = 16777214){
        $this->imigrate->addColumn($this->table, $name,'mediumtext', $length);
    }

    /**
     * Add MEDIUMBLOB - To the table
     * @param $name - The name of the column being added
     * @param int $length - The length
     */
    public final function mediumblob($name, $length = 16777214){
        $this->imigrate->addColumn($this->table, $name,'mediumblob', $length);
    }

    /**
     * Add longtext - To the table
     * @param $name - The name of the column being added
     * @param int $length - The length
     */
    public final function longtext($name, $length = 4294967294){
        $this->imigrate->addColumn($this->table, $name,'longtext', $length);
    }

    /**
     * Add longblob - To the table
     * @param $name - The name of the column being added
     * @param int $length - The length
     */
    public final function longblob($name, $length = 4294967294){
        $this->imigrate->addColumn($this->table, $name,'longblob', $length);
    }

    /**
     * Add enum - To the table
     * @param $name - The name of the column being added
     * @param int $length - The length
     */
    public final function enum($name, $length = 65534){
        $this->imigrate->addColumn($this->table, $name,'enum', $length);
    }

    /**
    * Add tinyint- To the table
    * @param $name - The name of the column being added
    * @param int $length - The length
    */
    public final function tinyint($name, $length = 126){
        $this->imigrate->addColumn($this->table, $name,'tinyint', $length);
    }

    /**
     * Add smallint- To the table
     * @param $name - The name of the column being added
     * @param int $length - The length
     */
    public final function smallint($name, $length = 32766){
        $this->imigrate->addColumn($this->table, $name,'smallint', $length);
    }

    /**
     * Add mediumint- To the table
     * @param $name - The name of the column being added
     * @param int $length - The length
     */
    public final function mediumint($name, $length = 8388606 ){
        $this->imigrate->addColumn($this->table, $name,'mediumint', $length);
    }

    /**
     * Add int- To the table
     * @param $name - The name of the column being added
     * @param int $length - The length
     */
    public final function int($name, $length = 2147483646 ){
        $this->imigrate->addColumn($this->table, $name,'int', $length);
    }

    /**
     * Add bigint- To the table
     * @param $name - The name of the column being added
     * @param int $length - The length
     */
    public final function bigint($name, $length = 9223372036854775806 ){
        $this->imigrate->addColumn($this->table, $name,'bigint', $length);
    }

    /**
     * Add float- To the table
     * @param $name - The name of the column being added
     * @param int $length - The length
     */
    public final function float($name, $length = 255 ){
        $this->imigrate->addColumn($this->table, $name,'float', $length);
    }

    /**
     * Add double - To the table
     * @param $name - The name of the column being added
     * @param int $length - The length
     */
    public final function double($name, $length = 255 ){
        $this->imigrate->addColumn($this->table, $name,'double', $length);
    }

    /**
     * Add DECIMAL - To the table
     * @param $name - The name of the column being added
     * @param int $length - The length
     */
    public final function decimal($name, $length = 255 ){
        $this->imigrate->addColumn($this->table, $name,'decimal', $length);
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
    public final function datetime($name, $length = NULL ){
        $this->imigrate->addColumn($this->table, $name,'datetime', $length);
    }


    /**
     * Add timestamp - To the table
     * @param $name - The name of the column being added
     * @param int $length - The length
     */
    public final function timestamp($name, $length = NULL ){
        $this->imigrate->addColumn($this->table, $name,'timestamp', $length);
    }


    /**
     * Add time - To the table
     * @param $name - The name of the column being added
     * @param int $length - The length
     */
    public final function time($name, $length = NULL ){
        $this->imigrate->addColumn($this->table, $name,'time', $length);
    }


    /**
     * Add year - To the table
     * @param $name - The name of the column being added
     * @param int $length - The length
     */
    public final function year($name, $length = NULL ){
        $this->imigrate->addColumn($this->table, $name,'year', $length);
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
