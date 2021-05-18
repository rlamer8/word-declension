<?php

namespace Src\Output;

use Src\Entity\Rule;

interface Showed
{
    public function show(Rule $rule, string $word, string $wordWithoutEnding);
}