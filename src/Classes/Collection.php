<?php

namespace Bling\Classes;


class Collection
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
}
