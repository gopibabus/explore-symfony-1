<?php
namespace App\Twig;

use App\Service\MarkdownHelper;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class MarkdownExtension extends AbstractExtension
{
    /**
     * @var MarkdownHelper
     */
    private $markdownHelper;

    public function __construct(MarkdownHelper $markdownHelper)
    {
        $this->markdownHelper = $markdownHelper;
    }

    public function getFilters(): array
    {
        return [
            new TwigFilter('parse_markdown', [$this, 'parseMarkdown'], ['is_safe' => ['html']]),
        ];
    }

    public function parseMarkdown($value)
    {
        return $this->markdownHelper->parse($value);
    }
}
