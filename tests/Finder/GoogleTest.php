<?php

namespace CaioFRAlmeida\DfXplScanner\Test\Unit\Finder;

use CaioFRAlmeida\DfXplScanner\Finder\Google;
use CaioFRAlmeida\DfXplScanner\Finder\Parser\GoogleHtmlPage;

class GoogleHtmlPageTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function shouldReturnOneElement()
    {
        $responseMock = $this->getMock('Psr\Http\Message\ResponseInterface');
        $responseMock->expects($this->once())
            ->method('getBody')
            ->willReturn('<h3><a href="#">xpto</a></h3>');

        $clientMock = $this->getMock('GuzzleHttp\ClientInterface');
        $clientMock->expects($this->once())
            ->method('request')
            ->willReturn($responseMock);

        $parser = new GoogleHtmlPage(new \DOMDocument());

        $finderProvider = new Google($clientMock, $parser);

        $result = $finderProvider->find('xpto');
        $this->assertCount(1, $result);
    }

    /**
     * @test
     * @expectedException CaioFRAlmeida\DfXplScanner\Finder\Parser\NoSuchElementsException
     */
    public function shouldThrowsNoSuchElementsException()
    {
        $responseMock = $this->getMock('Psr\Http\Message\ResponseInterface');
        $responseMock->expects($this->once())
            ->method('getBody')
            ->willReturn('<div>No content found</div>');

        $clientMock = $this->getMock('GuzzleHttp\ClientInterface');
        $clientMock->expects($this->once())
            ->method('request')
            ->willReturn($responseMock);

        $parser = new GoogleHtmlPage(new \DOMDocument());

        $finderProvider = new Google($clientMock, $parser);

        $result = $finderProvider->find('nosuch');
    }
}
