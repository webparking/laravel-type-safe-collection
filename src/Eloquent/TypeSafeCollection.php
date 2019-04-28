<?php

namespace Webparking\TypeSafeCollection\Eloquent;

use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Webmozart\Assert\Assert;

abstract class TypeSafeCollection extends EloquentCollection
{
    protected $type;

    public function __construct($items = [])
    {
        parent::__construct($items);
        Assert::allIsInstanceOf($this->items, $this->type);
    }

    /**
     * Create a new collection by invoking the callback a given amount of times.
     *
     * @param  int        $number
     * @param  callable   $callback
     * @return Collection
     */
    public static function times($number, callable $callback = null)
    {
        return new static(Collection::times($number, $callback));
    }

    /**
     * Collapse the collection of items into a single array.
     *
     * @return static
     */
    public function collapse()
    {
        return new static(Arr::collapse($this->items));
    }

    /**
     * Cross join with the given lists, returning all possible permutations.
     *
     * @param  mixed      ...$lists
     * @return Collection
     */
    public function crossJoin(...$lists)
    {
        return new Collection(Arr::crossJoin(
            $this->items, ...array_map([$this, 'getArrayableItems'], $lists)
        ));
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
     * @param  int                $size
     * @return EloquentCollection
     */
    public function chunk($size)
    {
        if ($size <= 0) {
            return new EloquentCollection();
        }

        $chunks = [];

        foreach (array_chunk($this->items, $size, true) as $chunk) {
            $chunks[] = new static($chunk);
        }

        return new EloquentCollection($chunks);
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
     * @param  callable   $callback
     * @return Collection
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
     * @param  callable   $callback
     * @return Collection
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
     * @param  callable   $callback
     * @return Collection
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
     * @param  callable   $callback
     * @return Collection
     */
    public function mapWithKeys(callable $callback)
    {
        return $this->toBase()->mapWithKeys($callback);
    }

    /**
     * Group an associative array by a field or using a callback.
     *
     * @param  callable|string $groupBy
     * @param  bool            $preserveKeys
     * @return Collection
     */
    public function groupBy($groupBy, $preserveKeys = false)
    {
        return $this->toBase()->groupBy($groupBy, $preserveKeys);
    }

    /**
     * Get the keys of the collection items.
     *
     * @return Collection
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
