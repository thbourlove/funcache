<?php
namespace Funcache;

class CacheOnArgument
{
    private $callable;
    private $namespace;
    private $generator;
    private $cache;

    public function __construct($callable, $namespace, GeneratorInterface $generator, Funcache $cache)
    {
        $this->callable = $callable;
        $this->namespace = $namespace;
        $this->generator = $generator;
        $this->cache = $cache;
    }

    public function __invoke()
    {
        $args = func_get_args();
        $key = $this->key($args);
        if ($this->cache->has($key)) {
            return $this->cache->get($key);
        }
        return $this->cache->set($key, call_user_func_array($this->callable, $args));
    }

    public function clear()
    {
        $args = func_get_args();
        $key = $this->key($args);
        $this->cache->delete($key);
    }

    public function refresh()
    {
        $args = func_get_args();
        $key = $this->key($args);
        return $this->cache->set($key, call_user_func_array($this->callable, $args));
    }

    private function key(array $args)
    {
        return $this->generator->generate($this->namespace, $args);
    }
}
