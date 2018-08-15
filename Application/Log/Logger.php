<?php

namespace Application\Log;

use Application\Log\LoggerMessage;
/**
 * This Logger can be used to avoid conditional log calls.
 *
 * Logging should always be optional, and if no logger is provided to your
 * library creating a NullLogger instance to have something to throw logs at
 * is a good way to avoid littering your code with `if ($this->logger) { }`
 * blocks.
 */
class Logger extends AbstractLogger
{
    /**
     * Log filename
     * 
     * @var $filename
     */
    public static $filename;
    
    public function __construct()
    {
        self::$filename = LoggerMessage::$logPath . date('Y-m-d') . LoggerMessage::$logFileExt;
    }
    /**
     * Logs with an arbitrary level.
     *
     * @param mixed  $level
     * @param string $message
     * @param array  $context
     *
     * @return void
     */
    public function log($level, $message, array $context = array())
    {
        if (empty($level)) {
            $this->critical(LoggerMessage::$loggerLevelNotExists);
        }
        
        if (!empty($context)) {
            $replace = array();
            foreach ($context as $key => $val) {
                $replace['{' . $key . '}'] = $val;
            }
            $message = strtr($message, $replace);
        }
        $msg = '[' . date('Y-m-d H:i:s') . ']' .
                     $level .' '. $message . PHP_EOL;
                     $fp = fopen(self::$filename, 'a');
       flock($fp, LOCK_EX);
       fwrite($fp, $msg);
       flock($fp, LOCK_UN);
       fclose($fp);
    }
}
