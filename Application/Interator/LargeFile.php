<?php
/**
 *Cookbook
 *
 * A private application software for php
 * 
 * @package Cookbook
 * @author siwen.zhao
 * @license 
 * @link
 * @version
 * @since
 */

namespace Application\Interator;

use Application\Log\InvalidArgumentException;

/*l*
 * Interator
 * 
 *  A interator class test for yeild
 *  
 *  @category Interator
 *  @author siwen.zhao
 *  @link http://xxx
 */
class LargeFile
{
    const ERROR_UNABLE = 'ERROR:Unable to open file';
    const ERROR_TYPE = 'ERROR:Type must be ByLength Byline or Csv';
    protected $file;
    protected $allowedTypes = ['ByLine', 'ByLength','Csv'];
    
    public function __construct($filename, $mode = 'r')
    {
        if (!file_exists($filename)) {
            $message = __METHOD__ . ':' . self::ERROR_UNABLE . PHP_EOL;
            $message .= strip_tags($filename) . PHP_EOL;
            echo $message;
            throw new \Exception($message);
        }
        $this->file = new \SplFileObject($filename,$mode);
    }
    
    protected function fileIteratorByLine()
    {
        $count = 0;
        while (!$this->file->eof()) {
            yield  $this->file->fgets();
            $count++;
        }
        return $count;
    }
    
    protected function fileIteratorByLength($numBytes = 1024) 
    {
        $count = 0;
        while (!$this->file->eof()) {
            yield $this->file->fread($numBytes);
            $count++;
        }
        return $count;
    }
    
    public function getIterator($type = 'ByLine', $numBytes = null)
    {
        if (!in_array($type, $this->allowedTypes)) {
            $message = __METHOD__ . ':' . self::ERROR_TYPE . PHP_EOL;
            throw  new InvalidArgumentException($message);
        }
        $iterator = 'fileIterator' . $type;
        return new \NoRewindIterator($this->$iterator($numBytes));
    }
    
}