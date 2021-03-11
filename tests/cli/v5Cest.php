<?php

class v5Cest
{
    public function bootstrapCodecept5(CliGuy $I)
    {
        $I->amInPath('tests/data/sandbox');
        $I->cleanDir('.');
        $I->executeCommand('bootstrap');
        $I->executeCommand('g:suite Api');
        $I->executeCommand('g:cest Api Resource');
        $I->executeCommand('g:test Api Resource');
        $I->executeCommand('g:feature Acceptance UserStory');
        $I->executeCommand('g:helper Api');
        $I->executeCommand('run');
        $I->seeInShellOutput('OK ');

        $I->openFile('codeception.yml');
        $I->seeInThisFile('namespace: Tests');

        $I->openFile('tests/TestSupport/Helper/Api.php');
        $I->seeInThisFile('namespace Tests\\TestSupport\\Helper');
        $I->seeInThisFile('class Api');

        $I->openFile('tests/TestSupport/AcceptanceTester.php');
        $I->seeInThisFile('namespace Tests\\TestSupport');
        $I->seeInThisFile('use _generated\AcceptanceTesterActions');

        $I->openFile('tests/TestSupport/FunctionalTester.php');
        $I->seeInThisFile('namespace Tests\\TestSupport');

        $I->openFile('tests/Api/ResourceCest.php');
        $I->seeInThisFile('namespace Tests\\Api;');
        $I->seeInThisFile('use \Tests\TestSupport\ApiTester;');
        $I->seeInThisFile('public function tryToTest(ApiTester $I)');

        $I->openFile('tests/Api/ResourceTest.php');
        $I->seeInThisFile('namespace Tests\\Api;');
        $I->seeInThisFile('use \Tests\TestSupport\ApiTester;');
        if ((PHP_MAJOR_VERSION == 7) && (PHP_MINOR_VERSION < 4)) {
            $I->seeInThisFile('protected $tester;');
        } else {
            $I->seeInThisFile('protected ApiTester $tester;');
        }
    }

    public function bootstrapCodecept5WithNamespace(CliGuy $I)
    {
        $I->amInPath('tests/data/sandbox');
        $I->cleanDir('.');
        $I->executeCommand('bootstrap --namespace Codecept5');
        $I->executeCommand('g:suite Api');
        $I->executeCommand('g:feature Acceptance UserStory');
        $I->executeCommand('g:cest Api Resource');
        $I->executeCommand('g:test Api Resource');
        $I->executeCommand('g:helper Api');
        $I->executeCommand('run');
        $I->seeInShellOutput('OK ');

        $I->openFile('codeception.yml');
        $I->seeInThisFile('namespace: Codecept5');

        $I->openFile('tests/TestSupport/Helper/Api.php');
        $I->seeInThisFile('namespace Codecept5\\TestSupport\\Helper');
        $I->seeInThisFile('class Api');


        $I->openFile('tests/TestSupport/AcceptanceTester.php');
        $I->seeInThisFile('namespace Codecept5\\TestSupport');
        $I->seeInThisFile('use _generated\AcceptanceTesterActions');

        $I->openFile('tests/TestSupport/FunctionalTester.php');
        $I->seeInThisFile('namespace Codecept5\\TestSupport');

        $I->openFile('tests/Api/ResourceCest.php');
        $I->seeInThisFile('namespace Codecept5\\Api;');
        $I->seeInThisFile('use \Codecept5\TestSupport\ApiTester;');
        $I->seeInThisFile('public function tryToTest(ApiTester $I)');

        $I->openFile('tests/Api/ResourceTest.php');
        $I->seeInThisFile('namespace Codecept5\\Api;');
        $I->seeInThisFile('use \Codecept5\TestSupport\ApiTester;');
        if ((PHP_MAJOR_VERSION == 7) && (PHP_MINOR_VERSION < 4)) {
            $I->seeInThisFile('protected $tester;');
        } else {
            $I->seeInThisFile('protected ApiTester $tester;');
        }

    }

}