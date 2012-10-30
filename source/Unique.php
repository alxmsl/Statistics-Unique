<?php
namespace Statistics\Unique;

// append Statistics\Unique autoloader
spl_autoload_register(array('\Statistics\Unique\Unique', 'autoload'));

/**
 * Base class
 * @author alxmsl
 * @date 10/22/12
 */
final class Unique {
    /**
     * @var array array of available classes
     */
    private static $classes = array(
        'Statistics\\Unique\\Unique'        => 'Unique.php',
        'Statistics\\Unique\\Driver'        => 'Driver.php',
        'Statistics\\Unique\\RedisInterface'=> 'RedisInterface.php',
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