<?php

namespace Tests;

use Src\Entity\Rule;

trait BuildRuleTrait
{
    private function buildRule(
        int $priority,
        bool $isName,
        bool $isForSurname,
        bool $isForMan,
        bool $isForFem,
        string $letterBeforeEnding,
        array $exception,
        string $regExpEnding,
        string $wordEndingImPad = '',
        string $wordEndingRodPad = '',
        string $wordEndingDatPad = '',
        string $wordEndingVinPad = '',
        string $wordEndingTvPad = '',
        string $wordEndingPredlPad = ''): Rule
    {
        $rule = new Rule();
        $rule->setPriority($priority);
        $rule->setIsForName($isName);
        $rule->setIsForSurname($isForSurname);
        $rule->setIsForMasculineGender($isForMan);
        $rule->setIsForFeminineGender($isForFem);
        $rule->setLetterBeforeEnding($letterBeforeEnding);
        $rule->setExceptionToTheRule($exception);
        $rule->setWordEndingImPad($wordEndingImPad);
        $rule->setWordEndingRodPad($wordEndingRodPad);
        $rule->setWordEndingDatPad($wordEndingDatPad);
        $rule->setWordEndingVinPad($wordEndingVinPad);
        $rule->setWordEndingTvPad($wordEndingTvPad);
        $rule->setWordEndingPredlPad($wordEndingPredlPad);
        $rule->setRegExpEnding($regExpEnding);

        return $rule;
    }
}