<?php 
/**
 *Cookbook
 *
 *A private applicaton software for php
 *
 * @package Cookbook
 * @author siwen.zhao<1559617934@qq.com>
 * @copyright Copyright (c) 2018-2018,shaoke technology
 * @license http://xxx
 * @link http://xxx
 * @version v1.0
 * @since 1.0
 */
namespace Application\Autoload; //顶部命名空间

/**
 * Loader class
 * 
 * When other class new,if no ,this class can autoload the new class
 * 
 * @category Core
 * @author siwen.zhao
 * @link http://xxx/loader
 */
class Loader
{
    /**
     * Represents whether it is load
     * 
     * @var int
     */
    private static $registered = 0;
    
    /**
     * File directory
     * 
     * @var array
     */
    private static $dirs = array();
    
    /**
     * The constant description cannot load the file
     * 
     * @var string
     */
    const UNABLE_TO_LOAD = 'can not load';
    /**
     * Construct
     * 
     * Class is called automatically when instantiated
     * 
     * @param array $dirs
     * @return void
     */
    public function __construct($dirs = array())
    {
        self::init($dirs);
    }
    
    /**
     * Init
     * 
     * Register the automatic loader
     * 
     * @param mixed $dirs
     * @return void
     */
    public static function init($dirs)
    {
        if ($dirs) {
            self::addDirs($dirs);
        }
        if (self::$registered == 0) {
            spl_autoload_register(__CLASS__ . '::autoload');
            self::$registered++;
        }
    }
    
    /**
     * AddDirs
     * 
     * Add the directory where the class is located
     * 
     * @param mixed $dirs
     * @return void
     */
    public static function addDirs($dirs)
    {
        if (is_array($dirs)) {
            self::addDirs($dirs);
        } else {
            self::$dirs[] = $dirs;
        }
    }
    
    /**
     * AutoLoad
     * 
     * Class name are passed as parameters in the form of namespaces,and the
     * deliiters in parameters are converted into system directory delimiters.
     * Finally,a namespace is formed
     * 
     * @param string $class
     * @return bool
     */
    public  static function autoLoad($class)
    {
        $success = false;
        $fn = str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
        foreach (self::$dirs as $start) {
            $file = $start . DIRECTORY_SEPARATOR . $fn;
            if (self::loadFile($file)) {
                $success = true;
                break;
            }
        }
        if (!$success) {
            if (!self::loadFile(__DIR__ . DIRECTORY_SEPARATOR . $fn)) {
                throw  new \Exception(self::UNABLE_TO_LOAD . '' .$class);
            }
        }
        return $success;
    }
    
    /**
     * Load file
     * 
     * Check if the file exists and load it
     * 
     * @param string $file
     * @return bool
     */
    protected static function loadFile($file)
    {
        if (file_exists($file)) {
            require_once $file;
            return true;
        }
        return false;
    }
}
