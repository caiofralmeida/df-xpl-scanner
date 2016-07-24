<?php

namespace CaioFRAlmeida\DfXplScanner\Finder;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use CaioFRAlmeida\DfXplScanner\UserAgent\UserAgentGenerator;

class Google extends Provider
{
    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * @param  ClientInterface $client
     */
    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @param  string $term [ex: "download.php?file="]
     * @return SearchResult
     * @throws NoSuchElementsException
     * @throws GuzzleException
     */
    public function find($term)
    {
        try {
            $url = sprintf(getenv('GOOGLE_URLSEARCH'), urlencode($term));
            $result = $this->client->request('GET', $url, [
                'headers' => [
                    'User-Agent' => UserAgentGenerator::getRandom()
                ]
            ]);

            $parser = new Parser\GoogleHtmlPage(new \DOMDocument());
            $elements = $parser->parse($result->getBody());

            $result = new SearchResult();

            foreach($elements as $element) {
                $item = (new Item())
                    ->setNome($element->nodeValue)
                    ->setUrl(
                        $this->formatUrl(
                            $element->getAttribute('href')
                        )
                    );
                $result[] = $item;
            }

            return $result;

        } catch (NoSuchElementsException $e) {

        } catch (GuzzleException $e) {
            echo $e->getResponse()->getBody();die;
            echo ($e->getMessage());die;
        }
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
