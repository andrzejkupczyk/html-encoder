<?php

namespace WebGarden\Component\Serializer\Encoder;

use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\Serializer\Encoder\DecoderInterface;
use Symfony\Component\Serializer\Encoder\EncoderInterface;
use Symfony\Component\Serializer\Exception\RuntimeException;

/**
 * Encodes HTML data.
 */
class HtmlEncoder implements EncoderInterface, DecoderInterface
{
    public const FORMAT = 'html';

    /**
     * @var \Symfony\Component\DomCrawler\Crawler
     */
    private $crawler;

    /**
     * @var array
     */
    private $defaultContext = ['default' => null, 'charset' => 'UTF-8'];

    public function __construct(?Crawler $crawler = null, array $defaultContext = [])
    {
        if (!class_exists(Crawler::class)) {
            throw new RuntimeException(
                'The HtmlEncoder class requires the "DomCrawler" component. Install "symfony/dom-crawler" to use it.'
            );
        }

        $this->crawler = $crawler ?: new Crawler();
        $this->defaultContext = array_merge($this->defaultContext, $defaultContext);
    }

    public function decode(string $data, string $format, array $context = [])
    {
        $context = array_merge($this->defaultContext, $context);

        $this->crawler->clear();
        $this->crawler->addHtmlContent($data, $context['charset']);

        return $this->crawler;
    }

    public function supportsDecoding(string $format)
    {
        return self::FORMAT === $format;
    }

    public function encode($data, string $format, array $context = [])
    {
        $this->crawler->clear();
        $this->crawler->addNodes($data);

        $context = array_merge($this->defaultContext, $context);

        return $this->crawler->html($context['default']);
    }

    public function supportsEncoding(string $format)
    {
        return self::FORMAT === $format;
    }
}
