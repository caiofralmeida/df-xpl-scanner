<?php

namespace CaioFRAlmeida\DfXplScanner\Finder;

class SearchResult extends \ArrayIterator
{
    /**
     * @param  array $itens
     */
    public function __construct(array $itens = [])
    {
        foreach($itens as $key => $value) {
            $this->offsetSet($key, $value);
        }
    }

    /**
     * @param string $key
     * @param Item $value
     */
    public function offsetSet($key, $value)
    {
        if (!$value instanceof Item) {
            throw new \InvalidArgumentException(
                'should be instance of CaioFRAlmeida\DfxplScanner\Finder\Item'
            );
        }

        parent::offsetSet($key, $value);
    }
}
