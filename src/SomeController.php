<?php 

namespace Smoench\Contoller;

use Smoench\Service\SomeService;

class SomeController
{
    public function __construct(SomeService $service)
    {
    }
}
