<?php 
/**
 *Cookbook
 *
 * A private application software for php
 * 
 * @package Cookbook
 * @author siwen.zhao<1559617934@qq.com>
 * @copyright Copyright (C) 2018-2018,shaoke technology
 * @license http://xxx
 * @link http://xxx
 * @version 1.0
 * @since 1.0
 */
namespace Application\Web;

/**
 *Hoover
 *
 * The class to capture web content
 * 
 * @category web
 * @author siwen.zhao<1559617934@qq.com>
 * @link http://xxx/web
 */
class Hoover
{
    /**
     * Page content
     * 
     * @var object
     */
    public $content = '';
    
    /**
     * Get content
     * 
     * Gets the entire page content
     * 
     * @param string $url
     * @return object
     */
    public function getContent($url)
    {
        if (!$this->content) {
            if (stripos($url, 'http') !== 0) {
                $url = 'http://' . $url;
            }
            $this->content = new \DOMDocument('1.0', 'utf-8');
            $this->content->preserveWhiteSpace = false;
            @$this->content->loadHTMLFile($url);
        }
        return $this->content;
    }
    
    /**
     * Get tags
     * 
     * Get the tags of interest
     * 
     * @param string $url
     * @param string $tag
     * @return array
     */
    public function getTags($url, $tag)
    {
        $count = 0;
        $result = array();
        $elements = $this->getContent($url)
        ->getElementsByTagName($tag);
         foreach ($elements as $node) {
            $result[$count]['value'] = trim(
                preg_replace('/\s+/', '', $node->nodeValue));
            if ($node->hasAttributes()) {
                foreach ($node->attributes as $name => $attr) {
                    $result[$count]['attributes'][$name] = $attr->value;
                }
            }
        $count++;
        }
        return $result;
    }
    
    /**
     * Get attribute
     * 
     * Extract the specified attribute
     * 
     * @param string $url
     * @param string $attr
     * @param mixed $domain
     * @return arrayb
     */
    public function getAttribute($url, $attr, $domain = null)
    {
        $result = array();
        $elements = $this->getContent($url)
        ->getElementsByTagName('*');
        foreach ($elements as $node) {
            if ($node->hasAttribute($attr)) {
                $value = $node->getAttribute($attr);
                if ($domain) {
                    if (stripos($value,$domain) !== false) {
                        $result[] = trim($value);
                    }
                } else {
                    $result[] = trim($value);
                 }
            }
        }
        return $result;
    }
}