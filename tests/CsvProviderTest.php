<?php

namespace Tests;

use PHPUnit\Framework\MockObject\MockObject;
use Src\RuleProvider\CsvProvider;
use PHPUnit\Framework\TestCase;
use Src\RuleProvider\FileLoader;

class CsvProviderTest extends TestCase
{
    use BuildRuleTrait;

    /* @var CsvProvider */
    private $csvProvider;
    /**
     * @var MockObject|FileLoader
     */
    private $fileLoaderMock;

    public function testGetRulesSuccess(): void
    {
        $handle = fopen(__DIR__ . '/RulesFiles/rules_test_success.csv', 'rb');
        $this->fileLoaderMock->method('getFileHandle')->willReturn($handle);
        $expectedRule = $this->buildRule(
            1,
            true,
            false,
            true,
            false,
            'а',
            [''],
            '/([А-я]+(а))(н)$/u',
            'н','а','у','а','ом', 'е');
        $rules = $this->csvProvider->getRules();
        self::assertEquals($expectedRule, $rules[1]);
    }

    public function testGetRulesException(): void
    {
        $handle = fopen(__DIR__ . '/RulesFiles/rules_test_exception.csv', 'rb');
        $this->fileLoaderMock->method('getFileHandle')->willReturn($handle);
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Error parse rules file');
        $this->csvProvider->getRules();
    }

    public function setUp(): void
    {
        $this->fileLoaderMock = $this->createMock(FileLoader::class);
        $this->csvProvider = new CsvProvider($this->fileLoaderMock);

    }
}
