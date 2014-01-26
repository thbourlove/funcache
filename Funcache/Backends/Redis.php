<?php
namespace Funcache\Backends;

use Predis\Client;

class Redis implements \ArrayAccess
{
    private $redis;

    public function __construct(Client $client)
    {
        $this->redis = $client;
    }

    public function offsetSet($offset, $value)
    {
        return $this->redis->set($offset, $value) ? $value : null;
    }

    public function offsetExists($offset)
    {
        return $this->redis->exists($offset);
    }

    public function offsetUnset($offset)
    {
        return $this->redis->delete($offset);
    }

    public function offsetGet($offset)
    {
        return $this->redis->get($offset);
    }
}
