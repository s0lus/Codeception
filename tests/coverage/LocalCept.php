<?php
$I = new CoverGuy($scenario);
$I->wantTo('run local code coverage for cest and test');
$I->amInPath('tests/data/sandbox');
$I->executeCommand('run math MathTest --coverage', null, '-d pcov.directory=' . getcwd());
$I->seeInShellOutput('Classes: 100.00%');
$I->seeInShellOutput('Methods: 100.00%');

$I->amGoingTo('run local codecoverage in cest');
$I->executeCommand('run math MathCest --coverage', null, '-d pcov.directory=' . getcwd());
$I->seeInShellOutput('Classes: 100.00%');
$I->seeInShellOutput('Methods: 100.00%');

$I->amGoingTo('run local codecoverage with path and branch coverage');
$I->executeCommand("run -o 'coverage: path_coverage: true' math MathTest --coverage", null);
$I->seeInShellOutput('Paths: 100.00%');
$I->seeInShellOutput('Branches: 100.00%');