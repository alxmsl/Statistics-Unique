Statistics-Unique
=============
This is small driver for store unique statistics for numeric identifiers in the Redis

Usage example
-------
    // Firstly include base class
    include('../source/Autoloader.php');

    // Include Redis library base class from https://github.com/alxmsl/Redis
    include('lib/Redis/Autoloader.php');

    use Redis\Client\RedisFactory,
        Statistics\Unique\Driver;

    // Create new Redis client instance
    $Redis = \Redis\Client\RedisFactory::createRedisByConfig(array(
        'host' => 'localhost',
        'port' => 6379,
    ));

    // Create driver instance
    $Driver = new Driver($Redis);

    // Set unique event with name 'some_event' for object with id 42583
    $Driver->setEvent('some_event', 42583);

    // Get total unique events count for event 'some_event'
    var_dump($Driver->getEventCount('some_event'));
