<?php

declare(strict_types=1);

namespace Changelog\CommitParser;

final class ConventionalCommit extends AbstractCommitParser
{
    public function pattern(): string
    {
        return '/^(?<type>\w*)(?:\((?<scope>.*)\))?(?<breaking>!)?:\s(?<subject>(?:(?!#).)*(?:(?!\s).))\s?(?<ticket>#\d*)?$/u';
    }
}
