<?php

namespace Redis\Client;

/**
 * Factory for simple PhpRedis instance creation
 * @author alxmsl
 * @date 11/1/12
 */
final class RedisFactory {
    /**
     * Create PhpRedis instance by array config
     * @param array $config array configuration
     * @throws \InvalidArgumentException
     */
    public static function createRedisByConfig(array $config) {
        if (!isset($config['host']) || !isset($config['port'])) {
            throw new \InvalidArgumentException();
        }

        $Redis = new Redis();
        $Redis->setHost($config['host'])
            ->setPort($config['port']);
        (isset($config['connect_timeout'])) && $Redis->setConnectTimeout($config['connect_timeout']);
        (isset($config['connect_tries'])) && $Redis->setConnectTries($config['connect_tries']);
        return $Redis;
    }
}
