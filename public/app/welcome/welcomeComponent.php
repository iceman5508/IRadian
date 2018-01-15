<?php

/**
 * Created by PhpStorm.
 * User: iceman5508
 * Date: 11/12/2017
 * Time: 2:23 PM
 */
class welcomeComponent extends \ITemplate\iExtends\iComponent
{
    //method required by iComponent contract
    public  function render()
    {
        // TODO: Implement render() method.
    }

    //method required by iComponent contract
    public  function attributes()
    {
       $this->title = 'Welcome Page';
       $this->name = 'IRadian';
       $this->tag = "Perfection to a degree <br><br>
         <a href='https://github.com/iceman5508/IRadian'> Github </a>| <a href='docs/index.html'>Docs </a>";
       $this->icon = 'http://imedia.epizy.com/application/views/images/logo/logo2.png';
    }

}