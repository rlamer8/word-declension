<?php

namespace Src\Output;

use Src\Entity\Rule;

class ConsoleShow implements Showed
{
    private const OUTPUT_FORMAT = '
        Именительный падеж - %s
        Родительный падеж - %s
        Дательный падеж - %s
        Винительный падеж - %s
        Творительный падеж - %s
        Предложный падеж - %s
    ';

    public function show(Rule $rule, string $word, string $wordWithoutEnding)
    {
        printf(
            self::OUTPUT_FORMAT,
            $word,
            $rule->getWordEndingRodPad() ? $wordWithoutEnding . $rule->getWordEndingRodPad() : $word,
            $rule->getWordEndingDatPad() ? $wordWithoutEnding . $rule->getWordEndingDatPad() : $word,
            $rule->getWordEndingVinPad() ? $wordWithoutEnding . $rule->getWordEndingVinPad() : $word,
            $rule->getWordEndingTvPad() ? $wordWithoutEnding . $rule->getWordEndingTvPad() : $word,
            $rule->getWordEndingPredlPad() ? $wordWithoutEnding . $rule->getWordEndingPredlPad() : $word
        );
    }
}