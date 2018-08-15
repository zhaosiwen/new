<?php 
/**
 * Cookbook
 * 
 * A private application software for php
 * 
 * @package Cookbook
 * @author siwen.zhao<1559617934@qq.com>
 * @license http://xxx
 * @link http://xxx/we
 * @version 1.0
 * @since 1.0
 */

/**
 * Website
 * 
 * Test the operation page class
 */
define('DEFAULT_URL',  'http://oreilly.com');
define('DEFAULT_TAG', 'a');

require __DIR__ . '/Application/Web/Hoover.php';
$vac =  new \Application\Web\Hoover();
$url = strip_tags($_GET['url'] ?? DEFAULT_URL);
$tag = strip_tags($_GET['tag'] ?? DEFAULT_TAG);

echo 'Dump of Tags: ' . PHP_EOL;

var_dump($vac->getAttribute($url, 'href'));
