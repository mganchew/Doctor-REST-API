<?php
/**
 * Created by PhpStorm.
 * User: mladen
 * Date: 15-7-14
 * Time: 15:56
 */
// First, define your auto-load function.
function MyAutoload($className){
    include_once($className . '.php');
}

// Next, register it with PHP.
spl_autoload_register('MyAutoload');