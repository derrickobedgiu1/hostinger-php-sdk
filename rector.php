<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\ValueObject\PhpVersion;
use Rector\Set\ValueObject\SetList;
use Rector\Set\ValueObject\LevelSetList;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->paths([
        __DIR__ . '/src',
        __DIR__ . '/tests',
    ]);

    // Define PHP version
    $rectorConfig->phpVersion(PhpVersion::PHP_81);

    // Register sets of rules
    $rectorConfig->sets([
        SetList::DEAD_CODE,
        SetList::CODE_QUALITY,
        SetList::CODING_STYLE,
        SetList::TYPE_DECLARATION,
        LevelSetList::UP_TO_PHP_81,
    ]);

    $rectorConfig->disableParallel();
    $rectorConfig->importNames();
    $rectorConfig->importShortClasses(false);
};
