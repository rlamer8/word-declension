<?php

namespace Src\Entity;

class Rule
{
    /* @var int */
    private $priority;

    /* @var bool */
    private $isForMasculineGender;
    /* @var bool */
    private $isForFeminineGender;
    /* @var bool */
    private $isForName;
    /* @var bool */
    private $isForSurname;

    /* @var string */
    private $letterBeforeEnding;
    /* @var array */
    private $exceptionToTheRule;

    /* @var bool */
    private $isNeedToDecline;
    /* @var string */
    private $wordEndingImPad;
    /* @var string */
    private $wordEndingRodPad;
    /* @var string */
    private $wordEndingDatPad;
    /* @var string */
    private $wordEndingVinPad;
    /* @var string */
    private $wordEndingTvPad;
    /* @var string */
    private $wordEndingPredlPad;

    /* @var string */
    private $regExpEnding;

    /**
     * @return int
     */
    public function getPriority(): int
    {
        return $this->priority;
    }

    /**
     * @param int $priority
     */
    public function setPriority(int $priority): void
    {
        $this->priority = $priority;
    }

    /**
     * @return bool
     */
    public function isForMasculineGender(): bool
    {
        return $this->isForMasculineGender;
    }

    /**
     * @param bool $isForMasculineGender
     */
    public function setIsForMasculineGender(bool $isForMasculineGender): void
    {
        $this->isForMasculineGender = $isForMasculineGender;
    }

    /**
     * @return bool
     */
    public function isForFeminineGender(): bool
    {
        return $this->isForFeminineGender;
    }

    /**
     * @param bool $isForFeminineGender
     */
    public function setIsForFeminineGender(bool $isForFeminineGender): void
    {
        $this->isForFeminineGender = $isForFeminineGender;
    }

    /**
     * @return bool
     */
    public function isForName(): bool
    {
        return $this->isForName;
    }

    /**
     * @param bool $isForName
     */
    public function setIsForName(bool $isForName): void
    {
        $this->isForName = $isForName;
    }

    /**
     * @return bool
     */
    public function isForSurname(): bool
    {
        return $this->isForSurname;
    }

    /**
     * @param bool $isForSurname
     */
    public function setIsForSurname(bool $isForSurname): void
    {
        $this->isForSurname = $isForSurname;
    }

    /**
     * @return string
     */
    public function getLetterBeforeEnding(): string
    {
        return $this->letterBeforeEnding;
    }

    /**
     * @param string $letterBeforeEnding
     */
    public function setLetterBeforeEnding(string $letterBeforeEnding): void
    {
        $this->letterBeforeEnding = $letterBeforeEnding;
    }

    /**
     * @return array
     */
    public function getExceptionToTheRule(): array
    {
        return $this->exceptionToTheRule;
    }

    /**
     * @param array $exceptionToTheRule
     */
    public function setExceptionToTheRule(array $exceptionToTheRule): void
    {
        $this->exceptionToTheRule = $exceptionToTheRule;
    }

    /**
     * @return string
     */
    public function getWordEndingImPad(): string
    {
        return $this->wordEndingImPad;
    }

    /**
     * @param string $wordEndingImPad
     */
    public function setWordEndingImPad(string $wordEndingImPad): void
    {
        $this->wordEndingImPad = $wordEndingImPad;
    }

    /**
     * @return string
     */
    public function getWordEndingRodPad(): string
    {
        return $this->wordEndingRodPad;
    }

    /**
     * @param string $wordEndingRodPad
     */
    public function setWordEndingRodPad(string $wordEndingRodPad): void
    {
        $this->wordEndingRodPad = $wordEndingRodPad;
    }

    /**
     * @return string
     */
    public function getWordEndingDatPad(): string
    {
        return $this->wordEndingDatPad;
    }

    /**
     * @param string $wordEndingDatPad
     */
    public function setWordEndingDatPad(string $wordEndingDatPad): void
    {
        $this->wordEndingDatPad = $wordEndingDatPad;
    }

    /**
     * @return string
     */
    public function getWordEndingVinPad(): string
    {
        return $this->wordEndingVinPad;
    }

    /**
     * @param string $wordEndingVinPad
     */
    public function setWordEndingVinPad(string $wordEndingVinPad): void
    {
        $this->wordEndingVinPad = $wordEndingVinPad;
    }

    /**
     * @return string
     */
    public function getWordEndingTvPad(): string
    {
        return $this->wordEndingTvPad;
    }

    /**
     * @param string $wordEndingTvPad
     */
    public function setWordEndingTvPad(string $wordEndingTvPad): void
    {
        $this->wordEndingTvPad = $wordEndingTvPad;
    }

    /**
     * @return string
     */
    public function getWordEndingPredlPad(): string
    {
        return $this->wordEndingPredlPad;
    }

    /**
     * @param string $wordEndingPredlPad
     */
    public function setWordEndingPredlPad(string $wordEndingPredlPad): void
    {
        $this->wordEndingPredlPad = $wordEndingPredlPad;
    }

    /**
     * @return string
     */
    public function getRegExpEnding(): string
    {
        return $this->regExpEnding;
    }

    /**
     * @param string $regExpEnding
     */
    public function setRegExpEnding(string $regExpEnding): void
    {
        $this->regExpEnding = $regExpEnding;
    }

    /**
     * @return bool
     */
    public function isNeedToDecline(): bool
    {
        return $this->isNeedToDecline;
    }

    /**
     * @param bool $isNeedToDecline
     */
    public function setIsNeedToDecline(bool $isNeedToDecline): void
    {
        $this->isNeedToDecline = $isNeedToDecline;
    }

}