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
     * @return SearchResult
     */
    public function getResult($term)
    {
        $elements = $this->find($term);

        $result = new SearchResult();

        foreach($elements as $element) {
            $item = $this->createItem($element['nome'], $element['url']);
            $result[] = $item;
        }

        return $result;
    }

    /**
     * @param  string $term
     * @return CaioFRAlmeida\DfXplScanner\Finder\Result
     */
    abstract protected function find($term);

    /**
     * @param  string $nome
     * @param  string $url
     * @return Item
     */
    protected function createItem($nome, $url)
    {
        return new Item($nome, $url);
    }

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
