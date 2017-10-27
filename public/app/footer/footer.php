<?php
/**
 * Created by PhpStorm.
 * User: iceman5508
 * Date: 10/17/2017
 * Time: 11:24 PM
 */
use ITemplate\iExtends\iComponent;
use ITemplate\iExtends\iTags;

class footer extends iComponent {
    public function render()
    {
        // TODO: Implement render() method.
    }
}

$footer = new footer('footer/footer.html');
$footer->cwp = 'IRadian 2017';
iTags::setTag('footer',$footer);
iComponent::export('footer');

