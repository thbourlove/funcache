<?php
namespace Funcache;

class DefaultGenerator implements GeneratorInterface
{
    public function generate($namespace, array $args)
    {
        return $namespace.':'.implode($args, '_');
    }
}
