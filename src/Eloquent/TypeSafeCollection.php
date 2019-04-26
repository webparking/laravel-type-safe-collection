<?php

namespace Webparking\TypeSafeCollection\Eloquent;

use Illuminate\Database\Eloquent\Collection;
use Webmozart\Assert\Assert;

abstract class TypeSafeCollection extends Collection
{
    protected $type;

    public function __construct($items = [])
    {
        parent::__construct($items);
        Assert::allIsInstanceOf($this->items, $this->type);
    }

    /**
     * Push an item onto the beginning of the collection.
     *
     * @param  mixed $value
     * @param  mixed $key
     * @return $this
     */
    public function prepend($value, $key = null)
    {
        Assert::isInstanceOf($value, $this->type);

        parent::prepend($value, $key);

        return $this;
    }

    /**
     * Chunk the underlying collection array.
     *
     * @param  int        $size
     * @return Collection
     */
    public function chunk($size)
    {
        if ($size <= 0) {
            return new Collection();
        }

        $chunks = [];

        foreach (array_chunk($this->items, $size, true) as $chunk) {
            $chunks[] = new static($chunk);
        }

        return new Collection($chunks);
    }

    /**
     * Dump the collection.
     *
     * @return $this
     */
    public function dump()
    {
        $this->toBase()->dump();

        return $this;
    }

    /**
     * Run a map over each of the items.
     *
     * @param  callable                       $callback
     * @return \Illuminate\Support\Collection
     */
    public function map(callable $callback)
    {
        return $this->toBase()->map($callback);
    }

    /**
     * Run a dictionary map over the items.
     *
     * The callback should return an associative array with a single key/value pair.
     *
     * @param  callable                       $callback
     * @return \Illuminate\Support\Collection
     */
    public function mapToDictionary(callable $callback)
    {
        return $this->toBase()->mapToDictionary($callback);
    }

    /**
     * Run a grouping map over the items.
     *
     * The callback should return an associative array with a single key/value pair.
     *
     * @param  callable                       $callback
     * @return \Illuminate\Support\Collection
     */
    public function mapToGroups(callable $callback)
    {
        return $this->toBase()->mapToGroups($callback);
    }

    /**
     * Run an associative map over each of the items.
     *
     * The callback should return an associative array with a single key/value pair.
     *
     * @param  callable                       $callback
     * @return \Illuminate\Support\Collection
     */
    public function mapWithKeys(callable $callback)
    {
        return $this->toBase()->mapWithKeys($callback);
    }

    /**
     * Group an associative array by a field or using a callback.
     *
     * @param  callable|string                $groupBy
     * @param  bool                           $preserveKeys
     * @return \Illuminate\Support\Collection
     */
    public function groupBy($groupBy, $preserveKeys = false)
    {
        return $this->toBase()->groupBy($groupBy, $preserveKeys);
    }

    /**
     * Get the keys of the collection items.
     *
     * @return \Illuminate\Support\Collection
     */
    public function keys()
    {
        return $this->toBase()->keys();
    }

    /**
     * Set the item at a given offset.
     *
     * @param mixed $key
     * @param mixed $value
     */
    public function offsetSet($key, $value): void
    {
        Assert::isInstanceOf($value, $this->type);

        parent::offsetSet($key, $value);
    }
}
