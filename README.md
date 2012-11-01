Statistics-Unique
=============
This is small driver for store unique statistics for numeric identifiers in the Redis

Usage example
-------
    /**
     * Small wrapper on phpredis for example
     * @see https://github.com/nicolasff/phpredis
     */
    final class RedisClient extends Redis implements RedisInterface {
        //TODO: you need to implement RedisInterface methods
    }

    // Create new Redis client instance
    $Redis = new RedisClient();

    // Create driver instance
    $Driver = new Driver($Redis);

    // Set unique event with name 'some_event' for object with id 42583
    $Driver->setEvent('some_event', 42583);

    // Get total unique events count for event 'some_event'
    var_dump($Driver->getEventCount('some_event'));
