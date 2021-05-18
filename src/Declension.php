<?php

namespace Src;

use Src\Entity\Rule;
use Src\Output\Showed;
use Src\RuleProvider\RulesProvided;

class Declension
{
    public const MASCULINE_GENDER = 'М';
    public const FEMININE_GENDER = 'Ж';

    public const NAME = 'Имя';
    public const SURNAME = 'Фамилия';

    public const CONSONANT_LETTERS = ['б', 'в', 'г', 'д', 'ж', 'з', 'й', 'к', 'л', 'м', 'н', 'п', 'р', 'с', 'т', 'ф', 'х', 'ц', 'ч', 'ш', 'щ'];
    public const VOWEL_LETTERS = ['а', 'е', 'ё', 'и', 'о', 'у', 'ы', 'э', 'ю', 'я'];

    private $ruleProvider;
    private $output;

    public function __construct(RulesProvided $ruleProvider, Showed $output)
    {
        $this->ruleProvider = $ruleProvider;
        $this->output = $output;
    }

    /**
     * @param string $word
     * @param string $gender
     * @param string $nameType
     * @throws \Exception
     */
    public function showDeclinedWord(string $word, string $gender, string $nameType): void
    {
        $rule = $this->getMatchedRule($word, $gender, $nameType);
        preg_match($rule->getRegExpEnding(), $word, $matchedWordParts);
        $wordWithoutEnding = $this->getWorldWithoutEnding($rule, $word);

        $this->output->show($rule, $word, $wordWithoutEnding);
    }

    /**
     * Получаем правило, подходящее под слово
     * @param string $word
     * @param string $gender
     * @param string $nameType
     * @return Rule
     * @throws \Exception
     */
    public function getMatchedRule(string $word, string $gender, string $nameType): Rule
    {
        try {
            $rules = $this->ruleProvider->getRules();
        } catch (\Throwable $e) {
            throw new \Exception('An error occurred while trying to get rules. Check rule file', 0, $e);
        }

        foreach ($rules as $rule) {
            $isMatchGender =
                ($rule->isForMasculineGender() && $gender === self::MASCULINE_GENDER) ||
                ($rule->isForFeminineGender() && $gender === self::FEMININE_GENDER);
            $isMatchNameType =
                ($rule->isForName() && $nameType === self::NAME) ||
                ($rule->isForSurname() && $nameType === self::SURNAME);
            $isMathException = in_array($word, $rule->getExceptionToTheRule(), true);

            preg_match($rule->getRegExpEnding(), strtolower($word), $matchedWordParts);
            if ($isMatchGender && $isMatchNameType && !$isMathException && count($matchedWordParts) > 0) {
                return $rule;
            }
        }

        throw new \Exception("Can't match the word to a rule");
    }

    /**
     * @param Rule $rule
     * @param string $word
     * @return string
     */
    private function getWorldWithoutEnding(Rule $rule, string $word): string
    {
        preg_match($rule->getRegExpEnding(), $word, $matchedWordParts);
        $wordWithoutEnding = $matchedWordParts[1];
        if ($matchedWordParts[3] !== null && $matchedWordParts[3] !== 'й' && in_array($matchedWordParts[3], self::CONSONANT_LETTERS, true)) {
            $wordWithoutEnding = $matchedWordParts[0];
        }

        return $wordWithoutEnding;
    }
}