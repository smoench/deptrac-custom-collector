<?php

declare(strict_types=1);

namespace Smoench\Test;

use LogicException;
use SensioLabs\Deptrac\AstRunner\AstMap;
use SensioLabs\Deptrac\AstRunner\AstMap\AstClassReference;
use SensioLabs\Deptrac\Collector\CollectorInterface;
use SensioLabs\Deptrac\Collector\Registry;

class CustomCollector implements CollectorInterface
{
    public function getType(): string
    {
        return self::class;
    }

    public function satisfy(array $configuration, AstClassReference $astClassReference, AstMap $astMap, Registry $collectorRegistry): bool
    {
        return $astClassReference->getClassLikeName()->match($this->getPattern($configuration));
    }

    /**
     * @param array<string, string> $configuration
     */
    private function getPattern(array $configuration): string
    {
        if(!isset($configuration['regex']))
        {
            throw new LogicException('CustomCollector needs the regex configuration.');
        }
        return '/' . $configuration['regex'] . '/i';
    }
}
