<?php

declare(strict_types=1);

namespace Changelog\CommitParser;

final class CommitParserFactory
{
    public static function make(string $name): CommitParser
    {
        return match ($name) {
            'conventional-commit'  => new ConventionalCommit(),
            'conventional-gitmoji' => new ConventionalGitmoji(),
            'gitmoji'              => new Gitmoji(),
        };
    }
}
