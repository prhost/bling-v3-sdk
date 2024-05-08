<?php

namespace Prhost\Bling\Classes;


class Collection implements \IteratorAggregate
{
    protected $items = [];

    public function __construct($data = null)
    {
        if ($data && is_array($data)) {
            foreach ($data as $item) {
                $this->push($item);
            }
        }
    }

    public function push($item)
    {
        $this->items[] = $item;
    }

    public function whereInstanceOf($class)
    {
        return new static(array_filter($this->items, function ($item) use ($class) {
            return $item instanceof $class;
        }));
    }

    public function has($attribute)
    {
        return isset($this->items[$attribute]);
    }

    public function __get($attribute)
    {
        return $this->items[$attribute] ?? null;
    }

    public function __call($name, $arguments)
    {
        if (strpos($name, 'get') === 0) {
            $attribute = ltrim($name, 'get');
            return $this->{$attribute};
        }
    }

    public function toArray()
    {
        return $this->items;
    }

    public function count()
    {
        return count($this->items);
    }

    public function first()
    {
        return $this->items[0] ?? null;
    }

    public function last()
    {
        return $this->items[count($this->items) - 1] ?? null;
    }

    public function map(callable $callback)
    {
        return array_map($callback, $this->items);
    }

    public function where($key, $value)
    {
        return new static(array_filter($this->items, function ($item) use ($key, $value) {
            return $item->{$key} == $value;
        }));
    }

    public function __iterable()
    {
        return $this->items;
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->items);
    }

    public function __toString()
    {
        return json_encode($this->items);
    }

    public function __debugInfo()
    {
        return $this->items;
    }

    public function __isset($name)
    {
        return isset($this->items[$name]);
    }

    public function __set($name, $value)
    {
        $this->items[$name] = $value;
    }

    public function __unset($name)
    {
        unset($this->items[$name]);
    }
}
