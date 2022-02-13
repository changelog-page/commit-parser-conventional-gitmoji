<?php

declare(strict_types=1);

namespace Changelog\CommitParser;

interface CommitParser
{
    public function parse(string $input): Commit;
}
