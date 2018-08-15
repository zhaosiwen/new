<?php 
/**
 * Cookbook
 * 
 * A private application software for php
 * 
 * @package Cookbook
 * @author siwen.zhao<15596179@qq.com>
 * @copyright Copyright (c) 2018-2018,shaoke technology
 * @license http://xxx
 * @link http://xxxx/index.php
 * @version 1.0
 * @since 1.0
 */

/**
 *Index
 *
 * Applicaton entry file
 */
require  __DIR__ . '/Application/Autoload/Loader.php';
\Application\Autoload\Loader::init(__DIR__);
$test = new \Application\Test\TestClass();
 echo $test->getTest();
 