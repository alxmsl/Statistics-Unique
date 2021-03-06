<?php

namespace Statistics\Unique;

/**
 * Base unique statistics driver
 * @author alxmsl
 * @date 10/30/12
 */
final class Driver {
    /**
     * Prefix for bitmap keys
     */
    const PREFIX_UNIQUE     = 'STATISTICS_UNIQUE_';

    /**
     * Prefix for fast set bits counters
     */
    const PREFIX_COUNTER    = 'STATISTICS_COUNTER_';

    /**
     * @var \Redis\Client\RedisInterface Redis wrapper instance
     */
    private $Redis = null;

    /**
     * @param \Redis\Client\RedisInterface $Redis Redis wrapper instance
     */
    public function __construct(\Redis\Client\RedisInterface $Redis) {
        $this->Redis = $Redis;
    }

    /**
     * Set event by unique identifier
     * @param string $name event name
     * @param int $id unique identifier for the event
     */
    public function setEvent($name, $id) {
        $counter = $this->getKey($name);
        $oldValue = $this->Redis->setbit($counter, $id, 1);
        if ($oldValue == 0) {
            $counter = $this->getCounterKey($name);
            $this->Redis->incr($counter);
        }
    }

    /**
     * Getter for events count
     * @param string $name event name
     * @return int unique event count
     */
    public function getEventCount($name) {
        $counter = $this->getCounterKey($name);
        return (int) $this->Redis->get($counter);
    }

    /**
     * Reconcile bitmap bits count and fast counter value
     * Be sure for call this method, because it use O(n) time complexity
     * @param string $name event name
     * @return int current unique event count
     */
    public function fixEventCount($name) {
        $key = $this->getKey($name);
        $counter = $this->getCounterKey($name);
        $code = 'return redis.call(\'set\', \'' . $counter . '\', redis.bitcount(\'' . $key . '\'))';
        return $this->Redis->evalSha(sha1($code));
    }

    /**
     * Build Redis key for event
     * @param string $name event name
     * @return string Redis key for event
     */
    private function getKey($name) {
        return self::PREFIX_UNIQUE . $name;
    }

    /**
     * Build Redis counter name for event
     * @param string $name event name
     * @return string Redis key for event counter
     */
    private function getCounterKey($name) {
        return self::PREFIX_COUNTER . $name;
    }
}
