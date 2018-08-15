<?php
/**
 *cookbook
 *
 * A private application software for php
 * 
 * @package Cookbook
 * @author siwen.zhao
 * @license http://xxx
 * @link http://xxx
 * @version 1.0
 * @since 1.0
 */

/**
 * Access class
 * 
 * Search for IP in the file and rank them from large to small according to hte number of occurrences of Ip
 * 
 * @category Web
 * @author siwen.zhao
 * @link http://xxxx/
 */
 
namespace Application\Web;

use Exception;
use SplFileObject;
use Application\Log\Logger;

class Access
{
    const ERROR_UNABLE = 'ERROR: unable to open file';
    protected  $log;
    public $frequency = array();
    
    public function __construct($filename)
    {
        if (!$filename) {
            $message = __METHOD__ . ":" . self::ERROR_UNABLE . PHP_EOL;
            $message .= strip_tags($filename) . PHP_EOL;
            $log = new \Application\Log\Logger();
            $log->error($message);
            throw new \Exception($message);
        }
        $this->log = new \SplFileObject($filename, 'r');
    }
    
    public function fileIteratorByLine()
    {
        $count = 0;
        while (!$this->log->eof()) {
            yield $this->log->fgets();
            $count++;
        }
        return $count;
    }
    
    public function getIp($line)
    {
        preg_match('/(\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3})/', $line, $match);
        return $match[1] ?? '';
    }
}