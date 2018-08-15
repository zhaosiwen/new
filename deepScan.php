<?php
/**
 * Cookbook
 * 
 * A private application software for php
 * 
 *  @package Cookbook
 *  @author siwen.zhao<1559617934@qq.com>
 *  @license http://xxxx/license
 *  @link http://xxx/link
 *  @version 1.0
 *  @since 1.0
 */

/**
 * Deep scan page
 * 
 * Scan the page to get the desired tag
 */
 define('DEFAULT_URL', 'vip.com');
 define('DEFAULT_TAG', 'img');
 
 require __DIR__ . '/Application/Autoload/Loader.php';
 \Application\Autoload\Loader::init(__DIR__);
 
 $deep = new Application\Web\Deep();'https://' .DEFAULT_URL . 
 $url = strip_tags($_GET['url'] ?? DEFAULT_URL);
 $tag = strip_tags($_GET['tag'] ?? DEFAULT_TAG);
 
 foreach ($deep->scan($url, $tag) as $item) {
     $src = $item['attributes']['src'] ?? null;
     if ($src && (stripos($src, 'png') || stripos($src, 'jpg'))) {
         printf('<br><img src="%s">', $src);
     }
 }