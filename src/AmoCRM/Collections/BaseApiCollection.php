<?php

namespace AmoCRM\Collections;

use AmoCRM\Models\BaseApiModel;
use ArrayAccess;
use ArrayIterator;
use Illuminate\Support\Str;
use InvalidArgumentException;
use IteratorAggregate;
use JsonSerializable;

use function array_column;
use function array_combine;
use function array_keys;
use function count;

/**
 * Class BaseApiCollection
 *
 * @package AmoCRM\Collections
 */
abstract class BaseApiCollection implements ArrayAccess, JsonSerializable, IteratorAggregate
{
    /**
     * Класс модели
     * @var string
     */
    const ITEM_CLASS = '';

    /**
     * @param mixed $item
     * @return BaseApiModel
     */
    protected function checkItem($item)
    {
        $class = static::ITEM_CLASS;
        if (!is_object($item) || !($item instanceof $class)) {
            throw new InvalidArgumentException('Item must be an instance of ' . $class);
        }

        return $item;
    }

    /**
     * @param array $array
     * @return $this
     */
    public static function fromArray(array $array)
    {
        $itemClass = static::ITEM_CLASS;

        return self::make(
            array_map(
                function (array $item) use ($itemClass) {
                    /** @var BaseApiModel $itemObj */
                    $itemObj = new $itemClass();
                    return $itemObj->fromArray($item);
                },
                $array
            )
        );
    }

    /**
     * @param array $items
     * @return static
     */
    public static function make(array $items)
    {
        $collection = new static();
        foreach ($items as $item) {
            $collection->add($item);
        }

        return $collection;
    }

    /**
     * Хранилище элементов коллекции
     * @var array
     */
    protected $data = [];

    /**
     * @param BaseApiModel $value
     * @return $this
     */
    public function add(BaseApiModel $value)
    {
        $this->data[] = $this->checkItem($value);

        return $this;
    }

    /**
     * @param BaseApiModel $value
     *
     * @return $this
     */
    public function prepend(BaseApiModel $value)
    {
        array_unshift($this->data, $this->checkItem($value));

        return $this;
    }

    /**
     * @param string|int $offset
     * @param BaseApiModel $value
     * @return $this
     */
    public function offsetSet($offset, $value)
    {
        $this->data[$offset] = $this->checkItem($value);

        return $this;
    }

    /**
     * @param string|int $offset
     * @return BaseApiModel|null
     */
    public function offsetGet($offset)
    {
        return isset($this->data[$offset]) ? $this->data[$offset] : null;
    }

    /**
     * Get all data
     * @return array
     */
    public function all()
    {
        return $this->data;
    }

    /**
     * Получение первого значения
     * @return BaseApiModel|null
     */
    public function first()
    {
        $first = reset($this->data);
        if (!$first) {
            $first = null;
        }
        return $first;
    }

    /**
     * Получение последнего значения
     * @return BaseApiModel|null
     */
    public function last()
    {
        $last = end($this->data);
        if (!$last) {
            $last = null;
        }
        return $last;
    }

    /**
     * Очистка коллекции
     * @return $this
     */
    public function clear()
    {
        foreach ($this->keys() as $key) {
            $this->offsetUnset($key);
        }

        return $this;
    }

    /**
     * Удаление элемента из коллекции.
     *
     * @param string|int $offset
     *
     * @return $this
     */
    public function offsetUnset($offset)
    {
        unset($this->data[$offset]);

        return $this;
    }

    /**
     * @param string|int $offset
     * @return bool
     */
    public function offsetExists($offset)
    {
        return array_key_exists($offset, $this->data);
    }

    /**
     * @return int
     */
    public function count()
    {
        return count($this->data);
    }

    /**
     * @return array
     */
    public function keys()
    {
        return array_keys($this->data);
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $result = [];
        /** @var BaseApiModel $item */
        foreach ($this->data as $key => $item) {
            $result[$key] = $item->toArray();
        }

        return $result;
    }

    /**
     * @return null|array
     */
    public function toApi()
    {
        $result = [];
        /** @var BaseApiModel $item */
        foreach ($this->data as $key => $item) {
            $result[$key] = $item->toApi($key);
        }

        return $result;
    }

