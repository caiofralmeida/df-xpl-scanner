<?php

namespace CaioFRAlmeida\DfXplScanner\Finder\Parser;

use CaioFRAlmeida\DfXplScanner\Finder\FinderException;

class NoSuchElementsException extends FinderException
{
    /**
     * @var string
     */
    protected $message = 'Elements not found.';
}
