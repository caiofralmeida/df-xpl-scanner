<?php

namespace CaioFRAlmeida\DfXplScanner\Finder;

abstract class Provider
{
    /**
     * @var int
     */
    protected $total;

    /**
     * @param  string $term
     * @return CaioFRAlmeida\DfXplScanner\Finder\Result
     */
    abstract public function find($term);

    /**
     * @param int $total
     * @return Provider
     */
    public function setTotal($total)
    {
        $this->total = $total;
        return $this;
    }
}
