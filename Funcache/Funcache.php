<?php
namespace Funcache;

class Funcache
{
    private $backend;

    public function __construct(\ArrayAccess $backend = null)
    {
        $this->backend = $backend;
    }

    public function cacheOnArguments($callable, $namespace, $generator = null)
    {
        return new CacheOnArgument($callable, $namespace, $generator ?: new DefaultGenerator(), $this);
    }

    public function get($key)
    {
        return $this->backend[$key];
    }

    public function set($key, $value)
    {
        return $this->backend[$key] = $value;
    }

    public function delete($key)
    {
        unset($this->backend[$key]);
    }

    public function has($key)
    {
        return isset($this->backend[$key]);
    }
}
