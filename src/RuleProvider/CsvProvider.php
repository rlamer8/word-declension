<?php

namespace Src\RuleProvider;

use Src\Declension;
use Src\Entity\Rule;

class CsvProvider implements RulesProvided
{
    private const RULES_FILE_PATH = __DIR__ . '/../../declension_rules/rules.csv';

    private const CONSONANTS_SYMBOL = 'С';
    private const VOWEL_SYMBOL = 'Г';

    private const BASE_REGEXP = '/([А-я]+(%s))(%s)$/u';

    /**
     * @inheritDoc
     */
    public function getRules(): array
    {
        try {
            $rulesRows = $this->getRulesRowsFromFile();
        } catch (\Throwable $e) {
            throw new \Exception('Error parse rules file', 0, $e);
        }

        $rules = [];

        foreach ($rulesRows as $row) {
            $rule = new Rule();
            $rule->setPriority(trim($row['№ (приоритет)']));
            $rule->setIsForMasculineGender(trim($row['Муж']) === '+');
            $rule->setIsForFeminineGender(trim($row['Жен']) === '+');
            $rule->setIsForSurname(trim($row['Фам.']) === '+');
            $rule->setIsForName(trim($row['Имя.']) === '+');

            $stringLetterBeforeEnding = str_replace(['-', ' '], '', $row['Буква предш.оконч.']);
            $rule->setLetterBeforeEnding($stringLetterBeforeEnding);
            $stringException = str_replace(['-', ' '], '', $row['Исключения']);
            $rule->setExceptionToTheRule(explode(',', $stringException));

            $rule->setWordEndingImPad(trim($row['Окончание в Им.П.'], '- '));
            $rule->setWordEndingRodPad(trim($row['Родит.'], '- '));
            $rule->setWordEndingDatPad(trim($row['Дательн.'], '- '));
            $rule->setWordEndingVinPad(trim($row['Винит.'], '- '));
            $rule->setWordEndingTvPad(trim($row['Творит.'], '- '));
            $rule->setWordEndingPredlPad(trim($row['Предложн.'], '- '));

            $regExp = $this->getRegexpFromEnding($rule->getWordEndingImPad(), $rule->getLetterBeforeEnding());
            $rule->setRegExpEnding($regExp);

            $rules[$rule->getPriority()] = $rule;
        }
        ksort($rules);

        return $rules;
    }

    /**
     * @return array
     */
    private function getRulesRowsFromFile(): array
    {
        $handle = fopen(self::RULES_FILE_PATH, 'rb');
        $header = fgetcsv($handle, 1000, ';');
        $rules = [];
        while ($row = fgetcsv($handle, 1000, ';')) {
            if ($row[0] === '') {
                break; //останавливаемся на пустой строке
            }
            $rules[] = array_combine($header, $row);
        }

        return $rules;
    }

    /**
     * Получение регулярного выражения для сопоставления правила со словом
     * @param string $ending
     * @param string|null $letterBeforeEnding
     * @return string
     */
    private function getRegexpFromEnding(string $ending, string $letterBeforeEnding = null): string
    {
        $ending = str_replace(['-', ' '], '', $ending);
        $endingLettersArray = explode(',', $ending);
        $endingLettersArray = array_merge($endingLettersArray, $this->getLettersFromSymbols($ending));

        $regexpLetterBeforeEnding = '';
        if (!empty($letterBeforeEnding)) {
            $letterBeforeEndingArray = explode(',', $letterBeforeEnding);
            $letterBeforeEndingArray = array_merge($letterBeforeEndingArray, $this->getLettersFromSymbols($letterBeforeEnding));
            $regexpLetterBeforeEnding = implode('|', $letterBeforeEndingArray);
        }

        return sprintf(self::BASE_REGEXP, $regexpLetterBeforeEnding, implode('|', $endingLettersArray));
    }

    /**
     * Преобразуем условные обозначения в буквы
     * @param string $word
     * @return array
     */
    private function getLettersFromSymbols(string $word): array
    {
        $letters = [];
        if (stripos($word, self::CONSONANTS_SYMBOL) !== false) {
            $letters = Declension::CONSONANT_LETTERS;
        }
        if (stripos($word, self::VOWEL_SYMBOL) !== false) {
            $letters = array_merge($letters, Declension::VOWEL_LETTERS);
        }

        return $letters;
    }
}