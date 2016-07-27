<?php

namespace Fung\Collections;


class Collection implements \ArrayAccess, \Iterator, \Countable, \JsonSerializable
{
    protected $items;

    public function __construct($items = [])
    {
        $this->items = $items;
    }

    public static function factory($items = [])
    {
        return new static($items);
    }

    public function count()
    {
        return count($this->items);
    }

    public function get($key, $default = null)
    {
        return isset($this->items[$key]) ? $this->items[$key] : $default;
    }

    public function set($key, $value)
    {
        $this->items[$key] = $value;
    }

    public function has($key)
    {
        return isset($this->items[$key]);
    }

    public function remove($key)
    {
        unset($this->items[$key]);
    }

    public function __get($key)
    {
        return $this->get($key);
    }

    public function __set($key, $value)
    {
        $this->set($key, $value);
    }

    public function __isset($key)
    {
        return $this->has($key);
    }

    public function __unset($key)
    {
        $this->remove($key);
    }

    public function offsetGet($offset)
    {
        return $this->get($offset);
    }

    public function offsetSet($offset, $value)
    {
        if ($offset)
            $this->set($offset, $value);
    }

    public function offsetExists($offset)
    {
        return $this->has($offset);
    }

    public function offsetUnset($offset)
    {
        $this->remove($offset);
    }

    public function rewind()
    {
        reset($this->items);
    }

    public function current()
    {
        return current($this->items);
    }

    public function key()
    {
        return key($this->items);
    }

    public function next()
    {
        return next($this->items);
    }

    public function keys()
    {
        return array_keys($this->items);
    }

    public function pop()
    {
        return array_pop($this->items);
    }

    public function shift()
    {
        return array_shift($this->items);
    }

    public function sort(\Closure $callback)
    {
        uasort($this->itmes, $callback);

        return $this;
    }

    public function isEmpty()
    {
        return empty($this->items);
    }

    public function toArray()
    {
        return array_map(function ($value) {
            return $value instanceof \Arrayable ? $value->toArray() : $value;
        }, $this->items);
    }

    public function jsonSerialize()
    {
        return $this->toArray();
    }

    public function toJson($options = 0)
    {
        return json_encode($this->toArray(), $options);
    }

    public function __toString()
    {
        return $this->toJson();
    }
}