    /**
     * Convert the object into something JSON serializable.
     *
     * @return array
     */
    public function jsonSerialize()
    {
        return $this->toArray();
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string)json_encode($this->toArray());
    }

    /**
     * @return BaseApiModel|null
     */
    public function current()
    {
        return current($this->data);
    }

    /**
     * @return void
     */
    public function next()
    {
        next($this->data);
    }

    /**
     * @return string|int
     */
    public function key()
    {
        return key($this->data);
    }

    /**
     * @return bool
     */
    public function valid()
    {
        return key($this->data) !== null;
    }

    /**
     * @return void
     */
    public function rewind()
    {
        reset($this->data);
    }

    /**
     * Проверяет коллекцию на пустоту
     * @return bool
     */
    public function isEmpty()
    {
        return empty($this->data);
    }

    /**
     * Получение итератора
     *
     * @return ArrayIterator
     */
    public function getIterator()
    {
        return new ArrayIterator($this->data);
    }

    /**
     * Поиск объекта в коллекции по параметру объекта
     * @param string $key
     * @param mixed $value
     * @return BaseApiModel|null
     */
    public function getBy($key, $value)
    {
        $result = null;

        $key = Str::ucfirst(Str::camel($key));
        $getter = (method_exists(static::ITEM_CLASS, 'get' . $key) ? 'get' . $key : null);

        if ($getter) {
            foreach ($this->data as $object) {
                $fieldValue = $object->$getter();

                if ($fieldValue === $value) {
                    $result = $object;
                    break;
                }
            }
        }

        return $result;
    }

    /**
     * Замена объекта в коллекции по параметру объекта
     *
     * @param string $key
     * @param mixed $value
     * @param BaseApiModel $replacement
     *
     * @return void
     */
    public function replaceBy($key, $value, BaseApiModel $replacement)
    {
        $key = Str::ucfirst(Str::camel($key));
        $getter = (method_exists(static::ITEM_CLASS, 'get' . $key) ? 'get' . $key : null);

        if ($getter) {
            foreach ($this->data as &$object) {
                $fieldValue = $object->$getter();

                if ($fieldValue === $value) {
                    $object = $replacement;
                    break;
                }
            }
            unset($object);
        }
    }

    /**
     * Разделение коллекции на массив состоящий из коллекций определенной длинны
     *
     * @param int $size
     * @return BaseApiCollection[]
     */
    public function chunk($size)
    {
        if ($this->count() < $size) {
            return [$this];
        }
        $result = [new static()];
        foreach ($this->data as $item) {
            if ((end($result)->count()) >= $size) {
                $result[] = new static();
            }
            end($result)->add($item);
        }
        return $result;
    }

    /**
     * Удаление объектов из коллекции по параметру объекта
     *
     * @param string $key
     * @param mixed $value
     *
     * @return int count
     */
    public function removeBy($key, $value)
    {
        $key = Str::ucfirst(Str::camel($key));
        $getter = (method_exists(static::ITEM_CLASS, 'get' . $key) ? 'get' . $key : null);

        $count = 0;
        if ($getter) {
            foreach ($this->data as &$object) {
                $fieldValue = $object->$getter();

                if ($fieldValue === $value) {
                    unset($object);
                    $count++;
                }
            }
        }
        return $count;
    }

    /**
     * Удаление первого объекта из коллекции по параметру объекта
     *
     * @param string $key
     * @param mixed $value
     *
     * @return bool
     */
    public function removeFirstBy($key, $value)
    {
        $key = Str::ucfirst(Str::camel($key));
        $getter = (method_exists(static::ITEM_CLASS, 'get' . $key) ? 'get' . $key : null);

        if ($getter) {
            foreach ($this->data as &$object) {
                $fieldValue = $object->$getter();

                if ($fieldValue === $value) {
                    unset($object);
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * @param string $column
     *
     * @return array
     */
    public function pluck($column)
    {
        $data = $this->toArray();
        $values = array_column($data, $column);
        if (count($values) !== count($data)) {
            throw new InvalidArgumentException("Some elements missing keys \"{$column}\"");
        }

        return array_combine(array_keys($data), $values);
    }
}
