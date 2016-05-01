<?php
/**
 * Created by PhpStorm.
 * User: montanawong
 * Date: 4/25/16
 * Time: 14:39
 */

spl_autoload_register(function ($class_name) {
    include '/Users/montanawong/Sites/RecDawgs/src/src/' . str_replace('\\', '/', $class_name) .'.php';
});