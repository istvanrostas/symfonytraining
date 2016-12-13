<?php

namespace Blog\CoreBundle\Services;

use Knp\Bundle\MarkdownBundle\MarkdownParserInterface;

class MarkdownTransformer{


    private $markdownParser;

    public function __construct(MarkdownParserInterface $markdownParser)
    {
        $this->markdownParser = $markdownParser;
    }

    public function parser($str)
    {
        return $this->markdownParser
            ->transformMarkdown($str);
    }
}