<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Src\Declension;
use Src\Output\ConsoleShow;
use Src\RuleProvider\CsvProvider;

$cl = new Declension(new CsvProvider(), new ConsoleShow());
$cl->showDeclinedWord('Андрей', Declension::MASCULINE_GENDER, Declension::NAME);
$cl->showDeclinedWord('Егор', Declension::MASCULINE_GENDER, Declension::NAME);
$cl->showDeclinedWord('Петров', Declension::MASCULINE_GENDER, Declension::SURNAME);
$cl->showDeclinedWord('Татьяна', Declension::FEMININE_GENDER, Declension::NAME);
$cl->showDeclinedWord('Ларина', Declension::FEMININE_GENDER, Declension::SURNAME);
$cl->showDeclinedWord('Сергей', Declension::MASCULINE_GENDER, Declension::NAME);
$cl->showDeclinedWord('Кривой', Declension::MASCULINE_GENDER, Declension::SURNAME);