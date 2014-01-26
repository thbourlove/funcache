<?php
namespace Funcache;

interface GeneratorInterface
{
    public function generate($namespace, array $args);
}
