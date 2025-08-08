<?php

declare(strict_types=1);

namespace Karvaka\AdfToGfm\Nodes;

use Karvaka\AdfToGfm\BlockNode;
use Karvaka\AdfToGfm\HasDepth;

/**
 * @link https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/orderedList/
 */
class OrderedList extends BlockNode
{
    use HasDepth;

    private int $order = 1;

    public function setOrder(int $order): static
    {
        $this->order = $order;

        return $this;
    }

    public function toMarkdown(): string
    {
        return implode(
            self::BREAK,
            array_map(
                fn (ListItem $node, int $order) =>
                    str_repeat(self::INDENT, ($this->depth - 1)) .
                    sprintf('%s. %s', $order, $node->setDepth($this->depth)->toMarkdown()),
                $this->content(),
                range($this->order, $this->order + count($this->content()) - 1)
            )
        );
    }

    public function contains(): array
    {
        return [
            ListItem::class,
        ];
    }
}
