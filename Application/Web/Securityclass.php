<?php
/**
 * Cookbook
 * 
 * A private application software for php
 * 
 * @package Cookbook
 * @license http://xxx
 * @link http://xxx/link
 * @version 1.0
 * @link 1.0
 */

namespace Application\Web;

/**
 * Security class
 * 
 * Test the syntax abstraction class
 * @category Web
 * @author siwen.zhao
 * @link http://xxx/link
 */
class Securityclass
{
    /**
     * Filter
     * 
     * @var array
     */
    public $filter;
    
    /**
     * Validate
     * 
     * @var array
     */
    public $validate;
    
    /**
     * Construct
     * 
     * Initialize the filter and validate
     * @return void
     */
    public function __construct()
    {
        $this->filter = [
            'striptags' => function ($a) 
            {
            return strip_tags($a);
        },
        'digits' => function ($a) 
        {
            return preg_replace('/[^0-9]/', '', $a);
        },
        'alpha' => function ($a) 
        {
            return preg_replace('/[^A-Z]/', '', $a);
        }
        ];
        $this->validate = [
            'alnum' => function ($a)
            {
            return ctype_alnum($a);
        },
        'digits' => function ($a)
        {
            return ctype_digit($a);
        },
        'alpha' => function ($a)
        {
            return ctype_alpha($a);
        }
        ];
    }
    
    /**
     * _Call
     * 
     * Call a nonexistent function and call the magic function automatically
     * 
     * @param string $method
     * @param array $params
     * @return string
     */
    public function __call($method, $params)
    {
        preg_match('/^(filter|validate)(.*?)$/', $method, $match);
        $prefix = $match[1] ?? '';
        $function = strtolower($match[2] ?? '');
        if ($prefix && $function)
        {
            return $this->$prefix[$function] ($params[0]);
        }
        return false;
    }
}