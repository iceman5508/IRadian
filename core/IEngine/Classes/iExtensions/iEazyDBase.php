<?php
/**
 * Created by PhpStorm.
 * User:Isaac Parker
 * Date: 9/5/2017
 * Time: 12:07 AM
 * This class makes it easy to handle database information
 */

namespace IEngine\iExtends;


use IEngine\ibase\iDatabase;

class iEazyDBase
{
    /**
     * Update sql, only updates one field
     * @param $table - table to update
     * @param $id - the row id the update will occur on
     * @param $field - the field name to update
     * @param $fieldData - the data that the $field will be set to
     * @return bool
     */
    public static function update($table, $id, $field, $fieldData){
        $sql = "UPDATE ".$table." SET ".$table.".".$field."='".$fieldData."' WHERE {$table}.id=".$id."";
        $get = iDatabase::getInstance()->simpleQuery($sql);
        if($get->error()==false) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * A customized update query only updates one field
     * @param $table - the table to update
     * @param $whereField - the field name in the table
     * @param $whereEqual - the equal value of the field to check for
     * @param $field - the field to update
     * @param $fieldData - the data to update the field to
     * @return bool
     */
    public static function updateCustom($table, $whereField,$whereEqual, $field, $fieldData){
        $sql = "UPDATE ".$table." SET ".$field."='".$fieldData."' WHERE ".$whereField."=".$whereEqual."";
        $get = iDatabase::getInstance()->simpleQuery($sql);
        if($get->error()==false) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Run a custom query
     * @param $sql - The query to run
     * @return results
     */
    public static function query($sql){
        $get = iDatabase::getInstance()->simpleQuery($sql);
        if($get->error()==false) {
            return $get->results();
        } else {
            return false;
        }
    }

    /**
     * Insert data into a database table
     * @param $table - the table to be in
     * @param array $fields - associative array example
     * ('fieldname' => 'value')
     * @return bool
     */
    public static function insert($table, $fields = array()){
        if( iDatabase::getInstance()->insertQuery($table , $fields)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * a get query from the table - returns only one result from the table
     * @param $id
     * @param $table
     * @return null
     */
    public static function get($id, $table){
        $sql = "SELECT * FROM ".$table." WHERE ".$table.".id=".$id."";
        $get = iDatabase::getInstance()->simpleQuery($sql);
        if($get->count()>0) {
            return $get->first();
        } else {
            return null;
        }
    }

    /**
     * Delete a row from the table - only one row
     * @param $table
     * @param $field
     * @param $equalField
     * @return bool
     */
    public static function delete($table,$field, $equalField){
        $sql = "DELETE FROM ".$table." WHERE ".$table.".".$field."=".$equalField."";
        if( iDatabase::getInstance()->simpleQuery($sql)) {
            return true;
        }else { return false; }
    }

    /**
     * A customized get query
     * @param $table
     * @param $field - the field to check against
     * @param $equalField - the field data to check against
     * @return null
     */
    public static function getCustom($table,$field, $equalField){
        $sql = "SELECT * FROM ".$table." WHERE ".$table.".".$field."=".$equalField."";
        $get = iDatabase::getInstance()->simpleQuery($sql);
        if($get->count()>0) {
            return $get->results();
        } else {
            return null;
        }

    }

    /**
     * A sql get query
     * @param $sql
     * @return null
     */
    public static function sqlGet($sql){
        $get = iDatabase::getInstance()->simpleQuery($sql);
        if($get->count()>0) {
            return $get->results();
        } else {
            return null;
        }
    }

}