<?php

namespace Src\RuleProvider;

class FileLoader
{
    protected const RULES_FILE_PATH = __DIR__ . '/../../declension_rules/rules.csv';

    /**
     * @return resource
     */
    public function getFileHandle()
    {
        return fopen(self::RULES_FILE_PATH, 'rb');
    }
}