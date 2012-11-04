<?php
namespace Statistics\Unique;

// append Statistics\Unique autoloader
spl_autoload_register(array('\Statistics\Unique\Autoloader', 'autoload'));

/**
 * Base class
 * @author alxmsl
 * @date 10/22/12
 */
final class Autoloader {
    /**
     * @var array array of available classes
     */
    private static $classes = array(
        'Statistics\\Unique\\Autoloader'    => 'Autoloader.php',
        'Statistics\\Unique\\Driver'        => 'Driver.php',
        'Redis\\Client\\RedisInterface'     => 'https://raw.github.com/alxmsl/Redis/master/source/RedisInterface.php',
    );

    /**
     * Component autoloader
     * @param string $className claass name
     */
    public static function autoload($className) {
        if (array_key_exists($className, self::$classes)) {
            $fileName = realpath(dirname(__FILE__)) . '/' . self::$classes[$className];
            if (file_exists($fileName)) {
                include $fileName;
            }
        }
    }
}