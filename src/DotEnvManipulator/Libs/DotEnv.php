<?php

namespace Absolute\DotEnvManipulator\Libs;

use Countable;
use ArrayAccess;
use ArrayIterator;
use JsonSerializable;
use IteratorAggregate;

class DotEnv implements ArrayAccess, Countable, JsonSerializable, IteratorAggregate
{
    protected $filePath;
    protected $envs = [];

    public function __construct($path, $file = '.env')
    {
        $this->filePath = $this->getFilePath($path, $file);
        $this->read();
    }

    public function all()
    {
        return $this->envs;
    }

    public function has($key)
    {
        return $this->offsetExists($key);
    }

    public function get($key)
    {
        return $this->offsetGet($key);
    }

    public function set($key, $value, $persistent = false)
    {
        $this->offsetSet($key, $value);
        if ($persistent) {
            $this->write();
        }

        return $this;
    }

    public function write()
    {
        file_put_contents($this->filePath, $this->toIni());

        return $this;
    }

    public function sort()
    {
        ksort($this->envs);

        return $this;
    }

    protected function read()
    {
        $filePath = $this->filePath;
        if (! $this->fileIsReadable($filePath)) {
            $this->envs = [];
        }
        $this->envs = parse_ini_file($filePath, false, INI_SCANNER_RAW);
    }

    protected function getFilePath($path, $file)
    {
        if (! is_string($file)) {
            $file = '.env';
        }

        $filePath = rtrim($path, DIRECTORY_SEPARATOR).DIRECTORY_SEPARATOR.$file;

        return $filePath;
    }

    protected function fileIsReadable($filePath)
    {
        return is_file($filePath) && is_readable($filePath);
    }

    public function toArray()
    {
        return $this->envs;
    }

    public function offsetExists($key)
    {
        return array_key_exists($key, $this->envs);
    }

    public function offsetGet($key)
    {
        if ($this->offsetExists($key)) {
            return $this->envs[$key];
        }

        return null;
    }

    public function offsetSet($offset, $value)
    {
        $this->envs[$offset] = $value;
    }

    public function offsetUnset($offset)
    {
        unset($this->envs[$offset]);
    }

    public function getIterator()
    {
        return new ArrayIterator($this->envs);
    }

    public function jsonSerialize()
    {
        return $this->toArray();
    }

    public function toJson($options = 0)
    {
        return json_encode($this->jsonSerialize(), $options);
    }

    public function count()
    {
        return count($this->envs);
    }

    public function toIni()
    {
        $output = '';
        foreach ($this->envs as $key => $value) {
            $output .= "{$key}={$value}".PHP_EOL;
        }

        return trim($output);
    }

    public function toString()
    {
        return $this->toIni();
    }

    public function __toString()
    {
        return $this->toIni();
    }
}
