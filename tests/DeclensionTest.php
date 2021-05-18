<?php

use Src\Declension;
use Src\Output\ConsoleShow;
use PHPUnit\Framework\TestCase;
use Src\RuleProvider\RulesProvided;
use Tests\BuildRuleTrait;

class DeclensionTest extends TestCase
{
    use BuildRuleTrait;

    /* @var RulesProvided */
    private $rulesProvider;
    /**
     * @var Declension
     */
    private $declension;

    /**
     * @dataProvider rulesProvider
     * @param array $rules
     * @throws Exception
     */
    public function testShowDeclinedWord(array $rules): void
    {
        $this->rulesProvider->method('getRules')->willReturn($rules);
        $this->expectNotToPerformAssertions();
        $this->declension->showDeclinedWord('Иван', Declension::MASCULINE_GENDER, Declension::NAME);
    }

    /**
     * @dataProvider rulesProvider
     * @param array $rules
     * @throws Exception
     */
    public function testGetMatchedRule(array $rules): void
    {
        $this->rulesProvider->method('getRules')->willReturn($rules);
        $actualRule = $this->declension->getMatchedRule('Сидоров', Declension::MASCULINE_GENDER, Declension::SURNAME);
        $expectedRule = $this->buildRule(
            2, false, true, true, false, 'о', [''], '/([А-я]+(о))(в)$/u'
        );
        self::assertEquals($expectedRule, $actualRule);
    }

    public function testGetMatchedRuleException(): void
    {
        $this->rulesProvider->method('getRules')->willThrowException(new Exception());
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('An error occurred while trying to get rules. Check rule file');
        $this->declension->getMatchedRule('Сидоров', Declension::MASCULINE_GENDER, Declension::SURNAME);
    }

    /**
     * @dataProvider rulesProvider
     * @param array $rules
     * @throws Exception
     */
    public function testGetMatchedRuleNotFoundRuleException(array $rules): void
    {
        $this->rulesProvider->method('getRules')->willReturn($rules);
        $this->expectException(Exception::class);
        $this->expectExceptionMessage("Can't match the word to a rule");
        $this->declension->getMatchedRule('Фамилия', Declension::MASCULINE_GENDER, Declension::SURNAME);
    }

    public function rulesProvider(): array
    {
        $ruleNameIvan = $this->buildRule(
            1, true, false, true, false, '', [''], '/([А-я]+())(н)$/u'
        );
        $ruleNameSidorov = $this->buildRule(
            2, false, true, true, false, 'о', [''], '/([А-я]+(о))(в)$/u'
        );
        return [
            [[$ruleNameIvan, $ruleNameSidorov]],
        ];
    }

    public function setUp(): void
    {
        $this->rulesProvider = $this->createMock(RulesProvided::class);
        $this->declension = new Declension($this->rulesProvider, new ConsoleShow());
    }
}
