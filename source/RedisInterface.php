<?php

namespace Statistics\Unique;

/**
 * Interface for needed Redis commands
 * @author alxmsl
 * @date 10/30/12
 */
interface RedisInterface {
    /**
     * Reconnect to Redis if needed
     */
    public function reconnect();

    /**
     * Increment key value
     * @param string $key key
     * @return int current value
     */
    public function incr($key);

    /**
     * Get key value
     * @param string $key key
     * @return mixed key value
     */
    public function get($key);

    /**
     * Set key bit
     * @param string $key key
     * @param int $offset bit offset
     * @param int $value bit value. May be 0 or 1
     * @return int bit value before operation complete
     */
    public function setbit($key, $offset, $value);

    /**
     * Evaluate Lua code
     * @param string $sha SHA1 string of Lua code
     * @return mixed code execution result
     */
    public function evalSha($sha);
}
