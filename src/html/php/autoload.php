<?php
/**
 * Created by PhpStorm.
 * User: montanawong
 * Date: 4/24/16
 * Time: 17:53
 */

spl_autoload_register(function ($class_name) {
    include '/Users/montanawong/Sites/RecDawgs/src/' . str_replace('\\', '/', $class_name) .'.php';
});