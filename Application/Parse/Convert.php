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

namespace Application\Parse;

/**
 * Convert php5 to php7
 * 
 * Adapt the php5 code to php7
 * 
 * @category Convert
 * @author zhaosiwen
 *@link http://xxx/xx
 */
class Convert
{
    /**
     * File not exists
     * 
     * @var string
     */
    const EXCEPTION_FILE_NOT_EXISTS = 'file not exists';
    
/**
 * Scan file
 * 
 * Read PHP file,converting each line of the file to each element of the array
 * 
 * @param string $filename
 * @return array
 */
    public function scan($filename)
    {
        if (!file_exists($filename)) {
            throw new \Exception(self::EXCEPTION_FILE_NOT_EXISTS);
        }
        $content = file($filename);
        echo 'Processing:' . $filename . PHP_EOL;
        
        $result = preg_replace_callback_array(
            [
                '!\<\%(\n| )!' => function ($match)
                {
                    return '<?php' . $match[1];
            },
            '!\<\%=(\n| )!' => function ($match)
            {
                return '<?php' . $match[1];
            },
            '!\%\>!' => function ($match)
            {
                return '';
            }
            ]
            , $content);
        return implode(' ', $result);
    }
}