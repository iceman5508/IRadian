<?php
/**
 * Created by PhpStorm.
 * User: iceman5508
 * Date: 10/19/2017
 * Time: 9:12 PM
 * Router class
 */

namespace  ITemplate\iExtends;


class iRouter
{
    private static $route_list = array();
    private static $route_param = null;
    private static $component=null;

    /**
     * Check if the router is called
     * @return bool
     */
    public static function callMade(){
        return (isset($_GET[self::$route_param])? true : false);
    }
    /**
     * Get the current instance of the route param as well as  set the  router url value
     * @param $route_param - The url param to use to pull routes
     */
    public static function runInstance($route_param){
        if(!isset(self::$route_param )) {
            self::$route_param = $route_param;
        }
    }

    /**
     * Register a specific route to a component
     * @param $route - The route that is being set
     * @param $componentLocation - The location of the php file containing the component
     */
    public static function call($route, $componentLocation){
       self::$route_list[$route] = '';
       require_once $componentLocation;

   }

    /**The answer method that goes on the answering component page
     * @param $route
     * @param iComponent $component
     */
    public static function answer($route, iComponent $component){
        if(isset( self::$route_list[$route])){
            self::$route_list[$route] = $component;
        }

    }

    /**
     * Scan page for any routes
     */
   public static function scanner(){
      if(count(self::$route_list)>0 && isset($_GET[self::$route_param])){
          $path_parts = pathinfo($_GET[self::$route_param]);
          $data =  $path_parts['filename'];
          foreach (self::$route_list as $route => $component){
              if($data == $route){
                  self::$component = $component;
              }
          }
      }else{
          self::$component = null;
      }
   }

    /**
     * Render the current route
     */
   public static function render(){
      if(isset(self::$component)) {
          self::$component->render();
      }
    }

    /**
 * Set a router link
 * @param $linkName
 * @return string
 */
    public static function routerLink($linkName){
        return '?'.self::$route_param.'='.$linkName;
    }



}