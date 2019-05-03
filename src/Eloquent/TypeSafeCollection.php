<?php

namespace Webparking\TypeSafeCollection\Eloquent;

use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Webmozart\Assert\Assert;
use Webparking\TypeSafeCollection\Exceptions\InvalidOperationException;

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
     * Flip the items in the collection.
     *
     * @throws InvalidOperationException
     */
    public function flip()
    {
        throw new InvalidOperationException('Flip() can never work on a TypeSafeCollection');
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
        $base = $this->toBase();

        if (method_exists($base, 'mapToDictionary')) {
            return $base->mapToDictionary($callback);
        }

        throw new InvalidOperationException('This method is not implemented in the Collection you\'re using');
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
     * Map the values into a new class.
     *
     * @param  string     $class
     * @return Collection
     */
    public function mapInto($class)
    {
        return $this->toBase()->mapInto($class);
    }

    /**
     * Create a collection by using this collection for keys and another for its values.
     *
     * @param  mixed                     $values
     * @throws InvalidOperationException
     */
    public function combine($values)
    {
        throw new InvalidOperationException('Flip() can never work on a TypeSafeCollection');
    }

    /**
     * Partition the collection into two arrays using the given callback or key.
     *
     * @param  callable|string $key
     * @param  mixed           $operator
     * @param  mixed           $value
     * @return Collection
     */
    public function partition($key, $operator = null, $value = null)
    {
        $partitions = [new static(), new static()];

        $callback = \func_num_args() === 1
            ? $this->valueRetriever($key)
            : $this->operatorForWhere(...\func_get_args());

        foreach ($this->items as $key => $item) {
            $partitions[(int) !$callback($item, $key)][$key] = $item;
        }

        return new Collection($partitions);
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

    /**
     * Zip the collection together with one or more arrays.
     *
     * e.g. new Collection([1, 2, 3])->zip([4, 5, 6]);
     *      => [[1, 4], [2, 5], [3, 6]]
     *
     * @param  mixed      ...$items
     * @return Collection
     */
    public function zip($items)
    {
        $arrayableItems = array_map(function ($items) {
            return $this->getArrayableItems($items);
        }, \func_get_args());

        $params = array_merge([function () {
            return new static(\func_get_args());
        }, $this->items], $arrayableItems);

        return new Collection(\call_user_func_array('array_map', $params));
    }

    /**
     * Count the number of items in the collection using a given truth test.
     *
     * @param  callable|null $callback
     * @return Collection
     */
    public function countBy($callback = null)
    {
        $base = $this->toBase();

        if (method_exists($base, 'countBy')) {
            return $base->countBy($callback);
        }

        throw new InvalidOperationException('This method is not implemented in the Collection you\'re using');
    }

    /**
     * Add an item to the collection.
     *
     * @param  mixed $item
     * @return $this
     */
    public function add($item)
    {
        Assert::isInstanceOf($item, $this->type);

        $this->items[] = $item;

        return $this;
    }
}
