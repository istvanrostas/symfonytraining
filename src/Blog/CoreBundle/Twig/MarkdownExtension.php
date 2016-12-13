<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2016.12.13.
 * Time: 11:40
 */

namespace Blog\CoreBundle\Twig;



use Blog\CoreBundle\Services\MarkdownTransformer;

class MarkdownExtension extends \Twig_Extension {

    private $markdownTransformer;

    public function __construct(MarkdownTransformer $markdownTransformer)
    {
        $this->markdownTransformer = $markdownTransformer;
    }

    public function getName()
    {
        return 'app_markdown';
    }

    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter('markdownify', [ $this, 'parseMarkdown' ],[
                'is_safe' => ['html'],
            ])
        ];
    }

    public function parseMarkdown($str)
    {
        return $this->markdownTransformer->parser($str);
    }
}