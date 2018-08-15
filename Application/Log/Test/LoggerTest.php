<?php
/**
 * Cookbook
 * 
 * A private application software for php
 * 
 * @package Cookbook
 * @author siwen.zhao<1559617934@qq.com>
 * @license http://xxx/license
 * @link http://xxx/link
 * @version 1.0
 * @since 1.0
 */

namespace Application\Log\Test;

use Application\Log\Test\LoggerInterfaceTest;
use Application\Log\Logger;
// require 'vendor/autoload.php';
/**
 * Auto test logger
 * 
 * Automated test log classes
 */

class LoggerTest extends LoggerInterfaceTest
{
    /**
     * Get logger
     * 
     * Gets the log class instantiated object
     * 
     * @return void
     */
    public function getLogger()
    {
        return  new \Application\Log\Logger();
    }
    
    /**
     * Get logs
     * 
     * Get the last line of the file
     * 
     * @see \Application\Log\Test\LoggerInterfaceTest::getLogs()
     * @return string
     */
    public function getLogs(){
        $filename = \Application\Log\Logger::$filename;
        $fp = fopen($filename, 'r');
        fseek($fp, -1, SEEK_END);
        $s = '';
        while(($c = fgetc($fp)) !== false) {
            if($c == "\n" && $s) break;
            $s = $c . $s;
            fseek($fp, -2, SEEK_CUR);
        }
        fclose($fp);
        preg_match('/\](.*?)\n/', $s, $match);
        return $match[1];
    }
}
 