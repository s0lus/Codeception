<?php

declare(strict_types=1);

namespace Codeception\PHPUnit\Compatibility;

use PHPUnit\Runner\BaseTestRunner;
use PHPUnit\Runner\Version;
use function method_exists;

class PHPUnit9
{
    public static function baseTestRunnerClassExists(): bool
    {
        return class_exists(BaseTestRunner::class);
    }

    public static function getCodeCoverageMethodExists(object $testResult): bool
    {
        return method_exists($testResult, 'getCodeCoverage');
    }

    public static function getTestResultObjectMethodExists(object $test): bool
    {
        return method_exists($test, 'getTestResultObject');
    }

    public static function removeListenerMethodExists(object $result): bool
    {
        return method_exists($result, 'removeListener');
    }

    public static function setCodeCoverageMethodExists(object $testResult): bool
    {
        return method_exists($testResult, 'setCodeCoverage');
    }

    public static function isCurrentVersion(): bool
    {
        return Version::series() < 10;
    }
}