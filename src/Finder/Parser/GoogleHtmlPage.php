<?php

namespace CaioFRAlmeida\DfXplScanner\Finder\Parser;

use DOMDocument;

class GoogleHtmlPage
{
    /**
     * @var DOMDocument
     */
    private $parser;

    public function __construct(DOMDocument $parser)
    {
        $this->parser = $parser;
    }

    /**
     * @param  string $content of page.
     * @return DOMNodeList
     * @throws NoSuchElementsException
     */
    public function parse($content)
    {
        @$this->parser->loadHTML($content);
        $xpath = new \DOMXpath($this->parser);
        
        $elements = $xpath->query(getenv('GOOGLE_PARSE_QUERY'));

        if ($elements->length == 0) {
            throw new NoSuchElementsException();
        }

        return $elements;
    }
}
