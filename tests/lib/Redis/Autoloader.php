<?php

namespace Redis;

if (!extension_loaded('redis')) {
    throw new \RuntimeException('php redis extension not found');
}

// append Cli autoloader
spl_autoload_register(array('\Redis\Autoloader', 'Autoloader'));

/**
 * Base class
 * @author alxmsl
 * @date 11/1/12
 */
final class Autoloader {
    /**
     * @var array array of available classes
     */
    private static $classes = array(
        'Redis\\Autoloader'             => 'Autoloader.php',
        'Redis\\Client\\RedisInterface' => 'RedisInterface.php',
        'Redis\\Client\\Redis'          => 'Redis.php',
        'Redis\\Client\\RedisFactory'   => 'RedisFactory.php',
    );

    /**
     * Component autoloader
     * @param string $className claass name
     */
    public static function Autoloader($className) {
        if (array_key_exists($className, self::$classes)) {
            $fileName = realpath(dirname(__FILE__)) . '/' . self::$classes[$className];
            if (file_exists($fileName)) {
                include $fileName;
            }
        }
    }
}
