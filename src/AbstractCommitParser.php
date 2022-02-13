<?php

declare(strict_types=1);

namespace Changelog\CommitParser;

use Spatie\Regex\MatchResult;
use Spatie\Regex\Regex;

abstract class AbstractCommitParser implements CommitParser
{
    public function parse(string $input): Commit
    {
        $matches = Regex::match($this->pattern(), trim($input));

        return new Commit(
            type: $this->getType($matches),
            scope: $this->getScope($matches),
            breaking: $this->getBreakingChange($matches),
            message: $this->getSubject($matches),
            ticket: $this->getTicket($matches),
        );
    }

    protected function getType(MatchResult $result): string
    {
        return $result->group('type');
    }

    protected function getScope(MatchResult $result): ?string
    {
        return $result->groupOr('scope', '') ?: null;
    }

    protected function getBreakingChange(MatchResult $result): bool
    {
        return $result->groupOr('breaking', '') === '!';
    }

    protected function getSubject(MatchResult $result): string
    {
        return trim($result->group('subject'));
    }

    protected function getTicket(MatchResult $result): ?int
    {
        $ticket = filter_var($result->groupOr('ticket', ''), FILTER_SANITIZE_NUMBER_INT);

        if ($ticket) {
            return intval($ticket);
        }

        return null;
    }

    abstract protected function pattern(): string;
}
