<?php

declare(strict_types=1);

namespace Karvaka\AdfToGfm\Hydrators;

use Karvaka\AdfToGfm\HydratorInterface;
use Karvaka\AdfToGfm\Node;
use Karvaka\AdfToGfm\Nodes\InlineCard;

class InlineCardHydrator implements HydratorInterface
{
    public function hydrate(Node $node, object $schema): Node
    {
        if (! $node instanceof InlineCard) {
            throw new \Exception();
        }

        if (isset($schema->attrs->url)) {
            $node->setUrl((string)$schema->attrs->url);
        }

        return $node;
    }
}
