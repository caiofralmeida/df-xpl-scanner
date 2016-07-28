<?php

namespace CaioFRAlmeida\DfXplScanner\Finder;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use CaioFRAlmeida\DfXplScanner\UserAgent\UserAgentGenerator;
use CaioFRAlmeida\DfXplScanner\Finder\Parser\GoogleHtmlPage;

class Google extends Provider
{
    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * @var GoogleHtmlPage
     */
    private $parser;

    /**
     * @param  ClientInterface $client
     */
    public function __construct(ClientInterface $client, GoogleHtmlPage $parser)
    {
        $this->client = $client;
        $this->parser = $parser;
    }

    /**
     * @param  string $term [ex: "download.php?file="]
     * @return SearchResult
     * @throws NoSuchElementsException
     * @throws GuzzleException
     */
    protected function find($term)
    {
        try {
            $url = sprintf(getenv('GOOGLE_URLSEARCH'), urlencode($term));
            $result = $this->client->request('GET', $url, [
                'headers' => [
                    'User-Agent' => UserAgentGenerator::getRandom()
                ]
            ]);

            $elements = $this->parser->parse($result->getBody());
            $data = [];

            foreach($elements as $element) {
                $data[] = [
                    'nome' => $element->nodeValue,
                    'url'  => $element->getAttribute('href')
                ];
            }

            return $data;

        } catch (NoSuchElementsException $e) {

        } catch (GuzzleException $e) {
            echo $e->getResponse()->getBody();die;
            echo ($e->getMessage());die;
        }
    }

    /**
     * {@inheritance}
     */
    protected function createItem($nome, $url)
    {
        $url = $this->formatUrl($url);
        return parent::createItem($nome, $url);
    }

    /**
     * @param  string $url
     * @return string
     */
    private function formatUrl($url)
    {
        if (!preg_match("/^\/url(.*)/", $url)) {
            return $url;
        }

        $baseUrl = 'http://www.google.com.br';
        $uri = parse_url($baseUrl . $url);

        if (isset($uri['query'])) {
            parse_str($uri['query'], $parameters);
            return $parameters['q'];
        }

        return $url;
    }
}
