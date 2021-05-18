<?php

namespace Src\RuleProvider;

use Src\Entity\Rule;

interface RulesProvided
{
    /**
     * @return Rule[]
     * @throws \Exception
     */
    public function getRules(): array;
}