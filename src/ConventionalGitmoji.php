<?php

declare(strict_types=1);

namespace Changelog\CommitParser;

final class ConventionalGitmoji extends AbstractCommitParser
{
    public function pattern(): string
    {
        return '/^(?<emoji>((?::\w*:)|(?:[\x{2600}-\x{26FF}\x{1F600}-\x{1F64F}])))(.*?)(?<type>\w*)(?:\((?<scope>.*)\))?!?:\s(?<subject>(?:(?!#).)*(?:(?!\s).))\s?(?<ticket>(#\d+)|\(#\d+\))?$/u';
    }
}
