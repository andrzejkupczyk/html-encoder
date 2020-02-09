# HTML Encoder

![PHP requirement](https://img.shields.io/badge/PHP-^7.2-blue.svg?logo=php&style=for-the-badge)

[Encoder](https://symfony.com/doc/current/components/serializer.html#encoders) that transforms arrays into HTML and vice versa.  
Requires the [DomCrawler](https://symfony.com/doc/current/components/dom_crawler.html) component.

## Installation

Using Composer:

```
composer require andrzejkupczyk/html-encoder
```

## Example usage

```php
<?php

use Symfony\Component\Serializer;
use WebGarden\Component\Serializer\Encoder\HtmlEncoder;

$encoders = [new HtmlEncoder()];
$serializer = new Serializer([], $encoders);
```
