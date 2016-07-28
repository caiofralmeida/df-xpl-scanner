<?php

namespace CaioFRAlmeida\DfXplScanner\Test\Unit\Finder\Parser;

use CaioFRAlmeida\DfXplScanner\Finder\Parser\GoogleHtmlPage;

class GoogleHtmlPageTest extends \PHPUnit_Framework_TestCase
{
    private $parser;

    public function setUp()
    {
        $this->parser = new GoogleHtmlPage(new \DOMDocument());
    }

    /**
     * @test
     * @expectedException CaioFRAlmeida\DfXplScanner\Finder\Parser\NoSuchElementsException
     */
    public function shouldThrowExceptionWhenNotHaveElementsToParse()
    {
        $this->parser->parse('');
    }

    /**
     * @test
     */
    public function shouldReturnParsedElements()
    {
        $content = "
            <h3 class='r'>
            <span class='_ogd b w xsm'>[PDF]</span>
            <a href='http://www.foca.com.br/download.php?file=userfiles/catalogo_produtos/1217_1387303218.pdf'
                onmousedown=\"return rwt(this,'','','','1',
                'AFQjCNGDehYqHQROjE3l-DuuXpyFNS4cxA',
                'BjJLfPcp2_ioA-Nit_Ihww',
                '0ahUKEwizsa6Pm_TNAhWEKyYKHerkDtcQFgghMAA','','',event)\">
                w w w . f o c a . c o m . b r</a>
            </h3>";

        $elements = $this->parser->parse($content);

        $this->assertEquals(1, $elements->length);
    }
}
