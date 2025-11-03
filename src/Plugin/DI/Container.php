<?php

namespace WPGiosg\Plugin\DI;

class Container implements \ArrayAccess
{
   private array $services = [];
   private array $values = [];

    /**
     * Constructor
     */
   public function __construct()
   {
   }

    /**
     * @param string $name
     * @param mixed $value
     * @return void
     */
   public function registerService(string $name, $value): void
   {
       $this->services[$name] = $value;
   }

    public function offsetExists($offset): bool
    {
        return isset($this->values[$offset]) || isset($this->services[$offset]);
    }

    /**
     * @inheritdoc
     */
    #[\ReturnTypeWillChange]
    public function offsetGet($offset)
    {
        if (isset($this->values[$offset])) {
            if ($this->values[$offset] instanceof \Closure) {
                $this->values[$offset] = $this->values[$offset]($this);
            }
            return $this->values[$offset];
        } elseif (isset($this->services[$offset])) {
            return $this->services[$offset]($this);
        }
    }

    /**
     * @inheritdoc
     */
    #[\ReturnTypeWillChange]
    public function offsetSet($offset, $value)
    {
        $this->values[$offset] = $value;
    }

    /**
     * @inheritdoc
     */
    #[\ReturnTypeWillChange]
    public function offsetUnset($offset)
    {
        if (isset($this->values[$offset])) {
            unset($this->values[$offset]);
        } else {
            unset($this->services[$offset]);
        }
    }
}
