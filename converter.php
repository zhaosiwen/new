<?php
/**
 * Cookbook
 * 
 * A private application software for php
 * 
 * @package Cookbook
 * @author siwe.zhao<1559617934@qq.com>
 * @license http://xxx/xx
 * @link http://xxxx
 * @version 1.0
 * @since 1.0
 */

/**
 * Converter
 * 
 * Convert php5 to php7 entry file
 */
 $filename = $argv[1] ?? '/usr/local/nginx/html/new/test.php';
 
 if (!$filename) {
     echo 'No filename provided' . PHP_EOL;
     echo 'Usage: ' . PHP_EOL;
     echo __FILE__ . ' <filename>' . PHP_EOL;
     exit;
 }
 require 'vendor/autoload.php';
 
//  require __DIR__ . '/Application/Autoload/Loader.php';
//  \Application\Autoload\Loader::init(__DIR__);
 
 $convert = new Application\Parse\Convert();
 echo $convert->scan($filename);
 echo PHP_EOL;  